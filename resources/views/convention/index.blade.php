@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/datatables.materialize.css') !!}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h4>Daftar Code Convention</h4>
        <div class="card-panel">
            <a class="btn green accent-4 left" href="/convention/create">Add Convention</a>
            <table id="datatable" class="table highlight bordered">
    			<thead>
    				<tr>
    					<th>Aturan Untuk</th>
    					<th>Aturan Regex</th>
    					<th>Deskripsi</th>
    					<th>Min. Character</th>
    					<th>Pesan Error</th>
                        <th>Action</th>
    				</tr>
    			</thead>
    			<tbody>
    				@if(count($dbconventions) > 0)
    				@foreach($dbconventions as $dbconvention)
    				<tr>
    					<td data-label="Aturan Untuk">{{ $dbconvention->for }}</td>
    					<td data-label="Aturan Regex"><pre><code>{{ $dbconvention->regex }}</code></pre></td>
    					<td data-label="Deskripsi">{{ $dbconvention->deskripsi }}</td>
    					<td data-label="Min. Character">{{ $dbconvention->min }}</td>
    					<td data-label="Pesan Error">{{ $dbconvention->pesanmin }}</td>
    					<td data-label="Action">
                            <a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('convention').'/'.$dbconvention->id }}"><i class="material-icons">list</i></a>
                            <a class="btn btn-small amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="{{ url('convention').'/'.$dbconvention->id }}/edit"><i class="material-icons">edit</i></a>
                            <a class="btn btn-small red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $dbconvention->id }}delete"><i class="material-icons">delete</i></a>
                            @component('partials.deletemodal')
                                @slot('id')
                                    {{ $dbconvention->id }}delete
                                @endslot
                                @slot('action')
                                    {{ url('convention').'/'.$dbconvention->id }}
                                @endslot
                            @endcomponent
    					</td>
    				</tr>
    				@endforeach
    				@endif
    			</tbody>
    		</table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
      $('.modal').modal();
    });
</script>
@include('partials.datatable')
@endsection
