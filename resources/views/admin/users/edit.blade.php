<x-app-layout title="Edit User">
    <x-slot name="header">{{ __('Edit User') }}</x-slot>

    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h5 class="mb-3 text-primary border-bottom pb-2">Account Details</h5>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role_id" class="form-select">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <h5 class="mb-3 text-primary border-bottom pb-2">Location Assignment</h5>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">State <span class="text-danger">*</span></label>
                            <select name="state_id" id="state_id" class="form-select" required>
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ optional($location)->state_id == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">District</label>
                            <select name="district_id" id="district_id" class="form-select"
                                data-selected="{{ optional($location)->district_id }}" disabled>
                                <option value="">Select District</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Block</label>
                            <select name="block_id" id="block_id" class="form-select"
                                data-selected="{{ optional($location)->block_id }}">
                                <option value="">Select Block</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Panchayat</label>
                            <select name="panchayat_id" id="panchayat_id" class="form-select"
                                data-selected="{{ optional($location)->panchayat_id }}">
                                <option value="">Select Panchayat</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <button type="submit" class="btn btn-primary px-4">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            // --- Configuration ---
            const url = "{{ route('admin.get.locations') }}";

            // --- Helper Function: Reset Dropdown ---
            function resetDropdown(selector, placeholder) {
                $(selector).html('<option value="">' + placeholder + '</option>');
                $(selector).prop('disabled', true); // Disable until parent is selected
            }

            // --- Helper Function: Load Data ---
            function loadData(type, parentId, targetSelector, placeholder, selectedId = null) {
                if (!parentId) {
                    resetDropdown(targetSelector, placeholder);
                    return;
                }

                // Show "Loading..." indicator
                $(targetSelector).html('<option value="">Loading...</option>');
                $(targetSelector).prop('disabled', false);

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        type: type,
                        parent_id: parentId
                    },
                    success: function(data) {
                        let options = '<option value="">' + placeholder + '</option>';

                        if (data.length > 0) {
                            $.each(data, function(key, val) {
                                let isSelected = (selectedId == val.id) ? 'selected' : '';
                                options +=
                                    `<option value="${val.id}" ${isSelected}>${val.name}</option>`;
                            });
                        } else {
                            options = '<option value="">No data found</option>';
                        }

                        $(targetSelector).html(options);
                    },
                    error: function() {
                        $(targetSelector).html('<option value="">Error loading data</option>');
                    }
                });
            }

            // ==========================================
            // EVENT LISTENERS (The Cascade Logic)
            // ==========================================

            // 1. When State Changes
            $('#state_id').change(function() {
                let stateId = $(this).val();

                // Load Districts
                loadData('district', stateId, '#district_id', 'Select District');

                // CLEAR downstream (Block & Panchayat)
                resetDropdown('#block_id', 'Select Block (Choose District First)');
                resetDropdown('#panchayat_id', 'Select Panchayat (Choose Block First)');
            });

            // 2. When District Changes
            $('#district_id').change(function() {
                let districtId = $(this).val();

                // Load Blocks
                loadData('block', districtId, '#block_id', 'Select Block');

                // CLEAR downstream (Panchayat)
                resetDropdown('#panchayat_id', 'Select Panchayat (Choose Block First)');
            });

            // 3. When Block Changes
            $('#block_id').change(function() {
                let blockId = $(this).val();

                // Load Panchayats
                loadData('panchayat', blockId, '#panchayat_id', 'Select Panchayat');
            });

            // ==========================================
            // INITIALIZATION (For Edit Page)
            // ==========================================
            // If we are on the Edit page, we might have pre-selected values.
            // We use 'data-selected' attributes on the <select> HTML elements if they exist.

            let initialState = $('#state_id').val();
            let initialDistrict = $('#district_id').data('selected');
            let initialBlock = $('#block_id').data('selected');
            let initialPanchayat = $('#panchayat_id').data('selected');

            if (initialState && initialDistrict) {
                loadData('district', initialState, '#district_id', 'Select District', initialDistrict);
                $('#district_id').prop('disabled', false);
            }

            if (initialDistrict && initialBlock) {
                loadData('block', initialDistrict, '#block_id', 'Select Block', initialBlock);
                $('#block_id').prop('disabled', false);
            }

            if (initialBlock && initialPanchayat) {
                loadData('panchayat', initialBlock, '#panchayat_id', 'Select Panchayat', initialPanchayat);
                $('#panchayat_id').prop('disabled', false);
            }
        });
    </script>

</x-app-layout>
