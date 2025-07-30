<!-- Right sidebar START -->
<div class="col-lg-3 right-sidebar">
    <div class="row g-4">
        <!-- Card follow START -->

        <!-- Card News START -->
        <div class="col-sm-6 col-lg-12">
            <div class="card">
                <!-- Card header START -->
                <div class="card-header pb-0 border-0">
                    <h5 class="card-title mb-0">Broadcasts</h5>
                </div>
                <!-- Card header END -->
                <!-- Card body START -->
                <div class="card-body  overflow-auto" style="max-height: 500px;">
                    <!-- News item -->
                    @if((isset($broadcast)) && ($broadcast->count() > 0))
                    @foreach($broadcast as $index => $broadcast)
                    <div class="mb-3">

                        <div class="d-flex align-items-center gap-2 mb-2">
                                   @if($broadcast->image_url)
                                <img class="avatar-img rounded"
                                    src="{{ asset('storage/' . $broadcast->image_url) }}" alt="" height="45"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $broadcast->title }}" style="height: 85px; object-fit: cover;">
                                      @else
                                  <img src="{{ asset('assets/images/no-image.png') }}" width="45"
                                        class="rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="No image available" alt="No image">
                                    @endif

                        </div>

                        <h6 class="mb-0"><a href="{{ route('user.broadcastDetails', $broadcast->id) }}">{{ $broadcast->title }}</a></h6>
                        <small>{{ \Illuminate\Support\Str::limit($broadcast->description, 50) }} <span><a href="{{ route('user.broadcastDetails', $broadcast->id) }}" class="text-danger">View more</a></span></small>
                    </div>
                    <hr>
                    @endforeach
                    <span class="divider"></span>
                    @else
                    <div class="mb-3">
                        <p class="mb-0 text-muted">No broadcasts available</p>
                    </div>
                    @endif
                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Card News END -->
        <!-- Card follow START -->
        <div class="col-sm-6 col-lg-12">
            <div class="card">
                <!-- Card header START -->
                <div class="card-header d-sm-flex justify-content-between border-0">
                <h5 class="card-title">Groups</h5>
                <a class="btn btn-primary-soft btn-sm" href="" data-bs-toggle="modal" data-bs-target="#groupModal"> Create groups</a>

              </div>
                <!-- Card header END -->
                <!-- Card body START -->
                <div class="card-body">
                    <!-- Connection item START -->
                    @if(isset($groupNames) && $groupNames->count() > 0)
                    @foreach($groupNames as $index => $recent)
                    <div class="hstack gap-2 mb-3">
                        <!-- Title -->
                        <div class="overflow-hidden">
                            <a class="mb-0" href="{{ route('user.group-post', $recent->id) }}">{{ $recent->name}}</a>
                        </div>
                        <!-- Button -->
                        <a class="btn btn-primary-soft rounded-circle icon-md ms-auto open-group-post-modal" href="#"
                            data-bs-toggle="modal" data-bs-target="#groupActionpost"
                            data-group-name="{{ $recent->name }}"  data-group-id="{{ $recent->id }}">
                            <i class="fa-solid fa-plus"></i>
                        </a>

                    </div>
                    @endforeach
                    @else
                    <p class="text-muted">No recent groups available</p>
                    @endif

                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Card follow START -->
         <!-- <div class="footer-widget footer-contact">
  <h5 class="footer-title">Newsletter</h5>
  <div class="subscribe-input">
    <form action="javascript:void(0);">
      <div class="input-group">
        <input type="email" class="form-control" placeholder="Enter your Email Address">
        <button type="submit" class="btn btn-primary btn-sm">
          <i class="isax isax-send-2 me-1"></i>Subscribe
        </button>
      </div>
    </form>
  </div>
</div> -->
    </div>
</div>

<!-- Group Modal -->
<div class="modal fade" id="groupModal" tabindex="-1" aria-labelledby="groupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="groupForm" action="{{ route('user.group.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title text-white" id="groupModalLabel">Create Group</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="groupName" class="form-label">Group Name</label>
            <input type="text" class="form-control" id="groupName" name="group_name" placeholder="Enter group name" required>
          </div>

          <!-- Alpine.js (Make sure it's included in your layout or this page) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div x-data="memberSelector()" class="mb-3">
    <label class="form-label">Member Names</label>

    <!-- Input field for typing and selecting -->
    <input type="text"
           class="form-control"
           placeholder="Type name and press Enter"
           x-model="newMember"
           list="membersList"
           @keydown.enter.prevent="addMember">

    <!-- Autocomplete list -->
    <datalist id="membersList">
        <template x-for="member in allMembers" :key="member.id">
            <option :value="member.name"></option>
        </template>
    </datalist>

    <!-- Selected tags -->
    <div class="mt-2">
        <template x-for="(member, index) in selectedMembers" :key="member.id">
            <span class="badge bg-primary me-1 mb-1">
                <span x-text="member.name"></span>
                <button type="button"
                        class="btn-close btn-close-white btn-sm ms-1"
                        @click="removeMember(index)">
                </button>
                <input type="hidden" name="member_ids[]" :value="member.id">
            </span>
        </template>
    </div>
</div>

<script>
function memberSelector() {
    return {
        newMember: '',
        selectedMembers: [],
        allMembers: @json($members), // assuming each member has {id, name}

        addMember() {
            if (!this.newMember.trim()) return;

            const match = this.allMembers.find(m =>
                m.name.toLowerCase() === this.newMember.trim().toLowerCase()
            );

            if (match && !this.selectedMembers.some(m => m.id === match.id)) {
                this.selectedMembers.push(match);
            }

            this.newMember = '';
        },

        removeMember(index) {
            this.selectedMembers.splice(index, 1);
        }
    }
}
</script>


        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Create Group</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
	 document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('groupActionpost');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const groupName = button.getAttribute('data-group-name');
            console.log(groupName);
           const groupId = button.getAttribute('data-group-id');
           console.log(groupId);


        // Set hidden input value
        modal.querySelector('.group_id').value = groupId;
            //console.log(groupName); // Debugging line to check group name
            const modalTitleSpan = modal.querySelector('.group_name');

            if (modalTitleSpan) {
                modalTitleSpan.textContent = groupName;
            }
        });
    });
</script>
<!-- Right sidebar END -->
