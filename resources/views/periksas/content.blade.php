{{-- <div> --}}

{{--   <!-- Nav tabs --> --}}
{{--   <ul class="nav nav-tabs" role="tablist"> --}}
{{-- 	<li role="presentation" class="active"><a href="#status" aria-controls="status" role="tab" data-toggle="tab">Status</a></li> --}}
{{-- 	<li role="presentation"><a href="#diagnosa" aria-controls="diagnosa" role="tab" data-toggle="tab">Diagnosa</a></li> --}}
{{--   </ul> --}}

{{--   <!-- Tab panes --> --}}
{{--   <div class="tab-content"> --}}
{{-- 	<div role="tabpanel" class="tab-pane active" id="status"> --}}
{{-- 		@include('periksas.status') --}}
{{-- 	</div> --}}
{{-- 	<div role="tabpanel" class="tab-pane" id="diagnosa"> --}}
{{-- 		@include('periksas.diagnosa') --}}
{{-- 	</div> --}}
{{--   </div> --}}

{{-- </div> --}}
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#status" aria-controls="status" role="tab" data-toggle="tab">Status</a></li>
	<li role="presentation"><a href="#diagnosa" aria-controls="diagnosa" role="tab" data-toggle="tab">Diagnosa</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="status">
		@include('periksas.status')
	</div>
	<div role="tabpanel" class="tab-pane" id="diagnosa">
		SSS
	</div>
  </div>

</div>
