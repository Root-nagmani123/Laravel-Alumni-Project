<!-- Main content START -->
<!-- Story START -->
<div class="d-flex gap-2 mb-4 ml-n-half">
    <div class="position-relative" id="openAddStoryModal">
        <div class="card border border-2 border-dashed h-150px px-4 px-sm-5 shadow-none d-flex align-items-center justify-content-center text-center">
            <div>
                <a class="stretched-link btn btn-light rounded-circle icon-md" href="javascript:void(0);">
                    <i class="fa-solid fa-plus"></i>
                </a>
                <h6 class="mt-2 mb-0 small">Post a Story</h6>
            </div>
        </div>
    </div>

    <!-- Stories -->
    <div id="stories" class="storiesWrapper stories-square stories user-icon carousel scroll-enable"></div>
</div>
<!-- Story END -->

<!-- Share feed START -->
<div class="card card-body mb-4">
    <div class="d-flex">
        <!-- Avatar -->
        <div class="avatar avatar-xs me-2">
            <a href="{{ route('user.profile.data', ['id' => Crypt::encrypt($user->id)]) }}"> 
                <img class="avatar-img rounded-circle lazyload" 
                     data-src="{{ $user->profile_pic ? route('secure.file', ['type' => 'profile', 'path' => $user->profile_pic]) : asset('feed_assets/images/avatar/07.jpg') }}"
                     alt="User Profile" width="40" height="40">
            </a>
        </div>
        <!-- Post input -->
        <form class="w-100">
            <textarea class="form-control pe-4 border-0" rows="2" data-autoresize=""
                placeholder="Share your thoughts..." data-bs-toggle="modal"
                data-bs-target="#feedActionPhoto"></textarea>
        </form>
    </div>
    <!-- Share feed toolbar START -->
    <ul class="nav nav-pills nav-stack small fw-normal">
        <li class="nav-item">
            <a class="nav-link bg-light py-1 px-2 mb-0" href="#!" data-bs-toggle="modal"
                data-bs-target="#feedActionPhoto"> 
                <i class="bi bi-image-fill text-success pe-2"></i>Photos/Videos
            </a>
        </li>
    </ul>
    <!-- Share feed toolbar END -->
</div>
<!-- Share feed END -->

<!-- Card feed item START -->

<div id="post-container">
        @include('partials.posts', ['posts' => $posts])
    </div>
@include('partials.user_feed_modals')
<div id="scroll-sentinel" class="text-center py-4">
    <div id="infinite-loader" style="display:none;">
        <div class="spinner-border spinner-border-sm" role="status"></div>
        <span class="ms-2">Loading...</span>
    </div>
    <div id="no-more" style="display:none;">
        <p class="text-muted mb-0">No more posts</p>
    </div>
</div>
@section('scripts')
<script nonce="{{ $cspNonce }}">// Lazy loading implementation
document.addEventListener('DOMContentLoaded', function() {

    const sentinel = document.querySelector('#scroll-sentinel');
    const postContainer = document.querySelector('#post-container');
    const loader = document.querySelector('#infinite-loader');
    const noMore = document.querySelector('#no-more');

    // start page = 1 because first page is server-rendered
    let page = 1;
    let loading = false;
    let finished = false;

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !loading && !finished) {
                loadMore();
            }
        });
    }, { root: null, rootMargin: '0px', threshold: 0.3 });

    observer.observe(sentinel);

    function loadMore() {
        loading = true;
        page++;
        loader.style.display = 'inline-block';

        fetch("{{ route('user.feed.load') }}?page=" + page, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(resp => {
            if (resp.status === 204) return '';
            if (!resp.ok) throw new Error('Network error');
            return resp.text();
        })
        .then(html => {
            loader.style.display = 'none';
            if (!html || html.trim() === '') {
                finished = true;
                noMore.style.display = 'block';
                observer.unobserve(sentinel);
                return;
            }

            const temp = document.createElement('div');
            temp.innerHTML = html;
            while (temp.firstChild) {
                postContainer.appendChild(temp.firstChild);
            }

            // re-init any JS for new nodes
            initPostBehaviors(postContainer);
            loading = false;
        })
        .catch(err => {
            console.error(err);
            loader.style.display = 'none';
            loading = false;
        });
    }

    // initial init
    initPostBehaviors(document);



    // Initialize lazy loading for images and iframes
    if ('IntersectionObserver' in window) {
        const lazyMediaObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const media = entry.target;
                    
                    if (media.tagName === 'IMG') {
                        media.src = media.dataset.src;
                        media.classList.remove('lazyload');
                    } else if (media.tagName === 'VIDEO') {
                        const source = media.querySelector('source');
                        if (source) {
                            source.src = source.dataset.src;
                        }
                        media.load();
                        media.classList.remove('lazyload');
                    } else if (media.tagName === 'IFRAME') {
                        media.src = media.dataset.src;
                        media.classList.remove('lazyload');
                    }
                    
                    lazyMediaObserver.unobserve(media);
                }
            });
        });

        // Observe all lazy media elements
        document.querySelectorAll('img.lazyload, video.lazyload, iframe.lazyload').forEach(function(media) {
            lazyMediaObserver.observe(media);
        });
    } else {
        // Fallback for browsers without IntersectionObserver
        document.querySelectorAll('img.lazyload').forEach(function(img) {
            img.src = img.dataset.src;
        });
        document.querySelectorAll('video.lazyload').forEach(function(video) {
            const source = video.querySelector('source');
            if (source) {
                source.src = source.dataset.src;
            }
            video.load();
        });
    }

    // Lazy load comments when "Load more" is clicked
    document.querySelectorAll('.load-more-comments').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const postElement = this.closest('.card');
            const hiddenComments = postElement.querySelectorAll('.comment-item.d-none');
            const step = parseInt(this.dataset.step) || 5;
            
            // Show next batch of comments
            for (let i = 0; i < Math.min(step, hiddenComments.length); i++) {
                hiddenComments[i].classList.remove('d-none');
            }
            
            // Hide button if no more comments to load
            if (hiddenComments.length <= step) {
                this.style.display = 'none';
            }
        });
    });
});

