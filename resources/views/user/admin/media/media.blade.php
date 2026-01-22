@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    {{-- Flash Message --}}
    @if(session('insert'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <strong><i class="fa fa-check-circle"></i> {{ session('insert') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Header & Button --}}
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('user-media.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus fa-fw"></i> Add Images
            </a>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center" style="width: 80px;">क्रमांक (Sr.)</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center" style="width: 150px;">Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Use @forelse to handle empty states automatically --}}
                                @forelse($photo as $photos)
                                    <tr>
                                        {{-- $loop->iteration replaces manual $i counters --}}
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        
                                        <td class="text-center align-middle">
                                            {{-- Use asset() for correct pathing --}}
                                            <img src="{{ asset('images/' . $photos->image) }}" 
                                                 class="img-fluid img-thumbnail" 
                                                 style="width: 80px; height: 80px; object-fit: cover;"
                                                 alt="User Upload">
                                        </td>
                                        
                                        <td class="text-center align-middle">
                                            {{-- Standard Delete Form --}}
                                            {{-- Assuming your route is named 'user-media.destroy' --}}
                                            <form action="{{ route('user-media.destroy', $photos->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                @csrf
                                                @method('DELETE')
                                                
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">
                                            No images available. Please add some.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection