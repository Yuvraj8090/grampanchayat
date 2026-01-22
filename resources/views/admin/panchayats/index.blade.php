<x-app-layout title="Panchayat Management">
    <x-slot name="header">
        {{ __('Gram Panchayats') }}
    </x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-landmark me-2 text-primary"></i> Panchayat List
            </h2>
            <a href="{{ route('admin.panchayats.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus me-1"></i> Generate Panchayat ID
            </a>
        </div>

        <x-datatable 
            :route="route('admin.panchayats.index')"
            :columns="[
                ['data' => 'id', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'panchayat_id', 'title' => 'Panchayat ID'],
                ['data' => 'name', 'title' => 'Village Name'],
                ['data' => 'location', 'name' => 'block.name', 'title' => 'District > Block'],
                ['data' => 'status', 'title' => 'Status'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'class' => 'text-end']
            ]"
        />
    </div>
</x-app-layout>