window.deleteStoryRouteTemplate = "{{ route('user.stories.destroy', ['id' => '__ID__']) }}";
(function(){
    let currentTime = Math.floor(Date.now() / 1000);
    @php
        $myUserId = Auth::guard('user')->id();
    @endphp
    window.storiesData = [
        @if(isset($storiesByMember[$myUserId]))
            @php
                $myFirst = $storiesByMember[$myUserId]->first();
                $myUser = $myFirst->user;
                $profileImage = '';
                $user = App\Models\Member::find($myUserId);
                if ($user && !empty($user->profile_pic) &&
                    Storage::disk('public')->exists($user->profile_pic)) {
                    $profileImage = asset('storage/' . $user->profile_pic);
                } else {
                    $profileImage = asset('feed_assets/images/avatar/07.jpg');
                }
            @endphp
            {
                id: "member-{{ $myUserId }}",
                photo: "{{ $profileImage }}",
                name: "{{ addslashes($myUser->name) }}",
                items: [
                    @foreach($storiesByMember[$myUserId] as $story)
                        @php
                            $isVideo = in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']);
                            $previewImage = $isVideo
                                ? 'storage/thumbnails/' . pathinfo($story->story_image, PATHINFO_FILENAME) . '.jpg'
                                : 'storage/' . $story->story_image;
                        @endphp
                        {
                            id: "story-{{ $story->id }}",
                            type: "{{ $isVideo ? 'video' : 'photo' }}",
                            length: {{ $isVideo ? 15 : 5 }},
                            src: "{{ route('secure.file', ['type'=>'story','path'=>$story->story_image]) }}",
                            preview: "{{ asset($previewImage) }}",
                            time: {{ \Carbon\Carbon::parse($story->created_at)->timestamp }}
                        }@if(!$loop->last),@endif
                    @endforeach
                ]
            },
        @endif
        @foreach($storiesByMember as $memberId => $memberStories)
            @continue($memberId == $myUserId)
            @php
                $first = $memberStories->first();
                $user = $first->user;
                $profileImage = '';
                $member = App\Models\Member::find($memberId);
                if ($member && !empty($member->profile_pic) &&
                    Storage::disk('public')->exists($member->profile_pic)) {
                    $profileImage = asset('storage/' . $member->profile_pic);
                } else {
                    $profileImage = asset('feed_assets/images/avatar/07.jpg');
                }
            @endphp
            {
                id: "member-{{ $memberId }}",
                photo: "{{ $profileImage }}",
                name: "{{ addslashes($user->name) }}",
                items: [
                    @foreach($memberStories as $story)
                        @php
                            $isVideo = in_array(pathinfo($story->story_image, PATHINFO_EXTENSION), ['mp4', 'webm']);
                            $previewImage = $isVideo
                                ? 'storage/thumbnails/' . pathinfo($story->story_image, PATHINFO_FILENAME) . '.jpg'
                                : 'storage/' . $story->story_image;
                        @endphp
                        {
                            id: "story-{{ $story->id }}",
                            type: "{{ $isVideo ? 'video' : 'photo' }}",
                            length: {{ $isVideo ? 15 : 5 }},
                            src: "{{ route('secure.file', ['type'=>'story','path'=>$story->story_image]) }}",
                            preview: "{{ asset($previewImage) }}",
                            time: {{ \Carbon\Carbon::parse($story->created_at)->timestamp }}
                        }@if(!$loop->last),@endif
                    @endforeach
                ]
            }@if(!$loop->last),@endif
        @endforeach
    ];
})();
</script>

<!-- Add lazysizes library for better lazy loading support -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
<script src="{{ asset('js/user_feed.js') }}" defer></script>
@endsection