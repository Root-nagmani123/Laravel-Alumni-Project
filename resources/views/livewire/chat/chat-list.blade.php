<div>
    <!-- Button -->

    <!-- Chat sidebar START -->

    <!-- Offcanvas header -->
    <div
        class="offcanvas-header d-flex justify-content-between align-items-center bg-white shadow-sm rounded-top px-3 py-2">
        <h5 class="offcanvas-title fw-bold mb-0">Mentor/Mentee Conversation</h5>
        <button type="button"
            class="btn btn-light btn-circle d-flex align-items-center justify-content-center border-0 shadow-sm"
            style="width:36px; height:36px;" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-solid fa-xmark fs-5"></i>
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
                <div class="os-content" style="padding: 10px 24px 16px; height: 100%; width: 100%;">


                    <div class="position-relative mb-3">
                        <input type="text" class="form-control rounded-pill ps-5 pe-3 py-2 shadow-sm"
                            placeholder="Search users..." wire:model.live="search" aria-label="Search users" />
                        <span class="position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"
                            style="z-index:2;">
                            <i class="bi bi-search fs-5"></i>
                        </span>
                    </div>

                    <!-- Search contact END -->
                    @if($chats && $chats->isNotEmpty())
                    <ul class="list-unstyled mb-0">
                        @foreach ($chats as $key => $chat)
                        @php
                        $profileImage = '';
                        $user = App\Models\Member::find($chat->member_id);
                        if ($user && !empty($user->profile_pic) && Storage::disk('public')->exists($user->profile_pic))
                        {
                        $profileImage = asset('storage/' . $user->profile_pic);
                        } else {
                        $profileImage = asset('feed_assets/images/avatar/07.jpg');
                        }
                        $isOnline = $user->is_online == 1 && $user->last_seen;
                        $lastSeen = '';
                        if (!$isOnline && $user->last_seen) {
                        $diff = now()->diff($user->last_seen);
                        if ($diff->d >= 1) {
                        $lastSeen = $diff->d . 'd';
                        } elseif ($diff->h >= 1) {
                        $lastSeen = $diff->h . 'h';
                        } elseif ($diff->i >= 1) {
                        $lastSeen = $diff->i . 'm';
                        } else {
                        $lastSeen = 'just now';
                        }
                        }
                        $unreadCount = App\Models\Member::find($chat->member_id)->unreadMessages->count();
                        @endphp
                        <li class="d-flex align-items-center gap-3 px-2 py-2 mb-1 rounded position-relative select_user_click toast-btn user-id{{ $chat->member_id }} {{ $selectedChat == $chat->member_id ? 'bg-danger text-white shadow-sm' : 'bg-white' }} chat-list-item"
                            style="cursor:pointer; transition:background 0.2s; border: 1px solid #f1f1f1;"
                            data-target="chatToast-{{ $chat->member_id }}" data-user-id="{{ $chat->member_id }}"
                            wire:click="selectChat({{ $chat->member_id }})" wire:key="chat-{{ $chat->member_id }}"
                            tabindex="0" aria-label="Open chat with {{ $chat->name }}">
                            <div class="position-relative" style="min-width:48px;">
                                <img class="avatar-img rounded-circle border border-2 {{ $isOnline ? 'border-success' : 'border-secondary' }}"
                                    src="{{ $profileImage }}" alt="{{ $chat->name }}"
                                    style="width:44px; height:44px; object-fit:cover;">
                                @if($isOnline)
                                <span
                                    class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle"
                                    style="width:13px; height:13px;" title="Online"></span>
                                @else
                                <span
                                    class="position-absolute bottom-0 end-0 small text-dark bg-light border border-secondary rounded-circle px-1"
                                    style="font-size:10px;" title="Last seen">{{ $lastSeen ?: 'Offline' }}</span>
                                @endif
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center gap-2">
                                    <span
                                        class="fw-semibold text-truncate {{ $selectedChat == $chat->member_id ? 'text-white' : 'text-dark' }}"
                                        style="max-width:120px;">{{ $chat->name }}</span>
                                    @if ($unreadCount > 0 && $selectedChat != $chat->member_id)
                                    <span class="badge bg-danger ms-1"
                                        id="unread-count-{{ $chat->member_id }}">{{ $unreadCount }}</span>
                                    @endif
                                </div>
                                <div
                                    class="small text-truncate {{ $selectedChat == $chat->member_id ? 'text-light' : 'text-secondary' }}">
                                    {{ $chat->role_type ?? '' }}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <ul class="list-unstyled">
                        <li class="text-center mt-5">
                            <p class="text-danger fw-semibold">No user found.</p>
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
                                $profileImage = $user && $user->profile_pic &&
                                Storage::disk('public')->exists($user->profile_pic)
                                ? asset('storage/'.$user->profile_pic)
                                : asset('feed_assets/images/avatar/07.jpg');
                                $lastSeen = $user && $user->last_seen ?
                                \Carbon\Carbon::parse($user->last_seen)->diffForHumans() : null;
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
                    <div class="chat-conversation-content custom-scrollbar px-3 py-3"
                        style="overflow-y:auto; max-height:320px; background:#efeae2; border-radius:12px;"
                        id="chat-container-{{ $selectedChat }}">

                        @php
                        $groupedMessages = $chatMessages->groupBy(fn($m) =>
                        \Carbon\Carbon::parse($m->created_at)->format('Y-m-d')
                        );
                        @endphp

                        @foreach ($groupedMessages as $date => $dailyMessages)
                        <!-- Date separator -->
                        <div class="text-center position-relative my-3">
                            <span class="small text-muted bg-white px-3 py-1 rounded-pill shadow-sm">
                                {{ \Carbon\Carbon::parse($date)->isToday() ? 'Today' : \Carbon\Carbon::parse($date)->format('M j, Y') }}
                            </span>
                            <hr
                                class="position-absolute top-50 start-0 w-100 border-0 border-top border-light opacity-25">
                        </div>

                        @foreach ($dailyMessages as $msg)
                        @if ($msg->sender_id != auth()->guard('user')->id())
                        <!-- Received -->
                        <div class="d-flex align-items-end mb-2">
                            <div class="flex-shrink-0 avatar avatar-xs me-2">
                                <img class="avatar-img rounded-circle" src="{{ $profileImage }}" width="36" height="36"
                                    alt="">
                            </div>
                            <div class="d-flex flex-column align-items-start">
                                <div class="bg-light text-secondary p-2 px-3 rounded-2 shadow-sm"
                                    style="max-width:230px;">
                                    @if($msg->file_path)
                                    @if($msg->file_type == 'image')
                                    <img src="{{ asset('storage/'.$msg->file_path) }}" class="rounded mb-1"
                                        style="max-width:200px;">
                                    @elseif($msg->file_type == 'video')
                                    <video controls class="rounded mb-1" style="max-width:200px;">
                                        <source src="{{ asset('storage/'.$msg->file_path) }}" type="video/mp4">
                                    </video>
                                    @else
                                    <a href="{{ asset('storage/'.$msg->file_path) }}" target="_blank"
                                        class="d-block text-decoration-none">
                                        <i class="fa-solid fa-file me-1"></i> {{ basename($msg->file_path) }}
                                    </a>
                                    @endif
                                    @endif
                                    <div>{{ $msg->message }}</div>
                                </div>
                                <div class="small text-muted my-1">
                                    {{ $msg->created_at->format('g:i A') }}
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Sent -->
                        <div class="d-flex justify-content-end align-items-end mb-2">
                            <div class="d-flex flex-column align-items-end">
                                <div class="p-2 px-3 rounded-2 shadow-sm"
                                    style="background-color:#dcf8c6; max-width:250px; border-bottom-right-radius:4px;">
                                    @if($msg->file_path)
                                    @if($msg->file_type == 'image')
                                    <img src="{{ asset('storage/'.$msg->file_path) }}" class="rounded mb-1"
                                        style="max-width:200px;">
                                    @elseif($msg->file_type == 'video')
                                    <video controls class="rounded mb-1" style="max-width:200px;">
                                        <source src="{{ asset('storage/'.$msg->file_path) }}" type="video/mp4">
                                    </video>
                                    @else
                                    <a href="{{ asset('storage/'.$msg->file_path) }}" target="_blank"
                                        class="text-dark d-block text-decoration-none">
                                        <i class="fa-solid fa-file me-1"></i> {{ basename($msg->file_path) }}
                                    </a>
                                    @endif
                                    @endif
                                    <div>{{ $msg->message }}</div>
                                </div>
                                <div class="small text-muted my-1">
                                    {{ $msg->created_at->format('g:i A') }}
                                    <i class="fa-solid fa-check-double ms-1 text-primary"></i>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                    </div>


                    @if ($attachment)
                    <div class="mt-2 d-flex flex-wrap gap-3">

                        @if ($attachment instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                        {{-- Image Preview --}}
                        @if(str_starts_with($attachment->getMimeType(), 'image/'))
                        <div class="position-relative d-inline-block">
                            <img src="{{ $attachment->temporaryUrl() }}" class="rounded-3 shadow-sm border"
                                style="max-height:120px; max-width:160px; object-fit:cover;">
                            <button type="button" wire:click="$set('attachment', null)"
                                class="border rounded-circle position-absolute top-0 end-0 m-1 shadow"
                                style="width:26px; height:26px;">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        @else
                        {{-- File Preview --}}
                        <div class="d-flex align-items-center p-2 px-3 bg-white rounded-3 shadow-sm border">
                            <i class="fa-solid fa-file-alt fa-lg text-primary me-2"></i>
                            <div class="text-truncate" style="max-width:160px;">
                                <div class="fw-semibold small">{{ $attachment->getClientOriginalName() }}</div>
                                <div class="text-muted small">{{ number_format($attachment->getSize()/1024,1) }} KB
                                </div>
                            </div>
                            <button type="button" wire:click="$set('attachment', null)"
                                class="btn-link text-danger ms-2">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        @endif
                        @else
                        {{-- Existing File (from DB / storage) --}}
                        @if(in_array(pathinfo($attachment, PATHINFO_EXTENSION), ['jpg','jpeg','png','gif','webp']))
                        <div class="position-relative d-inline-block">
                            <img src="{{ asset('storage/' . $attachment) }}" class="rounded-3 shadow-sm border"
                                style="max-height:120px; max-width:160px; object-fit:cover;">
                            <button type="button" wire:click="$set('attachment', null)"
                                class="border rounded-circle position-absolute top-0 end-0 m-1 shadow"
                                style="width:26px; height:26px;">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        @else
                        <div class="d-flex align-items-center p-2 px-3 bg-white rounded-3 shadow-sm border">
                            <i class="fa-solid fa-file-alt fa-lg text-primary me-2"></i>
                            <div class="text-truncate" style="max-width:160px;">
                                <div class="fw-semibold small">{{ basename($attachment) }}</div>
                                <div class="text-muted small">Stored file</div>
                            </div>
                            <button type="button" wire:click="$set('attachment', null)"
                                class="btn btn-sm btn-link text-danger ms-2">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        @endif
                        @endif

                    </div>
                    @endif

                    <!-- Message input -->
                    <div class="chat-input mt-3 position-relative">
                        <form wire:submit.prevent="submit" class="d-flex align-items-center position-relative gap-2">
                            <div
                                class="input-wrapper flex-grow-1 d-flex align-items-center bg-white rounded-pill px-3 py-2 shadow-sm border border-1">
                                <input type="file" id="chat-attachment" class="d-none" wire:model="attachment"
                                    accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.zip,.mp4,.mov,.avi,.mkv" />
                                <button type="button" onclick="document.getElementById('chat-attachment').click()"
                                    class="btn btn-light btn-sm me-2 d-flex align-items-center justify-content-center"
                                    style="width:36px; height:36px; border-radius:50%; font-size:16px; color:#555;"
                                    aria-label="Attach file">
                                    <i class="fa-solid fa-paperclip"></i>
                                </button>
                                <textarea class="form-control border-0 flex-grow-1 bg-transparent" rows="1"
                                    wire:model.defer="newMessage" wire:key="chat-message-input-{{ now() }}"
                                    placeholder="Type a message..."
                                    style="resize:none; overflow:hidden; outline:none; font-size:14px; line-height:1.4;"></textarea>
                            </div>
                            <button type="submit"
                                class="btn send-btn d-flex align-items-center justify-content-center shadow-sm"
                                style="width:44px; height:44px; border-radius:50%; background:#af2910; color:#fff; border:none;"
                                aria-label="Send message">
                                <i class="fa-solid fa-paper-plane fs-5"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Chat toast END -->
        </div>
        @endif
        <!-- Chat END -->
    </div>

</div>