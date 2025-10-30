<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class HtmlValidationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user
        $this->user = Member::factory()->create();
    }

    /** @test */
    public function it_rejects_html_tags_in_post_content()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<p>This is a test post with HTML</p>',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
        $response->assertSessionHasErrors(['modalContent' => '❌ Validation failed — HTML tags or JavaScript are not allowed.']);
    }

    /** @test */
    public function it_rejects_script_tags_in_post_content()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<script>alert("XSS")</script>',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
    }

    /** @test */
    public function it_rejects_javascript_protocols_in_post_content()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => 'javascript:alert("XSS")',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
    }

    /** @test */
    public function it_rejects_html_tags_in_comments()
    {
        $post = Post::factory()->create(['member_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'user')
            ->post("/post/{$post->id}/comment", [
                'comment' => '<b>This is a bold comment</b>',
            ]);

        $response->assertSessionHasErrors(['comment']);
    }

    /** @test */
    public function it_rejects_event_handlers_in_comments()
    {
        $post = Post::factory()->create(['member_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'user')
            ->post("/post/{$post->id}/comment", [
                'comment' => 'onclick="alert(\'XSS\')"',
            ]);

        $response->assertSessionHasErrors(['comment']);
    }

    /** @test */
    public function it_rejects_sql_injection_patterns()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => "'; DROP TABLE posts; --",
            ]);

        $response->assertSessionHasErrors(['modalContent']);
    }

    /** @test */
    public function it_rejects_dangerous_characters()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => 'test; rm -rf /',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
    }

    /** @test */
    public function it_accepts_plain_text_content()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => 'This is a plain text post without any HTML or JavaScript.',
            ]);

        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function it_accepts_plain_text_comments()
    {
        $post = Post::factory()->create(['member_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'user')
            ->post("/post/{$post->id}/comment", [
                'comment' => 'This is a plain text comment.',
            ]);

        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function it_rejects_content_with_html_through_strict_validation()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<script>alert("XSS")</script>Plain text',
            ]);

        // With strict validation, any HTML content should be rejected
        $response->assertSessionHasErrors(['modalContent']);
        $response->assertSessionHasErrors(['modalContent' => '❌ Validation failed — HTML tags or JavaScript are not allowed.']);
        
        // Verify no post was created
        $post = Post::where('member_id', $this->user->id)->latest()->first();
        $this->assertNull($post);
    }

    /** @test */
    public function it_rejects_iframe_tags()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<iframe src="malicious-site.com"></iframe>',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
    }

    /** @test */
    public function it_rejects_object_tags()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<object data="malicious.swf"></object>',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
    }

    /** @test */
    public function it_rejects_embed_tags()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<embed src="malicious.swf">',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
    }

    /** @test */
    public function it_rejects_css_expressions()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => 'expression(alert("XSS"))',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
    }

    /** @test */
    public function it_rejects_html_tags_in_comment_updates()
    {
        $post = Post::factory()->create(['member_id' => $this->user->id]);
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'member_id' => $this->user->id,
            'comment' => 'Original comment'
        ]);

        $response = $this->actingAs($this->user, 'user')
            ->put("/user/comments/{$comment->id}", [
                'comment' => '<b>This is a bold updated comment</b>',
            ]);

        $response->assertSessionHasErrors(['comment']);
    }

    /** @test */
    public function it_rejects_script_tags_in_comment_updates()
    {
        $post = Post::factory()->create(['member_id' => $this->user->id]);
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'member_id' => $this->user->id,
            'comment' => 'Original comment'
        ]);

        $response = $this->actingAs($this->user, 'user')
            ->put("/user/comments/{$comment->id}", [
                'comment' => '<script>alert("XSS")</script>Updated comment',
            ]);

        $response->assertSessionHasErrors(['comment']);
    }

    /** @test */
    public function it_sanitizes_html_in_comment_updates()
    {
        $post = Post::factory()->create(['member_id' => $this->user->id]);
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'member_id' => $this->user->id,
            'comment' => 'Original comment'
        ]);

        $response = $this->actingAs($this->user, 'user')
            ->put("/user/comments/{$comment->id}", [
                'comment' => '<p>Updated comment with HTML</p>',
            ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        
        // Verify the comment was sanitized
        $comment->refresh();
        $this->assertStringNotContainsString('<p>', $comment->comment);
        $this->assertStringContainsString('Updated comment with HTML', $comment->comment);
    }

    /** @test */
    public function it_accepts_plain_text_in_comment_updates()
    {
        $post = Post::factory()->create(['member_id' => $this->user->id]);
        $comment = Comment::factory()->create([
            'post_id' => $post->id,
            'member_id' => $this->user->id,
            'comment' => 'Original comment'
        ]);

        $response = $this->actingAs($this->user, 'user')
            ->put("/user/comments/{$comment->id}", [
                'comment' => 'This is a plain text updated comment.',
            ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        
        // Verify the comment was updated
        $comment->refresh();
        $this->assertEquals('This is a plain text updated comment.', $comment->comment);
    }

    /** @test */
    public function it_rejects_html_entities_in_strict_mode()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '&lt;script&gt;alert("XSS")&lt;/script&gt;',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
        $response->assertSessionHasErrors(['modalContent' => '❌ Validation failed — HTML tags or JavaScript are not allowed.']);
    }

    /** @test */
    public function it_rejects_url_encoded_script_tags()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '%3Cscript%3Ealert("XSS")%3C/script%3E',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
        $response->assertSessionHasErrors(['modalContent' => '❌ Validation failed — HTML tags or JavaScript are not allowed.']);
    }

    /** @test */
    public function it_rejects_unicode_script_patterns()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '\u003cscript\u003ealert("XSS")\u003c/script\u003e',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
        $response->assertSessionHasErrors(['modalContent' => '❌ Validation failed — HTML tags or JavaScript are not allowed.']);
    }

    /** @test */
    public function it_rejects_form_elements_in_strict_mode()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<form action="malicious.php"><input type="text"></form>',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
        $response->assertSessionHasErrors(['modalContent' => '❌ Validation failed — HTML tags or JavaScript are not allowed.']);
    }

    /** @test */
    public function it_rejects_button_elements_in_strict_mode()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<button onclick="alert(\'XSS\')">Click me</button>',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
        $response->assertSessionHasErrors(['modalContent' => '❌ Validation failed — HTML tags or JavaScript are not allowed.']);
    }

    /** @test */
    public function it_rejects_textarea_elements_in_strict_mode()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<textarea>Malicious content</textarea>',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
        $response->assertSessionHasErrors(['modalContent' => '❌ Validation failed — HTML tags or JavaScript are not allowed.']);
    }

    /** @test */
    public function it_rejects_select_elements_in_strict_mode()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<select><option>Malicious option</option></select>',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
        $response->assertSessionHasErrors(['modalContent' => '❌ Validation failed — HTML tags or JavaScript are not allowed.']);
    }
}
