<div class="card mb-4">
    <div class="card-body">
        <div class="messageSender">
            <div class="messageSender__top d-flex align-items-center mb-3">
                <img class="rounded-circle me-2" src="{{ asset('storage/profile_pictures/' . auth()->user()->profile_picture ?? 'default.png') }}" width="40" height="40" alt="">
                <form>
                    <input class="form-control messageSender__input" placeholder="What's on your mind?" type="text" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                </form>
            </div>
            <div class="messageSender__bottom d-flex justify-content-between">
                <div class="messageSender__option text-center">
                    <span style="color: red" class="material-icons"> videocam </span>
                    <h6 data-bs-toggle="modal" data-bs-target="#exampleModal" class="mt-2">Live</h6>
                </div>

                <div class="messageSender__option text-center">
                    <span style="color: green" class="material-icons"> photo_library </span>
                    <h6 data-bs-toggle="modal" data-bs-target="#exampleModal" class="mt-2">Photo</h6>
                </div>

                <div class="messageSender__option text-center">
                    <span style="color: orange" class="material-icons"> attachment</span>
                    <h6 data-bs-toggle="modal" data-bs-target="#exampleModal1" class="mt-2">Attach Media</h6>
                </div>
            </div>
        </div>
    </div>
</div>
