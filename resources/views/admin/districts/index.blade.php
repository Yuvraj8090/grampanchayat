<x-app-layout title="Districts Management">
    <x-slot name="header">
        {{ __('Districts of Uttarakhand') }}
    </x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-map-marker-alt me-2 text-primary"></i> District List
            </h2>
            <button type="button" class="btn btn-primary shadow-sm" id="createNewDistrict">
                <i class="fas fa-plus me-1"></i> Add New District
            </button>
        </div>

        {{-- Added 'state_name' to columns array --}}
        <x-datatable id="district-table" :route="route('admin.districts.index')" :columns="[
            ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
            ['data' => 'state_name', 'title' => 'State'], 
            ['data' => 'name', 'title' => 'District Name'],
            ['data' => 'district_code', 'title' => 'Census Code'],
            ['data' => 'is_active', 'title' => 'Status'],
            ['data' => 'action', 'title' => 'Actions', 'class' => 'text-end']
        ]" />
    </div>

    <div class="modal fade" id="districtModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalHeading">Add New District</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="districtForm">
                    <div class="modal-body">
                        <input type="hidden" name="district_id" id="district_id">

                        <div class="mb-3">
                            <label class="form-label fw-bold">State <span class="text-danger">*</span></label>
                            <select name="state_id" id="state_id" class="form-select" required>
                                <option value="">-- Select State --</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" id="stateIdError"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">District Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <span class="text-danger small" id="nameError"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Census Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="district_code" name="district_code" required>
                            <span class="text-danger small" id="districtCodeError"></span>
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

            // Initialize Bootstrap Modal
            const districtModal = new bootstrap.Modal(document.getElementById('districtModal'));
            const getTable = () => window.LaravelDataTables["district-table"];

            // --- 1. OPEN CREATE MODAL ---
            $('#createNewDistrict').click(function () {
                $('#district_id').val('');
                $('#districtForm').trigger("reset");
                $('.text-danger').text('');
                $('#modalHeading').html("Add New District");
                
                districtModal.show();
            });

            // --- 2. OPEN EDIT MODAL ---
            $('body').on('click', '.editDistrict', function () {
                const id = $(this).data('id');
                const url = "{{ route('admin.districts.index') }}" + '/' + id + '/edit';
                
                $.get(url, function (data) {
                    $('#modalHeading').html("Edit District");
                    
                    // Fill form data
                    $('#district_id').val(data.id);
                    $('#state_id').val(data.state_id); // Fill State Dropdown
                    $('#name').val(data.name);
                    $('#district_code').val(data.district_code);
                    $('.text-danger').text('');
                    
                    districtModal.show();
                });
            });

            // --- 3. STORE & UPDATE ---
            $('#districtForm').on('submit', function (e) {
                e.preventDefault();
                $('#saveBtn').html('<i class="fas fa-spinner fa-spin"></i> Saving...').prop('disabled', true);
                $('.text-danger').text('');

                $.ajax({
                    data: $(this).serialize(),
                    url: "{{ route('admin.districts.store') }}",
                    type: "POST",
                    success: function (data) {
                        $('#districtForm').trigger("reset");
                        districtModal.hide();
                        getTable().draw();
                        $('#saveBtn').html('Save Changes').prop('disabled', false);
                        
                        // Optional: Toast or SweetAlert here
                        alert(data.success);
                    },
                    error: function (xhr) {
                        $('#saveBtn').html('Save Changes').prop('disabled', false);
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            if (errors.state_id) $('#stateIdError').text(errors.state_id[0]);
                            if (errors.name) $('#nameError').text(errors.name[0]);
                            if (errors.district_code) $('#districtCodeError').text(errors.district_code[0]);
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            // --- 4. DELETE DISTRICT ---
            $('body').on('click', '.deleteDistrict', function () {
                const id = $(this).data('id');
                const url = "{{ route('admin.districts.index') }}" + '/' + id;

                if (confirm("Are you sure you want to delete this district?")) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function (data) {
                            getTable().draw();
                            alert(data.success);
                        },
                        error: function (xhr) {
                            alert('Error deleting record');
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>