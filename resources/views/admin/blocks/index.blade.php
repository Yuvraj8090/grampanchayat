<x-app-layout title="Blocks Management">
    <x-slot name="header">
        {{ __('Development Blocks') }}
    </x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-th-large me-2 text-primary"></i> Block List
            </h2>
            <a href="{{ route('admin.blocks.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus me-1"></i> Add New Block
            </a>
        </div>

        <x-datatable 
            :route="route('admin.blocks.index')"
            :columns="[
                ['data' => 'id', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Block Name'],
                ['data' => 'block_code', 'title' => 'Block Code'],
                ['data' => 'district_name', 'name' => 'district.name', 'title' => 'Parent District'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'class' => 'text-end']
            ]"
        />
    </div>
</x-app-layout>