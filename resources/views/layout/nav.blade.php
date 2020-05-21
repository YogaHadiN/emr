<li>
	<a href="{{ url('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
</li>
<li>
	<a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Data-data</span><span class="fa arrow"></span></a>
	<ul class="nav nav-second-level">
		<li>{!! HTML::link('home/users', 'User')!!}</li>
		<li>{!! HTML::link('home/pasiens', 'Pasien')!!}</li>
		<li>{!! HTML::link('home/asuransis', 'Asuransi')!!}</li>
		<li>{!! HTML::link('home/tarifs', 'Tarif')!!}</li>
		<li>{!! HTML::link('home/suppliers', 'Supplier')!!}</li>
		<li>{!! HTML::link('home/stafs', 'Staf')!!}</li>
		<li>{!! HTML::link('home/polis', 'Poli')!!}</li>
		<li>{!! HTML::link('home/roles', 'Role')!!}</li>
	</ul>
</li>
<li>
	<a href="{{ url('home/daftars') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Nurse Station</span></a>
</li>
<li>
	<a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Poli</span><span class="fa arrow"></span></a>
	<ul class="nav nav-second-level">
		@foreach(App\Poli::where('user_id', \Auth::id())->get() as $poli)	
			<li>{!! HTML::link('home/polis/' . $poli->id, $poli->poli)!!}</li>
		@endforeach
	</ul>
</li>
<li>
	<a href="{{ url('home/antrian_apoteks') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Apotek</span></a>
</li>
<li>
	<a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Kasir</span><span class="fa arrow"></span></a>
	<ul class="nav nav-second-level">
		<li>{!! HTML::link('home/kasirs', 'Pemeriksaan')!!}</li>
		<li>{!! HTML::link('home/faktur_belanja_obats', 'Pembelian Obat')!!}</li>
		<li>{!! HTML::link('home/transaksis/pengeluaran', 'Pengeluaran')!!}</li>
	</ul>
</li>
<li>
	<a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Obat</span><span class="fa arrow"></span></a>
	<ul class="nav nav-second-level">
		<li>{!! HTML::link('home/generiks', 'Generik')!!}</li>
		<li>{!! HTML::link('home/obats', 'Obat')!!}</li>
		<li>{!! HTML::link('home/aturan_minums', 'Aturan Minum')!!}</li>
		<li>{!! HTML::link('home/signas', 'Signa')!!}</li>
	</ul>
</li>
<li>
	<a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Akuntansi</span><span class="fa arrow"></span></a>
	<ul class="nav nav-second-level">
		<li>{!! HTML::link('home/coas', 'Coa')!!}</li>
		<li>{!! HTML::link('home/kelompok_coas', 'Kelompok Coa')!!}</li>
	</ul>
</li>
<li>
	<a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Diagnosa</span><span class="fa arrow"></span></a>
	<ul class="nav nav-second-level">
		<li>{!! HTML::link('home/icds', 'ICD')!!}</li>
		<li>{!! HTML::link('home/diagnosas', 'Diagnosa')!!}</li>
	</ul>
</li>
