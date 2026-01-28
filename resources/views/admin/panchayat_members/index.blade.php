<x-app-layout title="Manage Members - {{ $panchayat->name }}">
    <x-slot name="header">
        {{ __('Manage Members for ') . $panchayat->name }}
    </x-slot>

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 mb-1 text-dark">
                    <i class="fas fa-store me-2 text-primary"></i> 
                    Members in {{ $panchayat->name }}
                </h2>
                <p class="text-muted small mb-0">Manage local shops, startups, and service providers.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.panchayats.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('admin.panchayats.members.create', $panchayat->id) }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-1"></i> Add New Business
                </a>
            </div>
        </div>

        <x-datatable 
            :route="route('admin.panchayats.members.index', $panchayat->id)"
            :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false, 'width' => '5%'],
                ['data' => 'photo_display', 'title' => 'Photo', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Name'],
                
                ['data' => 'phone', 'title' => 'Phone'],
                ['data' => 'designation', 'title' => 'Designation'],
                ['data' => 'order_by', 'title' => 'Order By'],
                ['data' => 'ward_no', 'title' => 'Ward No.', 'class' => 'text-center'],
                
                ['data' => 'status_badge', 'name' => 'status', 'title' => 'Status', 'class' => 'text-center'],
               
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'class' => 'text-end']
            ]"
        />
    </div>
</x-app-layout>