@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Kasir

@stop
@section('page-title') 
<h2>Kasir</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
		<li>
		  <a href="{{ url('home/kasirs')}}">Kasir</a>
	  </li>
	  <li class="active">
		  <strong>{{ $kasir->periksa->pasien->nama }}</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="row hide">
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>Tarif</th>
							<th>Biaya</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="body_table">
						@include('kasirs.selectJenisTarif', ['jenis_tarif_id' => null, 'biaya' => null])
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{!! Form::open(['url' => 'home/kasirs', 'method' => 'post']) !!}
		@include('kasirs.form')
	{!! Form::close() !!}
@stop
@section('footer') 
<script>
    var base = "{{ url('/') }}";
</script>
{!! HTML::script('js/kasir.js')!!}
@stop
