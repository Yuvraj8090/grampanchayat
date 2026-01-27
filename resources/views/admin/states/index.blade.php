<x-app-layout title="States Management">
    <x-slot name="header">
        {{ __('States Management') }}
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-map me-2 text-primary"></i> State List
            </h2>
            <button type="button" class="btn btn-primary shadow-sm" id="createNewState">
                <i class="fas fa-plus me-1"></i> Add New State
            </button>
        </div>

        {{-- DataTable --}}
        <x-datatable id="state-table" :route="route('admin.states.index')" :columns="[
            ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
            ['data' => 'name', 'title' => 'State Name'],
            ['data' => 'state_code', 'title' => 'State Code'],
            ['data' => 'is_active', 'title' => 'Status'],
            ['data' => 'action', 'title' => 'Actions', 'class' => 'text-end']
        ]" />
    </div>

    <div class="modal fade" id="stateModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalHeading">Add New State</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="stateForm">
                    <div class="modal-body">
                        <input type="hidden" name="state_id" id="state_id">

                        <div class="mb-3">
                            <label class="form-label fw-bold">State Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Uttarakhand" required>
                            <span class="text-danger small" id="nameError"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">State Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="state_code" name="state_code" placeholder="e.g. UK" required>
                            <span class="text-danger small" id="stateCodeError"></span>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="module">
        $(function () {
            // Setup CSRF Token
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            const stateModal = new bootstrap.Modal(document.getElementById('stateModal'));
            const getTable = () => window.LaravelDataTables["state-table"];

            // --- SweetAlert Toast Config ---
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            // --- 1. OPEN CREATE MODAL ---
            $('#createNewState').click(function () {
                $('#state_id').val('');
                $('#stateForm').trigger("reset");
                $('.text-danger').text('');
                $('#modalHeading').html("Add New State");
                $('#saveBtn').prop('disabled', false).html('Save Changes');
                stateModal.show();
            });

            // --- 2. OPEN EDIT MODAL ---
            $('body').on('click', '.editState', function () {
                const id = $(this).data('id');
                const url = "{{ route('admin.states.index') }}" + '/' + id + '/edit';
                
                // Show button as loading initially
                $('#saveBtn').prop('disabled', false).html('Save Changes'); 
                $('.text-danger').text('');
                
                $.get(url, function (data) {
                    $('#modalHeading').html("Edit State");
                    $('#state_id').val(data.id);
                    $('#name').val(data.name);
                    $('#state_code').val(data.state_code);
                    stateModal.show();
                });
            });

            // --- 3. STORE & UPDATE (With Button Loading State) ---
            $('#stateForm').on('submit', function (e) {
                e.preventDefault();

                // 1. LOADING START: Disable button and show spinner 
                let $btn = $('#saveBtn');
                let originalText = $btn.text();
                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                
                $('.text-danger').text('');

                $.ajax({
                    data: $(this).serialize(),
                    url: "{{ route('admin.states.store') }}",
                    type: "POST",
                    success: function (data) {
                        // 2. SUCCESS: Clean up
                        $('#stateForm').trigger("reset");
                        stateModal.hide();
                        
                        // 3. REFRESH TABLE: Only happens after response
                        getTable().draw(false); 
                        
                        // 4. RESET BUTTON
                        $btn.prop('disabled', false).html(originalText);
                        
                        // 5. SHOW TOAST
                        Toast.fire({
                            icon: 'success',
                            title: data.success || 'Saved Successfully'
                        });
                    },
                    error: function (xhr) {
                        // 2. ERROR: Reset button so user can try again
                        $btn.prop('disabled', false).html(originalText);
                        
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            if (errors.name) $('#nameError').text(errors.name[0]);
                            if (errors.state_code) $('#stateCodeError').text(errors.state_code[0]);
                            Toast.fire({ icon: 'warning', title: 'Check validation errors.' });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong!' });
                        }
                    }
                });
            });

            // --- 4. DELETE STATE (With SweetAlert Loader) ---
            $('body').on('click', '.deleteState', function () {
                const id = $(this).data('id');
                const url = "{{ route('admin.states.index') }}" + '/' + id;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    showLoaderOnConfirm: true, // <--- ENABLES LOADING STATE
                    preConfirm: () => {
                        // This returns a Promise. SweetAlert waits for it to resolve/reject.
                        return $.ajax({
                            type: "DELETE",
                            url: url,
                        }).catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error.responseJSON ? error.responseJSON.error : 'Server Error'}`
                            )
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading() // Prevent closing while loading
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Only runs if AJAX was successful
                        
                        // 1. REFRESH TABLE
                        getTable().draw(false);

                        // 2. SHOW SUCCESS MESSAGE
                        Swal.fire(
                            'Deleted!',
                            result.value.success || 'State deleted successfully.',
                            'success'
                        );
                    }
                });
            });
        });
    </script>
</x-app-layout>