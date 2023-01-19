{{-- Modal DELETE --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            {{-- Heading --}}
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModalLabel">Warning</h4>
                {{-- Close pop-up --}}
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- Question --}}
            <div class="modal-body">
                <p>Are you sure you want to cancel: <span id="modal-project-title"></span>?</p>
            </div>

            {{-- Answers --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="delete">Yes, I want to cancel</button>
            </div>

        </div>
    </div>
</div>
