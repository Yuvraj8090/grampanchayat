<x-app-layout>
    <x-slot name="header">
        {{ __('Admin Dashboard') }}
    </x-slot>

    <div class="container-fluid py-4">
        
        <div class="card shadow-sm mb-4 border-0 border-start border-4 border-primary">
            <div class="card-body p-4">
                <h1 class="h3 fw-bold text-dark">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-muted mb-0">
                    You are logged into the Panchayat Management Information System. Here is an overview of your administrative data.
                </p>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <a href="{{ route('admin.districts.index') }}" style="cursor: pointer;text-decoration: none" class="col-12 col-md-6 col-lg-3">
                
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3 text-primary d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-map-marker-alt fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">Total Districts</p>
                            <h4 class="mb-0 fw-bold text-dark">{{ $totalDistricts }}</h4>
                        </div>
                    </div>
              
            </div>
            </a>

            <a href="{{ route('admin.blocks.index') }}" style="cursor: pointer;text-decoration: none" class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3 text-success d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-cubes fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">Total Blocks</p>
                            <h4 class="mb-0 fw-bold text-dark">{{ $totalBlocks }}</h4>
                        </div>
                    </div>
                </div>
            </a>

             <a href="{{ route('admin.panchayats.index') }}" style="cursor: pointer;text-decoration: none" class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3 text-warning d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-landmark fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">Gram Panchayats</p>
                            <h4 class="mb-0 fw-bold text-dark">{{ $totalPanchayats }}</h4>
                        </div>
                    </div>
                </div>
             </a>

            <a href="{{ route('admin.users.index') }}" style="cursor: pointer;text-decoration: none" class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3 text-info d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">Active Users</p>
                            <h4 class="mb-0 fw-bold text-dark">{{ $totalUsers }}</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">Recently Added Panchayats</h5>
                        <a href="{{ route('admin.panchayats.index') }}" class="btn btn-sm btn-link text-decoration-none fw-bold">
                            View All <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 text-muted small text-uppercase fw-bold">Name</th>
                                        <th class="py-3 text-muted small text-uppercase fw-bold">Block</th>
                                        <th class="py-3 text-muted small text-uppercase fw-bold">Status</th>
                                        <th class="pe-4 py-3 text-end text-muted small text-uppercase fw-bold">Added</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentPanchayats as $panchayat)
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">{{ $panchayat->name }}</td>
                                        <td class="text-secondary">{{ $panchayat->block->name ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $badgeClass = match($panchayat->status) {
                                                    'active' => 'bg-success',
                                                    'suspended' => 'bg-danger',
                                                    default => 'bg-warning text-dark'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2">
                                                {{ ucfirst($panchayat->status) }}
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end text-muted small">
                                            {{ $panchayat->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3 text-secondary opacity-25"></i>
                                            <p class="mb-0">No records found.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-dark">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="{{ route('admin.blocks.create') }}" class="btn btn-light text-start p-3 d-flex justify-content-between align-items-center shadow-sm border hover-primary">
                                <div>
                                    <i class="fas fa-layer-group text-success me-2"></i>
                                    <span class="fw-bold text-dark">Add New Block</span>
                                </div>
                                <span class="badge bg-secondary-subtle text-secondary border">Step 1</span>
                            </a>

                            <a href="{{ route('admin.panchayats.create') }}" class="btn btn-light text-start p-3 d-flex justify-content-between align-items-center shadow-sm border hover-primary">
                                <div>
                                    <i class="fas fa-plus-circle text-primary me-2"></i>
                                    <span class="fw-bold text-dark">Add New Panchayat</span>
                                </div>
                                <span class="badge bg-secondary-subtle text-secondary border">Step 2</span>
                            </a>

                            
                            <a href="{{ route('admin.users.create') }}" class="btn btn-light text-start p-3 d-flex justify-content-between align-items-center shadow-sm border hover-primary">
                                <div>
                                    <i class="fas fa-user-plus text-info me-2"></i>
                                    <span class="fw-bold text-dark">Create New User</span>
                                </div>
                                <span class="badge bg-secondary-subtle text-secondary border">Admin</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info d-flex align-items-center border-0 shadow-sm" role="alert">
                    <i class="fas fa-server me-3 fs-4"></i>
                    <div>
                        <div class="fw-bold">System Status</div>
                        <small>All systems operational. Database connected.</small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Custom Hover Effect for Action Buttons */
        .hover-primary:hover {
            background-color: #f8f9fa;
            border-color: #0d6efd !important;
            transform: translateY(-2px);
            transition: all 0.2s ease;
        }
    </style>
</x-app-layout>