<x-app-layout title="Create User">
    <x-slot name="header">{{ __('Create New User') }}</x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-user-plus me-2 text-primary"></i> Add User
            </h2>
            <div class="btn-group shadow-sm">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <h5 class="mb-3 text-primary border-bottom pb-2">Account Details</h5>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Full Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required placeholder="Enter full name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Email Address <span
                                    class="text-danger">*</span></label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required placeholder="name@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Role <span
                                    class="text-danger">*</span></label>
                            <select name="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required
                                placeholder="Min 8 chars">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold text-secondary">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required
                                placeholder="Re-type password">
                        </div>
                    </div>

                    <h5 class="mb-3 text-primary border-bottom pb-2">Location Assignment</h5>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">State <span class="text-danger">*</span></label>
                            <select name="state_id" id="state_id"
                                class="form-select @error('state_id') is-invalid @enderror" required>
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">District</label>
                            <select name="district_id" id="district_id" class="form-select" disabled>
                                <option value="">Select State First</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Block</label>
                            <select name="block_id" id="block_id" class="form-select" disabled>
                                <option value="">Select District First</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Panchayat</label>
                            <select name="panchayat_id" id="panchayat_id" class="form-select" disabled>
                                <option value="">Select Block First</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-5 border-top pt-3 text-end">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light border px-4 me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-save me-1"></i> Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Ensure jQuery is loaded --}}


    <script>
        $(document).ready(function() {

            const url = "{{ route('admin.get.locations') }}";

            // --- Helper: Reset Dropdown ---
            function resetDropdown(selector, placeholder) {
                $(selector).html('<option value="">' + placeholder + '</option>');
                $(selector).prop('disabled', true);
            }

            // --- Helper: Fetch Data ---
            function loadData(type, parentId, targetSelector, placeholder) {
                if (!parentId) {
                    resetDropdown(targetSelector, placeholder);
                    return;
                }

                // UI Loading State
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
                                options += `<option value="${val.id}">${val.name}</option>`;
                            });
                        } else {
                            options = '<option value="">No ' + type + 's found</option>';
                        }

                        $(targetSelector).html(options);
                    },
                    error: function() {
                        $(targetSelector).html('<option value="">Error loading data</option>');
                    }
                });
            }

            // --- Event Listeners ---

            // 1. State Changed -> Load Districts
            $('#state_id').change(function() {
                let stateId = $(this).val();
                loadData('district', stateId, '#district_id', 'Select District');

                // Reset downstream
                resetDropdown('#block_id', 'Select District First');
                resetDropdown('#panchayat_id', 'Select Block First');
            });

            // 2. District Changed -> Load Blocks
            $('#district_id').change(function() {
                let districtId = $(this).val();
                loadData('block', districtId, '#block_id', 'Select Block');

                // Reset downstream
                resetDropdown('#panchayat_id', 'Select Block First');
            });

            // 3. Block Changed -> Load Panchayats
            $('#block_id').change(function() {
                let blockId = $(this).val();
                loadData('panchayat', blockId, '#panchayat_id', 'Select Panchayat');
            });

        });
    </script>

</x-app-layout>
