@extends('layouts.app')

@section('title', 'Feedback/Grievence - Alumni | Lal Bahadur Shastri National Academy of Administration')

@section('content')
<div class="container">
    <div class="row g-4 py-4" style="margin-top:2rem;">

        <!-- Sidenav START -->
        @include('partials.left_sidebar')
        <!-- Sidenav END -->

        <!-- Main content START -->
        <div class="col-md-9 col-lg-6 vstack gap-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Feedback/Grievance</h5>
                    <a class="btn btn-primary" >
                        Submit Feedback
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr data-bs-toggle="collapse" data-bs-target=""
                                    class="accordion-toggle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <span
                                            class="badge">
                                           
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#commentModal">
                                            Add Comment
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="p-0">
                                        <div class="collapse" >
                                            <div class="p-3 bg-light" >
                                                <h6 class="mb-2">Comment History</h6>
                                                <div class="loading">Loading comments...</div>
                                                <ul class="list-group list-group-flush d-none"></ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="commentForm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Comment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="feedbackId" name="feedback_id">
        <textarea class="form-control" id="commentText" name="comment" rows="3" placeholder="Write your comment..."></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
  // Bind grievance ID to modal when clicking "Add Comment"
  document.querySelectorAll('[data-bs-target="#commentModal"]').forEach(button => {
    button.addEventListener("click", function () {
      let grievanceId = this.getAttribute("data-id");
      document.getElementById("feedbackId").value = grievanceId;
    });
  });

  // Lazy load comments when expanding collapse
  document.querySelectorAll('.collapse').forEach(collapseEl => {
    collapseEl.addEventListener('show.bs.collapse', function () {
      let container = this.querySelector('[data-comments]');
      let grievanceId = container.getAttribute('data-comments');
      let list = container.querySelector('ul');
      let loading = container.querySelector('.loading');

      if (!list.classList.contains("loaded")) {
        fetch(`/grievances/${grievanceId}/comments`)
          .then(res => res.json())
          .then(data => {
            loading.classList.add("d-none");
            list.classList.remove("d-none");
            list.innerHTML = "";
            data.forEach(c => {
              list.innerHTML += `
                <li class="list-group-item">
                  <strong>${c.user}:</strong> ${c.comment}
                  <small class="text-muted float-end">${c.created_at}</small>
                </li>
              `;
            });
            list.classList.add("loaded");
          })
          .catch(() => {
            loading.textContent = "Failed to load comments.";
          });
      }
    });
  });

  // Submit new comment via AJAX
  document.getElementById("commentForm").addEventListener("submit", function (e) {
    e.preventDefault();
    let feedbackId = document.getElementById("feedbackId").value;
    let comment = document.getElementById("commentText").value;

    fetch(`/grievances/${feedbackId}/comments`, {
      method: "POST",
      headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
      body: JSON.stringify({ comment })
    })
    .then(res => res.json())
    .then(data => {
      // Append comment to list immediately
      let container = document.querySelector(`[data-comments="${feedbackId}"] ul`);
      if (container) {
        container.innerHTML += `
          <li class="list-group-item">
            <strong>You:</strong> ${data.comment}
            <small class="text-muted float-end">${data.created_at}</small>
          </li>
        `;
      }
      document.getElementById("commentText").value = "";
      bootstrap.Modal.getInstance(document.getElementById("commentModal")).hide();
    });
  });
});

</script>