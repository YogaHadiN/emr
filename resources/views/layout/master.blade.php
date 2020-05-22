<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha256-nbyata2PJRjImhByQzik2ot6gSHSU4Cqdz5bNYL2zcU=" crossorigin="anonymous" />
	<style type="text/css" media="all">
		.row-eq-height {
		  display: -webkit-box;
		  display: -webkit-flex;
		  display: -ms-flexbox;
		  display:         flex;
		}	
	</style>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    {{-- <link href="{!! asset('css/bootstrap-select.min.css') !!}" rel="stylesheet"> --}}
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css') !!}" rel="stylesheet">
    {{-- <link href="{!! asset('css/plugins/dataTables/dataTables.bootstrap.css') !!}" rel="stylesheet"> --}}
    <link href="{!! asset('css/plugins/dataTables/dataTables.responsive.css') !!}" rel="stylesheet">
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/datatables-tabletools/2.1.5/css/TableTools.min.css') !!}" rel="stylesheet">
    {{-- <link href="{!! asset('css/plugins/dataTables/dataTables.tableTools.min.css') !!}" rel="stylesheet"> --}}
    {{-- <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css') !!}" rel="stylesheet"> --}}
    {{-- <link href="{!! asset('css/animate.css') !!}" rel="stylesheet"> --}}
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet">
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') !!}" rel="stylesheet">
    {{-- <link href="{!! asset('css/jquery-ui.min.css') !!}" rel="stylesheet"> --}}
    {{-- <link href="{!! asset('css/plugins/datepicker/datepicker3.css') !!}" rel="stylesheet"> --}}
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css') !!}" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
    {{-- <link href="{!! asset('css/all.css') !!}" rel="stylesheet" media="screen"> --}}
	<script src="https://kit.fontawesome.com/888ab79ab3.js" crossorigin="anonymous"></script>
	<style type="text/css" media="all">
		.fixed {
			position: fixed;
			bottom: 0px;
			text-align:right;
			left: 0px;
			z-index: 999;
		}
		.fixed-left{
			width:39% !important;
		}
		.fixed-right{
			width:39% !important;
		}

		.full {
			width:100% !important;
		}
		
		input.has-error{
			border: 0.2px solid red;
		}

		@media (max-width: 767px) {
		  .table-responsive .dropdown-menu,
		  .table-responsive .dropdown-toggle {
				position: static !important;
		  }
		}

		@media (min-width: 768px) {
			.table-responsive {
				overflow: visible;
			}
		}
	</style>
    @yield('head')
</head>
<body>
    <div id="overlayd"></div>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
								{{-- @if(Storage::cloud()->exists(\Auth::user()->profile_pic)) --}}
								{{-- 	<img alt="image" class="img-circle" width="75px" height="75px" src="{{Storage::cloud()->url(\Auth::user()->profile_pic) }}" /> --}}
								{{-- @else --}}
									<img alt="image" class="img-circle" width="75px" height="75px" src="{{ url('img/empty.jpg') }}" />
								{{-- @endif --}}
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
                            <span class="clear"> <span class="block m-t-xs"> 
								<strong class="font-bold"> {!! \Auth::user()->name !!}</strong>
                             </span> <span class="text-muted text-xs block">
                                

                             <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{ url('home/users/' . \Auth::id() . '/edit') }}">Profile</a></li>
                                <li class="divider"></li>
                                <li><button type="button" onclick="logoutClick();return false;">Logout</button></li>
                            </ul>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
					@include('layout.nav')
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control hide" name="top-search" id="top-search">
                </div>
            </form>
        </div>
		<ul class="nav navbar-top-links navbar-right">
                <li>
                    <button type="button" onclick="logoutClick();return false;">
                        <i class="fa fa-sign-out"></i> Log out
                    </button>
                </li>
            </ul>
        </nav>
        </div>
            <div class="row border-bottom white-bg page-heading">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    @yield('page-title')
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                @if (count($errors) > 0)
                                  <div class="alert alert-danger">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                  </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                @if (Session::has('pesan'))
                                    {!! Session::get('pesan')!!}
                                @endif
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        </div>
		<script type="text/javascript" charset="utf-8">
			var url = "{{ url('/') }}";
			console.log('dfdjfkjsjf');
		</script>
            {{--{!! HTML::script("js/all.js")!!}--}}
    {{-- <script src="{!! asset('js/all.js') !!}"></script> --}}
    <script src="{!! asset('https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js') !!}"></script>
    {{-- <script src="{!! asset('js/Numeral-js/min/numeral.min.js') !!}"></script> --}}
    {{-- <script src="{!! url('js/jquery-2.1.1.js') !!}"></script> --}}
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    {{-- <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') !!}"></script> --}}
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js') !!}"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    {{-- <script src="{!! url('js/bootstrap.min.js') !!}"></script> --}}
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.4/metisMenu.min.js') !!}"></script>
    {{-- <script src="{!! url('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script> --}}
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js') !!}"></script>
    {{-- <script src="{!! url('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script> --}}
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/jeditable.js/1.7.3/jeditable.min.js') !!}"></script>
    {{-- <script src="{!! url('js/plugins/jeditable/jquery.jeditable.js') !!}"></script> --}}
    {{-- <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/react-bootstrap-select/0.14.0/js/bootstrap-select.min.js') !!}"></script> --}}
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.16/js/bootstrap-select.min.js"></script>
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script> --}}
    {{-- <script src="{!! url('js/bootstrap-select.min.js') !!}"></script> --}}
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js') !!}" type="text/javascript"></script>
    {{-- <script src="{!! url('js/plugins/datepicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script> --}}
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js') !!}"></script>
    {{-- <script src="{!! url('js/plugins/dataTables/jquery.dataTables.min.js') !!}"></script> --}}
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js') !!}"></script>
    {{-- <script src="{!! url('js/plugins/dataTables/dataTables.bootstrap.min.js') !!}"></script> --}}
    <script src="{!! url('js/plugins/dataTables/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! url('js/inspinia.js') !!}"></script>
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js') !!}"></script>
    <script src="{!! url('https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js') !!}"></script>
    {{-- <script src="{!! url('js/plugins/pace/pace.min.js') !!}"></script> --}}
	<script src="{!! url('js/Ajax-Bootstrap-Select/src/js/ajaxSelectPicker.js') !!}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		@if( gethostname() == 'dell' )
			{{--setInterval(function(){--}}
				{{--$.get('{{ url("master/ajax/antrianTerakhir") }}', { 'tanggal' : '{{ date('Y-m-d') }}' }, function(data) {--}}
					{{--var before = $('#antrianMaster').html();--}}
					{{--data = $.trim(data)--}}
						{{--if( before != data ){--}}
							{{--if( parseInt(data) > 0 ){--}}
								{{--$('#antrianPasien').hide().fadeIn(300);--}}
								{{--$('#antrianMaster').html(data);--}}
							{{--} else {--}}
								{{--$('#antrianPasien').fadeOut(300);--}}
								{{--$('#antrianMaster').html(data);--}}
							{{--}--}}
						{{--}--}}
				{{--});--}}
			{{--}, 5000);--}}
		@endif
		var base = '{{ url("/") }}'
        $(document).ready(function() {

            formatUang();
            
            $('.jumlah').each(function() {
                var number = $(this).html();
                number = number.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // 43,434
                $(this).html(number);
            });

            $('.selectpick')
                .selectpicker({
                style: 'btn-default',
                size: 10,
                selectOnTab : true,
                style : 'btn-white'
            });

        //plug in datetimepicker waktu bebas terserah
            $('.tanggal')
				.datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd-mm-yyyy'
            });

            $('.jam').timepicker({
                showInputs: false,
                defaultTime: 'current',
                maxHours: 24,
				showMeridian : false,
                minuteStep: 5
            });
			$('.tanggal').attr('placeholder', 'dd-mm-YYYY Contoh: 31-12-2017');
			$('.bulanTahun').attr('placeholder', 'mm-YYYY');
            $('.bulanTahun').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'mm-yyyy',
                minViewMode: 'months'
            });

            $('.DTa').dataTable({
                "dom": 'T<"clear">lfrtip',
            });

            $('.DT').dataTable({
                "dom": 'T<"clear">lfrtip',
                "bSort" : false
            });
            $('.DTi').dataTable({
                "aaSorting": [[ 6, "desc" ]],
                "responsive" : true,
                "dom": 'T<"clear">lfrtip',
                // "bSort" : false,
                "tableTools": {
                    "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });
            /* Init DataTables */
            var oTable = $('#editable').dataTable();
            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },
                "width": "90%",
                "height": "100%"
            });
        });
      function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );
        }
		{{--$('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');--}}
	function logoutClick(){
		$('form#logout-form').submit();
	}
	function ajax_search(route, if_null){
		var result = {
			width: '100%',
			theme: "bootstrap",
			  ajax: {
			url: base + '/' + route,
			dataType: 'json',
			// delay: 100,	
			data: function (params) {
			  return {
				q: params.term, // search term
				page: params.page
			  };
			},
			processResults: function (data, params) {
			  // parse the results into the format expected by Select2
			  // since we are using custom formatting functions we do not need to
			  // alter the remote JSON data, except to indicate that infinite
			  // scrolling can be used
			  params.page = params.page || 1;

			  return {
				results: data,
				pagination: {
				  more: (params.page * 30) < data.total_count
				}
			  };
			},
			cache: true
		  },
		  placeholder: if_null,
		  selectOnClose: true,
		  minimumInputLength: 1
		}
		return result;
	}
	// on first focus (bubbles up to document), open the menu
	$(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
		$(this).closest(".form-group").find('select').select2('open');
	});

	// steal focus during close - only capture once and stop propogation
	$('select.select2').on('select2:closing', function (e) {
		$(e.target).data("select2").$selection.one('focus focusin', function (e) {
			e.stopPropagation();
		});
	});
</script>
        @yield('footer')
</body>
</html>

