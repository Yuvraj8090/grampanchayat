<x-app-layout title="Manage Places - {{ $panchayat->name }}">
    <x-slot name="header">
        {{ __('Manage Places for ') . $panchayat->name }}
    </x-slot>

    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 mb-1 text-dark">
                    <i class="fas fa-map-marked-alt me-2 text-primary"></i> 
                    Places in {{ $panchayat->name }}
                </h2>
                <p class="text-muted small mb-0">Manage tourist spots, landmarks, and locations.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.panchayats.index') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('admin.panchayats.places.create', $panchayat->id) }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-1"></i> Add New Place
                </a>
            </div>
        </div>

        <x-datatable 
            :route="route('admin.panchayats.places.index', $panchayat->id)"
            :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false, 'width' => '5%'],
                ['data' => 'photo_display', 'title' => 'Photo', 'orderable' => false, 'searchable' => false],
                ['data' => 'title', 'title' => 'Place Name'],
                ['data' => 'address', 'title' => 'Address / Location'],
                ['data' => 'status_badge', 'name' => 'status', 'title' => 'Status', 'class' => 'text-center'],
                ['data' => 'created_at', 'title' => 'Added On'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'class' => 'text-end']
            ]"
        />
    </div>
</x-app-layout>