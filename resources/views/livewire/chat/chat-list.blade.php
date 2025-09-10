<div>
    <!-- Button -->

    <!-- Chat sidebar START -->

    <!-- Offcanvas header -->
    <div class="offcanvas-header d-flex justify-content-between">
        <h5 class="offcanvas-title"> Mentor/Mentee Conversation</h5>
        <div class="d-flex">
            <!-- Close  -->
            <a href="#" class="btn btn-secondary-soft-hover d-flex align-items-center justify-content-center p-0"
                style="width:32px; height:32px;" data-bs-dismiss="offcanvas" aria-label="Close">
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
                                <li class="mt-3 hstack gap-3 align-items-center position-relative select_user_click toast-btn user-id{{ $chat->member_id }}"
                                    style=" {{ $selectedChat == $chat->member_id ? 'background-color: #af2910; padding: 5px; border-radius: 10px;' : '' }}"
                                    data-target="chatToast-{{ $chat->member_id }}" data-user-id="{{ $chat->member_id }}"
                                    wire:click="selectChat({{ $chat->member_id }})" wire:key="chat-{{ $chat->member_id }}"
                                    style="cursor: pointer;{{ $selectedChat == $chat->member_id ? 'background-color: #af2910; padding: 5px; border-radius: 10px;' : '' }}">

                                    {{-- new code needed to test --}}

                                    {{--
                                <li class="mt-3 hstack gap-3 align-items-center position-relative toast-btn"
                                    style="cursor: pointer; {{ $selectedChat == $chat->member_id ? 'background-color: #af2910;' : '' }}"
                                    data-target="chatToast-{{ $chat->member_id }}"
                                    wire:click="selectChat({{ $chat->member_id }})" wire:key="chat-{{ $chat->member_id }}"> --}}

                                    <!-- Avatar -->
                                    <div class="avatar">
                                        <!--status-online-->
                                        @php
                                            $profileImage = '';
                                            $user = App\Models\Member::find($chat->member_id);

                                            if (
                                                $user && !empty($user->profile_pic) &&
                                                Storage::disk('public')->exists($user->profile_pic)
                                            ) {
                                                $profileImage = asset('storage/' . $user->profile_pic);
                                            } else {
                                                $profileImage = asset('feed_assets/images/avatar/07.jpg');
                                            }
                                            $isOnline = $user->is_online == 1 && $user->last_seen;

                                            // Compact diff for humans
                                            $lastSeen = '';
                                            if (!$isOnline && $user->last_seen) {
                                                $diff = now()->diff($user->last_seen);
                                                if ($diff->d >= 1) {
                                                    $lastSeen = $diff->d . 'd'; // days
                                                } elseif ($diff->h >= 1) {
                                                    $lastSeen = $diff->h . 'h'; // hours
                                                } elseif ($diff->i >= 1) {
                                                    $lastSeen = $diff->i . 'm'; // minutes
                                                } else {
                                                    $lastSeen = 'just now';
                                                }
                                            }   

                                        @endphp


                                        <div class="avatar ">
                                            <img class="avatar-img rounded-circle" src="{{ $profileImage }}" alt="">

                                            @if($isOnline)
                                                <!-- Green circle for online -->
                                                <span
                                                    style="position:absolute; bottom:0; right:0; width:15px; height:15px; background-color:#28a745; border:2px solid #fff; border-radius:50%;"></span>
                                            @else
                                                <!-- Last seen compact -->
                                                <span
                                                    class="position-absolute bottom-0 end-0 small text-dark {{ $selectedChat == $chat->member_id ? 'text-dark' : '' }}"
                                                    style="background-color: #c5c3c3ff; border-radius: 50%; padding: 2px 4px; font-size: 10px; border:1px solid #ccc;">
                                                    {{ $lastSeen ?: 'Offline' }}
                                                </span>
                                            @endif
                                        </div>



                                        <!-- <img class="avatar-img rounded-circle" src="{{ $profileImage }}" alt=""> -->
                                    </div>
                                    <!-- Info -->
                                    <div class="overflow-hidden">
                                        <a class="h6 mb-0 stretched-link {{ $selectedChat == $chat->member_id ? 'text-white' : '' }}"
                                            href="#!">{{ $chat->name }}
                                            @if ($selectedChat != $chat->member_id)
                                                <span id="unread-count-{{ $chat->member_id }}">
                                                    {{ App\Models\Member::find($chat->member_id)->unreadMessages->count() > 0 ? '(' . App\Models\Member::find($chat->member_id)->unreadMessages->count() . ')' : null }}
                                                </span>
                                            @endif
                                            <div class="small text-truncate">{{ $chat->role_type ?? '' }}</div>
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

    <div>
    <!-- Chat START -->
    @if($selectedChat)
        <div class="toast-container toast-chat d-flex gap-3 align-items-end">

            <!-- Chat toast START -->
            <div id="chatToast-{{ $selectedChat }}" class="toast mb-0 bg-mode fade show" role="alert"
                aria-live="assertive" aria-atomic="true" data-bs-autohide="false">

                <!-- Header -->
                <div class="toast-header bg-mode">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="d-flex">
                            <div class="flex-shrink-0 avatar me-2 position-relative">
                                @php
                                    $user = App\Models\Member::find($selectedChat);
                                    $profileImage = $user && $user->profile_pic && Storage::disk('public')->exists($user->profile_pic)
                                        ? asset('storage/'.$user->profile_pic)
                                        : asset('feed_assets/images/avatar/07.jpg');
                                    $lastSeen = $user && $user->last_seen ? \Carbon\Carbon::parse($user->last_seen)->diffForHumans() : null;
                                    $isOnline = $user->is_online == 1 && $user->last_seen;
                                @endphp
                                <img class="avatar-img rounded-circle" src="{{ $profileImage }}" alt="">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 mt-1">{{ $user->name ?? 'Unknown' }}</h6>
                                <div class="small text-secondary">
                                    @if($isOnline)
                                        <i class="fa-solid fa-circle text-success me-1"></i>Online
                                    @else
                                        <i class="fa-solid fa-circle text-secondary me-1"></i>{{ $lastSeen ?? 'Offline' }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-1">
                            <!-- Close -->
                            <button type="button"
                                class="btn btn-secondary-soft-hover d-flex align-items-center justify-content-center p-0"
                                style="width:32px; height:32px;" data-bs-dismiss="toast"
                                wire:click="closeChat({{ $selectedChat }})">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="toast-body collapse show" id="collapseChat-{{ $selectedChat }}">
                    <div class="chat-conversation-content custom-scrollbar h-200px" style="overflow-y:auto;"
                        id="chat-container-{{ $selectedChat }}">

                        @php
                            $groupedMessages = $chatMessages->groupBy(
                                fn($m) => \Carbon\Carbon::parse($m->created_at)->format('Y-m-d')
                            );
                        @endphp

                        @foreach ($groupedMessages as $date => $dailyMessages)
                            <!-- Date separator -->
                            <div class="text-center small my-2">
                                {{ \Carbon\Carbon::parse($date)->isToday() ? 'Today' : \Carbon\Carbon::parse($date)->format('M j, Y') }}
                            </div>

                            @foreach ($dailyMessages as $msg)
                                @if ($msg->sender_id != auth()->id())
                                    <!-- Received -->
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0 avatar avatar-xs me-2">
                                            <img class="avatar-img rounded-circle" src="{{ $profileImage }}" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex flex-column align-items-start">
                                                <div class="bg-light text-secondary p-2 px-3 rounded-2">
                                                    @if($msg->file_path)
                                                        @if($msg->file_type == 'image')
                                                            <img src="{{ asset('storage/'.$msg->file_path) }}" class=   "rounded mb-1" style="max-width:200px;">
                                                        @elseif($msg->file_type == 'video')
                                                            <video controls style="max-width:200px;">
                                                                <source src="{{ asset('storage/'.$msg->file_path) }}" type="video/mp4">
                                                            </video>
                                                        @else
                                                            <a href="{{ asset('storage/'.$msg->file_path) }}" target="_blank">
                                                                <i class="fa-solid fa-file"></i> {{ basename($msg->file_path) }}
                                                            </a>
                                                        @endif
                                                    @endif
                                                    {{ $msg->message }}
                                                </div>
                                                <div class="small my-1">{{ $msg->created_at->format('g:i A') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Sent -->
                                    <div class="d-flex justify-content-end text-end mb-1">
                                        <div class="d-flex flex-column align-items-end">
                                            <div class="text-white p-2 px-3 rounded-2" style="background:#af2910;">
                                                @if($msg->file_path)
                                                    @if($msg->file_type == 'image')
                                                        <img src="{{ asset('storage/'.$msg->file_path) }}" class="rounded mb-1" style="max-width:200px;">
                                                    @elseif($msg->file_type == 'video')
                                                        <video controls style="max-width:200px;">
                                                            <source src="{{ asset('storage/'.$msg->file_path) }}" type="video/mp4">
                                                        </video>
                                                    @else
                                                        <a href="{{ asset('storage/'.$msg->file_path) }}" target="_blank" class="text-white">
                                                            <i class="fa-solid fa-file"></i> {{ basename($msg->file_path) }}
                                                        </a>
                                                    @endif
                                                @endif
                                                {{ $msg->message }}
                                            </div>
                                            <div class="small my-1 text-secondary">{{ $msg->created_at->format('g:i A') }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>

                    <!-- Message input -->
                    <div class="chat-input mt-3 position-relative">
                        <form wire:submit.prevent="submit" class="d-flex align-items-center position-relative">

                            <!-- Input container -->
                            <div class="input-wrapper flex-grow-1 d-flex align-items-center bg-white rounded-pill px-3 py-2 shadow-sm">
                                
                                <!-- Hidden file input -->
                                <input type="file" id="chat-attachment" class="d-none"
                                    wire:model="attachment"
                                    accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.zip,.mp4,.mov,.avi,.mkv" />

                                <!-- Attachment button -->
                                <button type="button"
                                        onclick="document.getElementById('chat-attachment').click()"
                                        class="btn btn-light btn-sm me-2 d-flex align-items-center justify-content-center"
                                        style="width:36px; height:36px; border-radius:50%; font-size:16px; color:#555;">
                                    <i class="fa-solid fa-paperclip"></i>
                                </button>

                                <!-- Auto-expanding textarea -->
                                <textarea class="form-control border-0 flex-grow-1 bg-transparent"
                                        rows="1"
                                        wire:model.defer="newMessage"
                                        wire:key="chat-message-input-{{ now() }}"
                                        placeholder="Type a message..."
                                        style="resize:none; overflow:hidden; outline:none; font-size:14px; line-height:1.4;"></textarea>
                            </div>

                            <!-- Send button -->
                            <button type="submit"
                                    class="btn send-btn position-absolute d-flex align-items-center justify-content-center"
                                    style="width:44px; height:44px; border-radius:50%; right:10px; top:50%; transform: translateY(-50%); background:#af2910; color:#fff; border:none;">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>

                        <!-- File preview -->
                        @if ($attachment)
    <div class="mt-2 d-flex align-items-center gap-2">
        @if ($attachment instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            {{-- Preview before save --}}
            @if(str_starts_with($attachment->getMimeType(), 'image/'))
                <img src="{{ $attachment->temporaryUrl() }}" class="rounded border" style="max-height:80px;">
            @else
                <div class="p-2 border rounded small bg-light">
                    <i class="fa-solid fa-file me-1"></i> {{ $attachment->getClientOriginalName() }}
                </div>
            @endif
        @else
            {{-- Already saved file (after submit) --}}
            @if(in_array(pathinfo($attachment, PATHINFO_EXTENSION), ['jpg','jpeg','png','gif','webp']))
                <img src="{{ asset('storage/' . $attachment) }}" class="rounded border" style="max-height:80px;">
            @else
                <div class="p-2 border rounded small bg-light">
                    <i class="fa-solid fa-file me-1"></i> {{ basename($attachment) }}
                </div>
            @endif
        @endif

        <!-- Cancel/remove button -->
        <button type="button" wire:click="$set('attachment', null)" 
                class="btn btn-sm btn-outline-danger rounded-circle">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

                    </div>
                </div>
            </div>
            <!-- Chat toast END -->
        </div>
    @endif
    <!-- Chat END -->
</div>

</div>