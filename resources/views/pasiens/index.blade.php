@extends('layout.master')

@section('title') 
Online Electronic Medical Record | Pasien

@stop
@section('head') 
	<style type="text/css" media="all">
		.select2-result-repository { padding-top: 4px; padding-bottom: 3px; }
		.select2-result-repository__avatar { float: left; width: 60px; margin-right: 10px; }
		.select2-result-repository__avatar img { width: 100%; height: auto; border-radius: 2px; }
		.select2-result-repository__meta { margin-left: 70px; }
		.select2-result-repository__title { color: black; font-weight: bold; word-wrap: break-word; line-height: 1.1; margin-bottom: 4px; }
		.select2-result-repository__forks, .select2-result-repository__stargazers { margin-right: 1em; }
		.select2-result-repository__forks, .select2-result-repository__stargazers, .select2-result-repository__watchers { display: inline-block; color: #aaa; font-size: 11px; }
		.select2-result-repository__description { font-size: 13px; color: #777; margin-top: 4px; }
		.select2-results__option--highlighted .select2-result-repository__title { color: white; }
		.select2-results__option--highlighted .select2-result-repository__forks, .select2-results__option--highlighted .select2-result-repository__stargazers, .select2-results__option--highlighted .select2-result-repository__description, .select2-results__option--highlighted .select2-result-repository__watchers { color: #c6dcef; }
		.padding-bottom{
			padding-bottom:10px;
		}

		.kolom_2{
			width:40%;
		}
		.kolom_3{
			width:10% !important;
			white-space: nowrap;
		}
		.no_telp{
			width:10% !important;
			white-space: nowrap;
		}
		.nama_pasien{
			width:20% !important;
			white-space: nowrap;
		}
		.nomor_status{
			width:20% !important;
			white-space: nowrap;
		}
		.action{
			width:10% !important;
			white-space: nowrap;
		}
		
	</style>
@stop
@section('page-title') 
<h2></h2>
<ol class="breadcrumb">
	  <li>
		  <a href="{{ url('/')}}">Home</a>
	  </li>
	  <li class="active">
		  <strong>Pasien</strong>
	  </li>
</ol>
@stop
@section('content') 
	@include('pasiens.error')
	@include('pasiens.form', ['createLink' => true])
	@include('pasiens.validasiSuperAdmin')
@stop
@section('footer') 
<script>
    var base = "{{ url('/') }}";
</script>
<script src="{!! url('js/twbs-pagination/jquery.twbsPagination.min.js') !!}"></script>
{!! HTML::script('js/plugins/webcam/photo.js')!!}
{!! HTML::script('js/togglepanel.js')!!}
{{-- {!! HTML::script('js/select2/dist/js/select2.min.js')!!} --}}
{!! HTML::script('js/pasiens.js')!!}
{!! HTML::script('js/rowEntryPasien.js')!!}
{!! HTML::script('js/cekbpjskontrol.js')!!}
{!! HTML::script('js/peringatan_usg.js')!!}
@stop

