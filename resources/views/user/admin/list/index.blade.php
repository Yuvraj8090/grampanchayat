@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-users"></i> जनप्रतिनिधि सूची (Representatives List)</h3>
    </div>
</div>

{{-- Success Flash Message --}}
@if(session('insert'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check-circle"></i> <strong>Success!</strong> {{ session('insert') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6" style="padding-top: 5px;">
                Manage Representatives
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('user-list.create') }}" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus fa-fw"></i> Add New Member
                </a>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-center" style="width: 20%;">नाम (Name)</th>
                        <th class="text-center" style="width: 20%;">पद (Position)</th>
                        <th class="text-center" style="width: 15%;">वार्ड (Ward)</th>
                        <th class="text-center" style="width: 20%;">फ़ोन नंबर (Phone)</th>
                        <th class="text-center" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $item)
                        <tr>
                            {{-- Loop Iterator --}}
                            <td class="text-center">{{ $loop->iteration }}</td>
                            
                            {{-- Name --}}
                            <td class="text-center"><strong>{{ $item->name }}</strong></td>
                            
                            {{-- Position (Styled) --}}
                            <td class="text-center">
                                <span class="label label-info">{{ $item->position }}</span>
                            </td>
                            
                            {{-- Ward/Block --}}
                            <td class="text-center">{{ $item->block }}</td>
                            
                            {{-- Phone (Clickable) --}}
                            <td class="text-center">
                                @if($item->phone)
                                    <a href="tel:{{ $item->phone }}"><i class="fa fa-phone"></i> {{ $item->phone }}</a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            
                            {{-- Actions --}}
                            <td class="text-center">
                                
                                {{-- Edit Button --}}
                                <a href="{{ route('user-list.edit', $item->id) }}" class="btn btn-success btn-xs" title="Edit">
                                    <i class="fa fa-edit"></i> Edit
                                </a>

                                {{-- Delete Button (Standard Form) --}}
                                <form action="{{ route('user-list.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" title="Delete">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted" style="padding: 20px;">
                                <i class="fa fa-info-circle"></i> No representatives found. Please add one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
</div>

@endsection