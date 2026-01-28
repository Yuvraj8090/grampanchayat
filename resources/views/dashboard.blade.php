<x-app-layout title="Admin Dashboard">
    <x-slot name="header">
        {{ __('Analytics Overview') }}
    </x-slot>
    <div class="container-fluid py-4">
        <div class="card shadow-sm mb-4 border-0 overflow-hidden" style="border-radius: 15px;">
            <div class="card-body p-0">
                <div class="row g-0">
                    <div class="col-md-8 p-4 bg-white">
                        <div class="text-muted small">
                            <i class="fas fa-calendar-day me-1"></i> {{ now()->format('l, d M Y') }}
                        </div>
                        <h1 class="h3 fw-bold text-dark mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-muted mb-3">
                            The system is running smoothly. You have managed <span class="fw-bold text-primary">{{
                                $totalPanchayats }}</span> Gram Panchayats across <span class="fw-bold text-success">{{
                                $totalBlocks }}</span> blocks.
                        </p>
                        <div class="d-flex gap-3">
                            <span class="badge bg-soft-primary text-primary px-3 py-2"><i
                                    class="fas fa-shield-alt me-1"></i> Administrator</span>
                            <span class="badge bg-soft-success text-success px-3 py-2"><i
                                    class="fas fa-check-circle me-1"></i> Data Verified</span>
                        </div>
                    </div>
                    <div class="col-md-4 d-none d-md-flex align-items-center justify-content-center bg-light">
                        <i class="fas fa-chart-line fa-5x text-primary opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <a href="{{ route('admin.districts.index') }}" class="text-decoration-none shadow-hover h-100 d-block">
                    <div class="card border-0 shadow-sm h-100 stat-card-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="icon-shape bg-primary text-white rounded-3 shadow">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <span class="text-success small fw-bold"><i
                                        class="fas fa-arrow-up me-1"></i>Active</span>
                            </div>
                            <h3 class="fw-bold mb-1 text-dark">{{ number_format($totalDistricts) }}</h3>
                            <p class="text-muted mb-0 small text-uppercase fw-bold ls-1">Total Districts</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <a href="{{ route('admin.blocks.index') }}" class="text-decoration-none shadow-hover h-100 d-block">
                    <div class="card border-0 shadow-sm h-100 stat-card-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="icon-shape bg-success text-white rounded-3 shadow">
                                    <i class="fas fa-th-large"></i>
                                </div>
                                <span class="text-success small fw-bold">Live Data</span>
                            </div>
                            <h3 class="fw-bold mb-1 text-dark">{{ number_format($totalBlocks) }}</h3>
                            <p class="text-muted mb-0 small text-uppercase fw-bold ls-1">Total Blocks</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <a href="{{ route('admin.panchayats.index') }}" class="text-decoration-none shadow-hover h-100 d-block">
                    <div class="card border-0 shadow-sm h-100 stat-card-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="icon-shape bg-warning text-white rounded-3 shadow">
                                    <i class="fas fa-landmark"></i>
                                </div>
                                <span class="badge bg-warning-subtle text-warning border-0">Primary Unit</span>
                            </div>
                            <h3 class="fw-bold mb-1 text-dark">{{ number_format($totalPanchayats) }}</h3>
                            <p class="text-muted mb-0 small text-uppercase fw-bold ls-1">Gram Panchayats</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none shadow-hover h-100 d-block">
                    <div class="card border-0 shadow-sm h-100 stat-card-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="icon-shape bg-info text-white rounded-3 shadow">
                                    <i class="fas fa-users"></i>
                                </div>
                                <span class="text-info small fw-bold">Active Sessions</span>
                            </div>
                            <h3 class="fw-bold mb-1 text-dark">{{ number_format($totalUsers) }}</h3>
                            <p class="text-muted mb-0 small text-uppercase fw-bold ls-1">Registered Admins</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">Recent Registrations</h5>
                        <a href="{{ route('admin.panchayats.index') }}"
                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            Manage All
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 text-muted small text-uppercase">Panchayat Name</th>
                                        <th class="text-muted small text-uppercase">Block Name</th>
                                        <th class="text-muted small text-uppercase">Status</th>
                                        <th class="pe-4 text-end text-muted small text-uppercase">Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentPanchayats as $panchayat)
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs bg-soft-primary text-primary rounded-circle me-2 d-flex align-items-center justify-content-center"
                                                    style="width: 32px; height: 32px; font-size: 12px;">
                                                    {{ substr($panchayat->name, 0, 1) }}
                                                </div>
                                                {{ $panchayat->name }}
                                            </div>
                                        </td>
                                        <td>{{ $panchayat->block->name ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                            $badgeClass = match($panchayat->status) {
                                            'active' => 'bg-soft-success text-success',
                                            'suspended' => 'bg-soft-danger text-danger',
                                            default => 'bg-soft-warning text-warning'
                                            };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} border-0 px-3 py-2">
                                                {{ ucfirst($panchayat->status) }}
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end text-muted small">
                                            {{ $panchayat->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">No Data Available</td>
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
                        <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-rocket me-2 text-primary"></i>Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('admin.panchayats.create') }}"
                                class="list-group-item list-group-item-action border-0 px-0 d-flex align-items-center mb-2">
                                <div class="icon-box bg-soft-primary p-2 rounded me-3">
                                    <i class="fas fa-plus text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">New Panchayat</h6>
                                    <small class="text-muted">Register a new village unit</small>
                                </div>
                                <i class="fas fa-chevron-right ms-auto text-muted small"></i>
                            </a>
                            <a href="{{ route('admin.users.create') }}"
                                class="list-group-item list-group-item-action border-0 px-0 d-flex align-items-center mb-2">
                                <div class="icon-box bg-soft-info p-2 rounded me-3">
                                    <i class="fas fa-user-plus text-info"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Staff Account</h6>
                                    <small class="text-muted">Create admin or user access</small>
                                </div>
                                <i class="fas fa-chevron-right ms-auto text-muted small"></i>
                            </a>
                            <a href="{{ route('admin.states.index') }}"
                                class="list-group-item list-group-item-action border-0 px-0 d-flex align-items-center">
                                <div class="icon-box bg-soft-success p-2 rounded me-3">
                                    <i class="fas fa-globe-asia text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Global Settings</h6>
                                    <small class="text-muted">Manage states and regions</small>
                                </div>
                                <i class="fas fa-chevron-right ms-auto text-muted small"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card border-0 bg-dark text-white shadow-sm overflow-hidden" style="border-radius: 12px;">
                    <div class="card-body p-4 position-relative">
                        <i class="fas fa-server position-absolute end-0 bottom-0 mb-n3 me-n3 opacity-25"
                            style="font-size: 100px;"></i>
                        <h6 class="text-uppercase small mb-3 ls-1 opacity-75">Cloud Status</h6>
                        <div class="d-flex align-items-center mb-2">
                            <div class="spinner-grow spinner-grow-sm text-success me-2" role="status"></div>
                            <span class="fw-bold">Database Online</span>
                        </div>
                        <p class="small text-white-50 mb-0">System version 12.48.1<br>Environment: Production</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modern Utilities */
        .ls-1 {
            letter-spacing: 0.5px;
        }

        .bg-soft-primary {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .bg-soft-success {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-soft-info {
            background-color: rgba(13, 202, 240, 0.1);
        }

        .bg-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
        }

        .bg-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .icon-shape {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .shadow-hover {
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .shadow-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
        }

        .stat-card-primary {
            border-bottom: 4px solid #0d6efd !important;
        }

        .stat-card-success {
            border-bottom: 4px solid #198754 !important;
        }

        .stat-card-warning {
            border-bottom: 4px solid #ffc107 !important;
        }

        .stat-card-info {
            border-bottom: 4px solid #0dcaf0 !important;
        }
    </style>
</x-app-layout>