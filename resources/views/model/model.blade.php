@foreach ($users as $data)
    <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are Want to Delete this users??
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form action="{{ route('users.destroy', $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" >
                            Yes, Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach

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