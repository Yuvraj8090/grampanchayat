<x-app-layout>
    <x-slot name="header">
        Roles Management
    </x-slot>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="text-muted">
                <i class="fas fa-user-shield me-1"></i> Manage system access roles
            </div>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus-circle me-1"></i> Create New Role
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0 d-flex align-items-center">
                    <i class="fas fa-list me-2"></i> All Roles
                </h5>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created At</th>
                                <th scope="col" class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">
                                        {{ $role->name }}
                                    </td>
                                    <td class="text-muted">
                                        {{ $role->description ?? 'No description provided' }}
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $role->created_at->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning text-white me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this role? This action cannot be undone.')"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                        No roles found in the database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>