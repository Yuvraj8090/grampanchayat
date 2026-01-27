<x-app-layout title="Users Management">
    <x-slot name="header">
        {{ __('Users Management') }}
    </x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0 text-dark">
                <i class="fas fa-users me-2 text-primary"></i> User List
            </h2>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus me-1"></i> Create User
            </a>
        </div>

        <x-datatable 
            :route="route('admin.users.index')"
            :columns="[
                ['data' => 'DT_RowIndex', 'title' => 'No', 'orderable' => false, 'searchable' => false],
                ['data' => 'name', 'title' => 'Name'],
                ['data' => 'email', 'title' => 'Email'],
                ['data' => 'role_name', 'name' => 'role.name', 'title' => 'Role'],
                
                // NEW COLUMN HERE
                ['data' => 'locations', 'title' => 'Assigned Area', 'orderable' => false, 'searchable' => false],

                ['data' => 'created_at_formatted', 'name' => 'created_at', 'title' => 'Created At'],
                ['data' => 'action', 'title' => 'Actions', 'orderable' => false, 'searchable' => false, 'class' => 'text-end']
            ]"
        />
    </div>
</x-app-layout>