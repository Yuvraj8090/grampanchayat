@props(['route', 'columns', 'id' => 'table-'.uniqid()])

@php
    // We format the columns in PHP to avoid Blade syntax errors in the script tag
    $jsColumns = array_map(function($col) {
        return [
            'data' => $col['data'], 
            'name' => $col['name'] ?? $col['data'],
            'orderable' => $col['orderable'] ?? true,
            'searchable' => $col['searchable'] ?? true,
            'className' => $col['class'] ?? ''
        ];
    }, $columns);
@endphp

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table id="{{ $id }}" class="table table-hover table-striped w-100">
                <thead class="bg-light">
                    <tr>
                        @foreach($columns as $col)
                            <th class="{{ $col['class'] ?? '' }}">{{ $col['title'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        // We use the PHP variable we created above
        let columnsConfig = @json($jsColumns);

        $('#{{ $id }}').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ $route }}",
            columns: columnsConfig,
            order: [[0, 'desc']], // Default sort (optional)
            language: {
                searchPlaceholder: "Search...",
                search: ""
            }
        });
    });
</script>