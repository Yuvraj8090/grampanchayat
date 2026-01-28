<x-app-layout title="Manage Members - {{ $panchayat->name }}">
    <x-slot name="header">
        {{ __('Manage Panchayat Members: ') . $panchayat->name }}
    </x-slot>

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 mb-1 text-dark fw-bold">
                    <i class="fas fa-users-cog me-2 text-primary"></i> 
                    पंचायत सदस्य: {{ $panchayat->name }}
                </h2>
                <p class="text-muted small mb-0">
                    Manage Panchayat representatives, Ward members, and administrative staff.
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.panchayats.index') }}" class="btn btn-sm btn-outline-secondary shadow-sm">
                    <i class="fas fa-chevron-left me-1"></i> Back to Panchayats
                </a>
                <a href="{{ route('admin.panchayats.members.create', $panchayat->id) }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-user-plus me-1"></i> Add New Member
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-3">
                <x-datatable 
                    :route="route('admin.panchayats.members.index', $panchayat->id)"
                    :columns="[
                        ['data' => 'DT_RowIndex', 'title' => 'क्रमांक', 'orderable' => false, 'searchable' => false, 'width' => '5%'],
                        ['data' => 'photo_display', 'title' => 'Photo', 'orderable' => false, 'searchable' => false, 'width' => '8%'],
                        ['data' => 'name', 'title' => 'Name / नाम'],
                        ['data' => 'designation', 'title' => 'Designation / पद'],
                        ['data' => 'ward_no', 'title' => 'Ward / वार्ड', 'class' => 'text-center'],
                        ['data' => 'phone', 'title' => 'Contact / फोन'],
                        ['data' => 'order_by', 'title' => 'Rank', 'class' => 'text-center'],
                        ['data' => 'status_badge', 'name' => 'status', 'title' => 'Status', 'class' => 'text-center'],
                        ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'class' => 'text-end']
                    ]"
                />
            </div>
        </div>
    </div>


    <script>
        function handleDelete(url) {
            if (confirm('Are you sure you want to remove this member?')) {
                let form = document.createElement('form');
                form.action = url;
                form.method = 'POST';
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
    
</x-app-layout>