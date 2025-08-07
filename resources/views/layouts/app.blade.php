<!doctype html>
<html lang="en">

<head>
    @include('layouts.pre_header')
    @vite(['resources/js/app.js'])
    @livewireStyles
    <style>
    #pageLoader {
        transition: opacity 0.3s ease;
    }

    #pageLoader.hide {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    .chat-dot {
    position: absolute;
    top: -4px;
    right: -4px;
    width: 10px;
    height: 10px;
    background-color: #28a745; /* Bootstrap green */
    border: 2px solid #fff;
    border-radius: 50%;
    z-index: 2;
}


</style>

<script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            loader.classList.add('hide');
            setTimeout(() => loader.remove(), 500); // optional: remove from DOM after fade
        }
    });
</script>

</head>

<body>
    <!-- Page Loader -->
<div id="pageLoader" class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white" style="z-index: 9999;">
    <div class="spinner-border text-danger" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

    @include('layouts.header')
    @if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    </div>
    @endif
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
            <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $error }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endforeach
@endif

    <main>
   
        @yield('content')
        <div class="chat-container">
            @include('layouts.chat_accessibility')
        </div>
    </main>
    @include('layouts.footer')
    @yield('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('story_file');
        const fileError = document.getElementById('fileError');
        const fileInfo = document.getElementById('fileInfo');
        const form = document.getElementById('storyForm');

        //const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif', 'image/svg+xml'];
        const allowedTypes = [
            'image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif', 'image/svg+xml',
            'video/mp4', 'video/quicktime', 'video/x-msvideo' // mp4, mov, avi
        ];

        const maxSize = 10 * 1024 * 1024; // 10MB

        fileInput.addEventListener('change', function() {
            fileError.innerText = '';
            fileInfo.innerText = 'Max 10MB. Allowed types: JPG, PNG, WebP, GIF, SVG, MP4, MOV.';

            const file = this.files[0];
            if (!file) return;

            if (!allowedTypes.includes(file.type)) {
                fileError.innerText = 'Invalid file type. Allowed: JPG, PNG, WebP, GIF, SVG.';
                this.value = ''; // Reset file input
                return;
            }

            if (file.size > maxSize) {
                fileError.innerText = 'File too large. Maximum size is 10MB.';
                this.value = '';
                return;
            }

            const info =
                `✅ Selected: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB, ${file.type})`;
            fileInfo.innerText = info;
        });

        // Prevent form submit if file is invalid
        /*form.addEventListener('submit', function (e) {
            const file = fileInput.files[0];
            fileError.innerText = '';

            if (!file) {
                fileError.innerText = 'Please select a file.';
                e.preventDefault();
                return;
            }

            if (!allowedTypes.includes(file.type)) {
                fileError.innerText = 'Invalid file type.';
                e.preventDefault();
                return;
            }

            if (file.size > maxSize) {
                fileError.innerText = ' File too large.';
                e.preventDefault();
                return;
            }
        }); */
    });
    </script>
    <script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('pageLoader');
        if (loader) {
            loader.style.display = 'none';
        }
    });

    window.addEventListener('open-chat-toast', event => {
        const { id, name, avatar } = event.detail;

        const toast = document.getElementById('chatToast');

        // You could dynamically inject the data here
        toast.querySelector('.toast-header h6').textContent = name;
        toast.querySelector('.toast-header img').src = avatar;
        
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
    });

</script>
<!-- Toast Container -->


@livewireScripts
<script type="module">
    console.log('Livewire scripts loaded');
    console.log(window.Echo);
    console.log('Echo instance:', window.Echo);
        let typingTimeout;
        const chatContainer = document.getElementById('chat-container');

        window.Echo.private(`chat-channel.{{ auth()->guard('user')->id() }}`)
    
            .listen('MessageSentEvent', (event) => {
            console.log('MessageSentEvent received:', event);

            // const chatContainer = document.getElementById('chat-container');
            const chatContainer = document.getElementById(`chat-container-${event.message.sender_id === {{ auth()->guard('user')->id() }} ? event.message.receiver_id : event.message.sender_id}`);

            const messageInputField = document.getElementById('message-input');
            
            const isInputFocused = document.activeElement === messageInputField;
            const isScrolledToBottom = chatContainer.scrollTop + chatContainer.clientHeight >= chatContainer.scrollHeight - 10;

            // Append the message
            const message = event.message;
            const isSender = message.sender_id === {{ auth()->guard('user')->id() }};
            
            if (!chatContainer) {
                console.log("Chat window not open, skipping append.");
                return;
            }


            const messageWrapper = document.createElement('div');
            if (isSender) {
                messageWrapper.className = 'd-flex justify-content-end text-end mb-1';
                messageWrapper.innerHTML = `
                    <div class="w-100">
                        <div class="d-flex flex-column align-items-end">
                            <div class="bg-primary text-white p-2 px-3 rounded-2">
                                ${message.message}
                            </div>
                        </div>
                    </div>
                `;
            } else {
                messageWrapper.className = 'd-flex flex-column align-items-start';
                messageWrapper.innerHTML = `
                    <div class="bg-light text-secondary p-2 px-3 rounded-2">
                        ${message.message}
                    </div>
                `;
            }

            chatContainer.appendChild(messageWrapper);

            // Play sound if not focused or scrolled
            //if (!isInputFocused || !isScrolledToBottom) {
              //  const audio = new Audio('{{ asset('sounds/notification.mp3') }}');
                // audio.play();
            // }

            // Scroll to bottom after new message
            // chatContainer.scrollTop = chatContainer.scrollHeight;
            setTimeout(() => {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 10);
        });

        window.Echo.private('unread-channel.{{ auth()->guard('user')->id() }}')
        .listen('UnreadMessage', (event) => {
            const unreadCountElement = document.getElementById(`unread-count-${event.senderId}`);
            if (unreadCountElement) {
                unreadCountElement.textContent = event.unreadCount > 0 ? `(${event.unreadCount})` : '';
            }
        });


        // Listen for Livewire events
        Livewire.on('messages-updated', () => {
            setTimeout(() => {
                scrollToBottom();
            }, 50);
        });

        // Scroll to Message
        Livewire.on('scroll-to-message', (event) => {
            const messageElement = document.getElementById(`message-${event.index}`);
            if (messageElement) {
                messageElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });

        // Scroll on initial load
        window.onload = () => {
            scrollToBottom();
        };

        function scrollToBottom() {
            if (chatContainer) {
                chatContainer.scrollTo(0, chatContainer.scrollHeight);
            }
        }
    </script>
</body>

</html>