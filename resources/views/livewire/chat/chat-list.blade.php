<div>
    <!-- Button -->

    <!-- Chat sidebar START -->

    <!-- Offcanvas header -->
    <div class="offcanvas-header d-flex justify-content-between">
        <h5 class="offcanvas-title"> Mentor/Mentee Conversation</h5>
        <div class="d-flex">
            <!-- New chat box open button -->
            {{-- <a href="#" class="btn btn-secondary-soft-hover py-1 px-2">
                <i class="bi bi-pencil-square"></i>
            </a> --}}
            <!-- Chat action START -->
            {{-- <div class="dropdown">
                <a href="#" class="btn btn-secondary-soft-hover py-1 px-2" id="chatAction" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-three-dots"></i>
                </a>
                <!-- Chat action menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chatAction">
                    <li><a class="dropdown-item" href="#"> <i class="bi bi-check-square fa-fw pe-2"></i>Mark all as
                            read</a></li>
                    <li><a class="dropdown-item" href="#"> <i class="bi bi-gear fa-fw pe-2"></i>Chat setting </a>
                    </li>
                    <li><a class="dropdown-item" href="#"> <i class="bi bi-bell fa-fw pe-2"></i>Disable
                            notifications</a></li>
                    <li><a class="dropdown-item" href="#"> <i class="bi bi-volume-up-fill fa-fw pe-2"></i>Message
                            sounds</a></li>
                    <li><a class="dropdown-item" href="#"> <i class="bi bi-slash-circle fa-fw pe-2"></i>Block
                            setting</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#"> <i class="bi bi-people fa-fw pe-2"></i>Create a group
                            chat</a></li>
                </ul>
            </div> --}}
            <!-- Chat action END -->

            <!-- Close  -->
            <a href="#" 
   class="btn btn-secondary-soft-hover d-flex align-items-center justify-content-center p-0" 
   style="width:32px; height:32px;" 
   data-bs-dismiss="offcanvas" 
   aria-label="Close">
    <i class="fa-solid fa-xmark"></i>
</a>


        </div>
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
                                <li class="mt-3 hstack gap-3 align-items-center position-relative toast-btn"
                                    style=" {{ $selectedChat == $chat->member_id ? 'background-color: #af2910' : '' }}"
                                    data-target="chatToast-{{ $chat->member_id }}"
                                    wire:click="selectChat({{ $chat->member_id }})" wire:key="chat-{{ $chat->member_id }}"
                                    style="cursor: pointer;">

                                    {{-- new code needed to test --}}

                                    {{--
                                <li class="mt-3 hstack gap-3 align-items-center position-relative toast-btn"
                                    style="cursor: pointer; {{ $selectedChat == $chat->member_id ? 'background-color: #af2910;' : '' }}"
                                    data-target="chatToast-{{ $chat->member_id }}"
                                    wire:click="selectChat({{ $chat->member_id }})" wire:key="chat-{{ $chat->member_id }}"> --}}

                                    <!-- Avatar -->
                                    <div class="avatar status-online">
                                        <img class="avatar-img rounded-circle" src="{{asset('feed_assets/images/avatar/07.jpg')}}" alt="">
                                    </div>
                                    <!-- Info -->
                                    <div class="overflow-hidden">
                                        <a class="h6 mb-0 stretched-link {{ $selectedChat == $chat->member_id ? 'text-white' : '' }}"
                                            href="#!">{{ $chat->name }}
                                            {{-- @if ($selectedChat != $chat->member_id)
                                                <span id="unread-count-{{ $chat->member_id }}">
                                                    {{ App\Models\Member::find($chat->member_id)->unreadMessages->count() > 0 ? '(' . App\Models\Member::find($chat->member_id)->unreadMessages->count() . ')' : null }}
                                                </span>
                                            @endif --}}

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

    <!-- Chat toast START -->
    <div id="chatToast-{{ $selectChat->id }}" class="toast mb-0 bg-mode fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">

        <!-- Header -->
        <div class="toast-header bg-mode">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="d-flex">
                    <div class="flex-shrink-0 avatar me-2 position-relative">
                        <img class="avatar-img rounded-circle" src="{{ asset('feed_assets/images/avatar/07.jpg') }}" alt="">
                        <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 mt-1">{{ $selectChat->name }}</h6>
                        <div class="small text-secondary">
                            <i class="fa-solid fa-circle text-success me-1"></i>Online
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-1">
    <!-- Collapse -->
    <a class="btn btn-secondary-soft-hover d-flex align-items-center justify-content-center p-0" 
       style="width:32px; height:32px;" 
       data-bs-toggle="collapse" 
       href="#collapseChat-{{ $selectChat->id }}">
        <i class="bi bi-dash-lg"></i>
    </a>

    <!-- Close -->
    <button type="button" 
            class="btn btn-secondary-soft-hover d-flex align-items-center justify-content-center p-0" 
            style="width:32px; height:32px;" 
            data-bs-dismiss="toast" 
            wire:click="closeChat({{ $selectChat->id }})">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>

            </div>
        </div>

        <!-- Body -->
        <div class="toast-body collapse show" id="collapseChat-{{ $selectChat->id }}">
            <div class="chat-conversation-content custom-scrollbar h-200px" style="overflow-y:auto;" id="chat-container">

                @php
                    $groupedMessages = $messages->groupBy(fn($m) => \Carbon\Carbon::parse($m->created_at)->format('Y-m-d'));
                @endphp

                @foreach ($groupedMessages as $date => $dailyMessages)
                    <!-- Date separator -->
                    <div class="text-center small my-2">
                        {{ \Carbon\Carbon::parse($date)->isToday() ? 'Today' : \Carbon\Carbon::parse($date)->format('M j, Y') }}
                    </div>

                    @foreach ($dailyMessages as $message)
                        @if ($message->sender_id != auth()->guard('user')->id())
                            <!-- Received -->
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0 avatar avatar-xs me-2">
                                    <img class="avatar-img rounded-circle" src="{{ asset('feed_assets/images/avatar/07.jpg') }}" alt="">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-column align-items-start">
                                        <div class="bg-light text-secondary p-2 px-3 rounded-2">
                                            {{ $message->message }}
                                        </div>
                                        <div class="small my-1">{{ $message->created_at->format('g:i A') }}</div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Sent -->
                            <div class="d-flex justify-content-end text-end mb-1">
                                <div class="d-flex flex-column align-items-end">
                                    <div class="text-white p-2 px-3 rounded-2" style="background:#af2910;">
                                        {{ $message->message }}
                                    </div>
                                    <div class="small my-1 text-secondary">{{ $message->created_at->format('g:i A') }}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach

            </div>

            <!-- Message input -->
           <div class="mt-2">
    <form wire:submit.prevent="submit">
        <div class="position-relative">
            <textarea 
                class="form-control pe-5" 
                rows="1"
                wire:model.defer="newMessage"
                wire:key="message-input-{{ now() }}" 
                wire:keydown.enter="submit"
                placeholder="Type your message..."></textarea>

            <!-- Send button inside textarea -->
            <button type="submit" 
                class="btn btn-primary btn-sm position-absolute top-50 end-0 translate-middle-y me-2"
                style="padding: 4px 8px;">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </form>
</div>

        </div>

    </div>
    <!-- Chat toast END -->

</div>
@endif
        <!-- Chat END -->
    </div>

   <script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', () => {
            const chat = document.getElementById('chat-container');
            if (chat) {
                chat.scrollTop = chat.scrollHeight; // Jump to latest message
            }
        });
    });
</script>
