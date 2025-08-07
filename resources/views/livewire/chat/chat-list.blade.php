<div>
    <!-- Button -->

    <!-- Chat sidebar START -->

    <!-- Offcanvas header -->
    <div class="offcanvas-header">
    <h5 class="offcanvas-title mb-0">Messaging</h5>

    <button type="button" class="btn btn-secondary-soft-hover py-1 px-2 ms-auto" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>

    <!-- Offcanvas body START -->
    <div
        class="offcanvas-body pt-0 custom-scrollbar os-host os-theme-dark os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition h-100">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -24px -16px; width: 398px; height: 459px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                <div class="os-content" style="padding: 0px 24px 16px; height: 100%; width: 100%;">

                    <input type="text" class="form-control mb-3" placeholder="Search users..."
                        wire:model.live="search" />

                    <button class="btn bg-transparent px-3 py-0 position-absolute top-50 start-0 translate-middle-y"
                        type="submit"><i class="bi bi-search fs-5"> </i></button>

                    <!-- Search contact END -->
                    @if($chats && $chats->isNotEmpty())
                        <ul class="list-unstyled">
                            @foreach ($chats as $key => $chat)

                                <!-- Contact item -->
                                <li class="mt-3 hstack gap-3 align-items-center position-relative toast-btn" style=" {{ $selectedChat == $chat->member_id ? 'background-color: #af2910' : '' }}"
                                    data-target="chatToast-{{ $chat->member_id }}" wire:click="selectChat({{ $chat->member_id }})"
                                    wire:key="chat-{{ $chat->member_id }}" style="cursor: pointer;">

                                    {{-- new code needed to test --}}

                                    {{-- <li class="mt-3 hstack gap-3 align-items-center position-relative toast-btn"
    style="cursor: pointer; {{ $selectedChat == $chat->member_id ? 'background-color: #af2910;' : '' }}"
    data-target="chatToast-{{ $chat->member_id }}"
    wire:click="selectChat({{ $chat->member_id }})"
    wire:key="chat-{{ $chat->member_id }}"> --}}

                                    <!-- Avatar -->
                                    <div class="avatar status-online">
                                        <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="">
                                    </div>
                                    <!-- Info -->
                                    <div class="overflow-hidden">
                                        <a class="h6 mb-0 stretched-link {{ $selectedChat == $chat->member_id ? 'text-white' : '' }}" href="#!">{{ $chat->name }} 
                                            @if ($selectedChat != $chat->member_id)
                                                <span id="unread-count-{{ $chat->member_id }}">
                                                    {{ App\Models\Member::find($chat->member_id)->unreadMessages->count() > 0 ? '(' . App\Models\Member::find($chat->member_id)->unreadMessages->count() . ')' : null }}
                                                </span>
                                            @endif

                                        </a>
                                        {{-- <div class="small text-secondary text-truncate">Frances sent a photo.</div> --}}
                                    </div>
                                    <!-- Chat time -->
                                    {{-- <div class="small ms-auto text-nowrap"> Just now </div> --}}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <ul class="list-unstyled">
                            <li class="text-center mt-5">
                                <p class="text-danger">No user found.</p>
                            </li>
                        </ul>
                    @endif

                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track os-scrollbar-track-off">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track os-scrollbar-track-off">
                <div class="os-scrollbar-handle" style="height: 53.1792%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>

        <!-- Offcanvas body END -->
    </div>
    <!-- Chat sidebar END -->

    <!-- Chat END -->

    <!-- Chat START -->



    @if($selectedChat)

        <div class="toast-container toast-chat d-flex gap-3 align-items-end">
            {{-- @foreach ($openMembers as $member) --}}
            <!-- Chat toast START -->
            {{-- <div class="toast mb-0 bg-mode" role="alert" aria-live="assertive" aria-atomic="true"
                data-bs-autohide="false"> --}}
                <div class="toast mb-0 bg-mode show" role="alert" aria-live="assertive" aria-atomic="true"
                    data-bs-autohide="false">
<div class="toast-header bg-mode">
    <div class="d-flex justify-content-between align-items-center w-100">

        <!-- Avatar and Name -->
        <div class="d-flex align-items-center">
            <div class="avatar me-2 flex-shrink-0">
                <img class="avatar-img rounded-circle"
                     src="http://4.247.151.249/assets/images/avatar/01.jpg"
                     alt="User Avatar"
                     width="40" height="40" loading="lazy">
            </div>
            <h6 class="mb-0">{{ $selectChat->name }}</h6>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex align-items-center gap-1">
            <!-- Collapse Button -->
            <a class="btn btn-secondary-soft-hover py-1 px-2"
               data-bs-toggle="collapse"
               href="#collapseChat-161"
               aria-expanded="true"
               aria-controls="collapseChat-161">
                <i class="bi bi-dash-lg"></i>
            </a>

            <!-- Close Button -->
            <button type="button"
                    class="btn btn-secondary-soft-hover py-1 px-2"
                    data-bs-dismiss="toast"
                    aria-label="Close"
                    wire:click="closeChat(161)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</div>

                   <div class="toast-body collapse show p-0" id="collapseChat-{{ $selectChat->id }}">
    <div class="chat-conversation-content overflow-auto px-3 py-2" style="max-height: 300px;" id="chat-container-{{ $selectChat->id }}">
        @foreach ($messages as $message)
            @if ($message->sender_id != auth()->guard('user')->id())
                <!-- Received -->
                <div class="d-flex flex-column align-items-start mb-2">
                    <div class="bg-light text-secondary p-2 px-3 rounded-2">
                        {{ $message->message ?? '' }}
                    </div>
                </div>
            @else
                <!-- Sent -->
                <div class="d-flex justify-content-end text-end mb-2">
                    <div class="bg-primary text-white p-2 px-3 rounded-2">
                        {{ $message->message ?? '' }}
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Chat Footer -->
    <div class="toast-footer border-top pt-2 mt-2 px-3">
        <form wire:submit.prevent="submit">
            <!-- <input type="file" wire:model="uploadFile" accept="image/*,.pdf" class="form-control mb-2"> -->

            <form wire:submit.prevent="submit" class="d-flex gap-2">
    <!-- Text Input -->
    <input type="text"
           wire:model.defer="newMessage"
           wire:keydown.enter="submit"
           class="form-control"
           placeholder="Type your message...">

    <!-- Send Button -->
    <button type="submit" class="btn btn-primary">
        Send
    </button>
</form>

        </form>
    </div>
</div>

                <!-- Chat toast END -->

                {{-- @endforeach --}}
            </div>
    @endif
        <!-- Chat END -->
    </div>