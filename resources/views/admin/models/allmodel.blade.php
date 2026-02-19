<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="button" id="confirmDeleteBtn" class="btn btn-danger">
                    Yes, Delete
                </button>
            </div>

        </div>
    </div>
</div>

{{-- Export-logic --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {

        deleteId = null;

        window.setDeleteId = function(id) {
            deleteId = id;
        };

        document.getElementById("confirmDeleteBtn").addEventListener("click", function() {

            if (!deleteId) return;

            fetch(`{{ url('users') }}/${deleteId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error("Request failed");
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(err => console.error("Delete error:", err));
        });

    });
</script>



<!-- EXPORT MODAL -->

<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Select Export Format</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <a href="{{ route('users.export.csv') }}" class="btn btn-success m-2 px-4" onclick="closeExportModal()">
                    Export CSV
                </a>

                <a href="{{ route('users.export.pdf') }}" class="btn btn-danger m-2 px-4" onclick="closeExportModal()">
                    Export PDF
                </a>

                <a href="{{ route('users.export.excel') }}" class="btn btn-primary m-2 px-4" onclick="closeExportModal()">
                    Export EXCEL
                </a>

            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        var exportModalEl = document.getElementById('exportModal');

        if (exportModalEl) {

            var exportModal = new bootstrap.Modal(exportModalEl);

            exportModalEl.addEventListener('hidden.bs.modal', function() {
                document.querySelector('#openExportBtn')?.focus();
            });

        }
    });
    function closeExportModal() {
        var modalEl = document.getElementById('exportModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) {
            modal.hide();
        }
    }
</script>
