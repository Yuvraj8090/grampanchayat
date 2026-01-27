<x-app-layout title="States Management">
    <x-slot name="header">
        {{ __('States Management') }}
    </x-slot>

    {{-- ✅ 1. INLINE CSS (Ensures Toasts are Visible & On Top) --}}
    <style>
        /* Container fixed to top-right */
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999; /* Force it above Bootstrap Modals */
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Toast Card Style */
        .toast-notification {
            min-width: 320px;
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); /* Stronger shadow */
            border-left: 6px solid #ccc;
            display: flex;
            align-items: center;
            opacity: 0;
            transform: translateX(100%); /* Start off-screen */
            animation: slideIn 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards; /* Bouncy animation */
        }

        /* Types */
        .toast-success { border-left-color: #198754; }
        .toast-error   { border-left-color: #dc3545; }

        /* Icons */
        .toast-icon { margin-right: 15px; font-size: 1.4rem; display: flex; align-items: center; }
        .toast-success .toast-icon { color: #198754; }
        .toast-error .toast-icon   { color: #dc3545; }

        /* Text */
        .toast-text { font-weight: 600; color: #333; font-size: 0.95rem; }

        /* Animation Keyframes */
        @keyframes slideIn {
            to { opacity: 1; transform: translateX(0); }
        }
        
        /* Hiding Class */
        .toast-hiding {
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.4s ease;
        }
    </style>

    {{-- ✅ 2. HTML CONTAINER (Must exist for jQuery to append to) --}}
    <div id="toast-container"></div>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-map me-2 text-primary"></i> State List
            </h2>
            <button type="button" class="btn btn-primary shadow-sm" id="createNewState">
                <i class="fas fa-plus me-1"></i> Add New State
            </button>
        </div>

        <x-datatable id="state-table" :route="route('admin.states.index')" :columns="[
            ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
            ['data' => 'name', 'title' => 'State Name'],
            ['data' => 'state_code', 'title' => 'State Code'],
            ['data' => 'is_active', 'title' => 'Status'],
            ['data' => 'action', 'title' => 'Actions', 'class' => 'text-end']
        ]" />
    </div>

    <div class="modal fade" id="stateModal" tabindex="-1" aria-hidden="true">
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
                            <input type="text" class="form-control" id="name" name="name" required>
                            <span class="text-danger small" id="nameError"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">State Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="state_code" name="state_code" required>
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
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        const stateModal = new bootstrap.Modal(document.getElementById('stateModal'));
        const getTable = () => window.LaravelDataTables["state-table"];

        // ✅ 3. DEBUGGED TOAST FUNCTION
        window.showToast = function(type, message) {
            // Check if container exists, if not, create it dynamically
            if ($('#toast-container').length === 0) {
                $('body').append('<div id="toast-container"></div>');
            }

            let icon = type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-triangle"></i>';
            
            // Safe HTML construction
            let toastHtml = `
                <div class="toast-notification toast-${type}">
                    <div class="toast-icon">${icon}</div>
                    <div class="toast-text">${message}</div>
                </div>`;
            
            let $toast = $(toastHtml);
            
            // Append
            $('#toast-container').append($toast);
            
            // Remove after delay
            setTimeout(() => {
                $toast.addClass('toast-hiding'); // Trigger CSS exit animation
                setTimeout(() => {
                    $toast.remove(); // Remove from DOM
                }, 400); 
            }, 3500);
        };

        // --- CREATE ---
        $('#createNewState').click(function () {
            $('#state_id').val('');
            $('#stateForm').trigger("reset");
            $('.text-danger').text('');
            $('#modalHeading').html("Add New State");
            $('#saveBtn').prop('disabled', false);
            stateModal.show();
        });

        // --- EDIT ---
        $('body').on('click', '.editState', function () {
            const id = $(this).data('id');
            const url = "{{ route('admin.states.index') }}" + '/' + id + '/edit';
            $('.text-danger').text('');
            
            $.get(url, function (data) {
                $('#modalHeading').html("Edit State");
                $('#state_id').val(data.id);
                $('#name').val(data.name);
                $('#state_code').val(data.state_code);
                stateModal.show();
            });
        });

        // --- STORE / UPDATE ---
        $('#stateForm').on('submit', function (e) {
            e.preventDefault();
            $('#saveBtn').html('<i class="fas fa-spinner fa-spin"></i> Saving...').prop('disabled', true);
            $('.text-danger').text('');

            $.ajax({
                data: $(this).serialize(),
                url: "{{ route('admin.states.store') }}",
                type: "POST",
                success: function (data) {
                    $('#stateForm').trigger("reset");
                    stateModal.hide();
                    getTable().draw(false);
                    $('#saveBtn').html('Save Changes').prop('disabled', false);
                    
                    // ✅ SUCCESS HANDLING
                    if(data.success) {
                        showToast('success', data.success);
                    }
                },
                error: function (xhr) {
                    $('#saveBtn').html('Save Changes').prop('disabled', false);
                    
                    // ✅ ERROR HANDLING (422 or 500)
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        if (errors.name) $('#nameError').text(errors.name[0]);
                        if (errors.state_code) $('#stateCodeError').text(errors.state_code[0]);
                        showToast('error', 'Please fix validation errors.');
                    } else {
                        showToast('error', 'Something went wrong. Please try again.');
                    }
                }
            });
        });

        // --- DELETE ---
        $('body').on('click', '.deleteState', function () {
            const id = $(this).data('id');
            const url = "{{ route('admin.states.index') }}" + '/' + id;

            if (confirm("Are you sure?")) {
                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function (data) {
                        getTable().draw(false);
                        
                        // ✅ SUCCESS HANDLING
                        if(data.success) {
                            showToast('success', data.success);
                        }
                    },
                    error: function (xhr) {
                        // ✅ ERROR HANDLING (Custom logic from Controller)
                        let msg = 'Error deleting record.';
                        if(xhr.responseJSON && xhr.responseJSON.error) {
                            msg = xhr.responseJSON.error;
                        }
                        showToast('error', msg);
                    }
                });
            }
        });
    });
</script>
</x-app-layout>