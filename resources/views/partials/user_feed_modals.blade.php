<!-- Edit Comment Modal -->
<div class="modal fade" id="editCommentModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{-- route('user.comments.update') --}}">
      @csrf
      @method('PUT')
      <input type="hidden" name="comment_id" id="editCommentId">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Comment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <textarea name="comment" id="editCommentText" class="form-control" rows="3"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Add Story Modal -->
<div class="modal fade" id="addStoryModal" tabindex="-1" aria-labelledby="addStoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
      <form action="{{ route('user.stories.store') }}" method="POST" enctype="multipart/form-data" id="storyForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addStoryModalLabel">Add New Story</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          @error('story_file')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
      <div class="mb-3">
            <label for="story_file" class="form-label">Select Story (Image or Video)</label>
            <input type="file" class="form-control" name="story_file" id="story_file"
                accept=".jpg,.jpeg,.png,.webp,.gif,.svg,.mp4,.mov,.avi" required>
            <small class="text-muted d-block mt-2" id="fileInfo">Max 10MB. Allowed types: JPG, PNG, WebP, GIF, SVG, MP4, MOV, AVI.</small>
            <div class="text-danger mt-2" id="fileError"></div>
        </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload Story</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add Story Modal -->


<!-- Direct Message Modal -->
<div class="modal fade" id="directMessageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{-- route('messages.send') --}}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Send Direct Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="user_id" id="messageUserId">
          <textarea name="message" class="form-control" rows="3" placeholder="Write your message..." required></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </div>
    </form>
  </div>
 </div>
 <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('user.update_topic_details')  }} " method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="post_id" id="editPostId" value="">   
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Post Content -->
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Content</label>
                        <textarea id="postContent" name="content" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="videoLink" class="form-label">Video Link (YouTube, Vimeo, etc.)</label>
                        <input type="url" id="videoLink" name="video_link" class="form-control"
                            value="" placeholder="Enter video URL">
                    </div>

                    <!-- Optional: Image/Media upload -->
                    <!-- Multiple Image Upload -->
                    <div class="mb-3">
                        <label for="postMedia" class="form-label">Attach Media</label>
                        <input type="file" id="postMedia" name="postMedia[]" class="form-control" multiple>
                      <div id="currentMediaPreview" class="d-flex flex-wrap gap-3 mt-3"></div>

                        <!-- Static Preview Gallery -->
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Direct Message Modal end -->


