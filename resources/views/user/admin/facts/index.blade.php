@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-table"></i> मुख्य तथ्य (Main Facts)</h3>
    </div>
</div>

{{-- Flash Message Section --}}
@if(session('insert'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check-circle"></i>  <strong>Success!</strong> {{ session('insert') }}
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        Facts List
        <div class="pull-right">
            <a href="{{ route('user-facts.create') }}" class="btn btn-primary btn-xs" style="margin-top: -5px;">
                <i class="fa fa-plus fa-fw"></i> Add New Fact
            </a>
        </div>
    </div>
    
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-center" style="width: 45%;">मुख्य तथ्य (Fact)</th>
                        <th class="text-center" style="width: 30%;">संख्या (Count)</th>
                        <th class="text-center" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fact as $facts)
                        <tr>
                            {{-- Use Blade's built-in loop variable instead of $i++ --}}
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $facts->fact }}</td>
                            <td class="text-center">{{ $facts->num }}</td>
                            <td class="text-center">
                                
                                {{-- Edit Button --}}
                                <a href="{{ route('user-facts.edit', $facts->id) }}" class="btn btn-success btn-xs" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>

                                {{-- Delete Button (Modern Standard HTML Form) --}}
                                <form action="{{ route('user-facts.destroy', $facts->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this fact?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No facts available. Please add one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection