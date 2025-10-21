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
    public function it_sanitizes_content_through_middleware()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => '<script>alert("XSS")</script>Plain text',
            ]);

        // The middleware should sanitize the content, so it should pass validation
        // but the script tag should be removed
        $response->assertSessionHasNoErrors();
        
        // Verify the content was sanitized
        $post = Post::where('member_id', $this->user->id)->latest()->first();
        $this->assertStringNotContainsString('<script>', $post->content);
        $this->assertStringContainsString('Plain text', $post->content);
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
    public function it_rejects_data_urls()
    {
        $response = $this->actingAs($this->user, 'user')
            ->post('/post', [
                'modalContent' => 'data:text/html,<script>alert("XSS")</script>',
            ]);

        $response->assertSessionHasErrors(['modalContent']);
    }
}
