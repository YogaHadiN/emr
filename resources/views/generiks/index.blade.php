@extends('layout.master')

@section('title') 

Online Electronic Medical Record | Generik

@stop
@section('page-title') 
<h2>Generik</h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('home')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Generik</strong>
	  </li>
</ol>
@stop
@section('content') 
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="table-responsive">
				<div class="row">
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
						Menampilkan <span id="rows"></span> hasil
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 padding-bottom">
						{!! Form::select('displayed_rows', App\Yoga::manyRows(), 15, [
							'class' => 'form-control',
							'onchange' => 'clearAndSelectPasien();return false;',
							'id'    => 'displayed_rows'
						]) !!}
					</div>
			  </div>
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>
								id
							</th>
							<th>
								Generik
								{!! Form::text('generik', null, [
									'id'      => 'generik' ,
									'class'   => 'form-control ajaxselectgenerik'
								]) !!}
							</th>
							<th>
								Pregnancy Safety Index
								{!! Form::text('pregnancy_safety_index', null, [
									'id'      => 'pregnancy_safety_index' ,
									'class'   => 'form-control ajaxselectgenerik'
								]) !!}
							</th>
						</tr>
					</thead>
					<tbody id="ajax_container"></tbody>
				</table>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div id="page-box">
							<nav class="text-right" aria-label="Page navigation" id="paging">
							
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('footer') 
	<script src="{!! url('js/twbs-pagination/jquery.twbsPagination.min.js') !!}"></script>
	{!! HTML::script('js/generik.js')!!}
@stop

