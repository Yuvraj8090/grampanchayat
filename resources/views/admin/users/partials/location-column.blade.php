@if($user->locations->isEmpty())
    <span class="badge bg-secondary">Unassigned</span>
@else
    <button type="button" 
            class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1 mx-auto" 
            data-bs-toggle="modal" 
            data-bs-target="#locationModal-{{ $user->id }}">
        <i class="fas fa-map-marker-alt"></i>
        <span>View</span>
    </button>

    <div class="modal fade text-start" 
         id="locationModal-{{ $user->id }}" 
         tabindex="-1" 
         aria-labelledby="modalLabel-{{ $user->id }}" 
         aria-hidden="true">
         
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                
                <div class="modal-header bg-light py-2">
                    <h5 class="modal-title fw-bold text-primary" id="modalLabel-{{ $user->id }}">
                        <i class="fas fa-user-tag me-2"></i> {{ $user->name }}'s Locations
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body bg-light-subtle">
                    <div class="d-flex flex-column gap-2">
                        @foreach($user->locations as $location)
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3 border-start border-4 border-info rounded-end">
                                    
                                    @if($location->panchayat)
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1">{{ $location->panchayat->name }}</h6>
                                                <div class="text-muted small">
                                                    <i class="fas fa-level-up-alt fa-rotate-90 me-1"></i>
                                                    {{ $location->block->name }} &raquo; {{ $location->district->name }}
                                                </div>
                                            </div>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success">Panchayat</span>
                                        </div>
                                    
                                    @elseif($location->block)
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1">{{ $location->block->name }}</h6>
                                                <div class="text-muted small">
                                                    <i class="fas fa-level-up-alt fa-rotate-90 me-1"></i>
                                                    {{ $location->district->name }}
                                                </div>
                                            </div>
                                            <span class="badge bg-warning bg-opacity-10 text-dark border border-warning">Block</span>
                                        </div>

                                    @elseif($location->district)
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1">{{ $location->district->name }}</h6>
                                                <div class="text-muted small">
                                                    {{ $location->state->name }}
                                                </div>
                                            </div>
                                            <span class="badge bg-info bg-opacity-10 text-info border border-info">District</span>
                                        </div>

                                    @else
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="fw-bold text-primary mb-0">{{ $location->state->name }}</h6>
                                            <span class="badge bg-primary">State Head</span>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer py-1 bg-white">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif