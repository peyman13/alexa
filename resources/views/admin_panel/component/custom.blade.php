@extends('admin_panel.layout')
@section('component')
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12 chart-body">
			<div class="chart-labale">
				{!! FNumber("حوزه فعالیت 500 پایگاه برتر ایران بر اساس رتبه الکسا:") !!}
			</div>
			<div id="placeholder" style="width: 1600px; height: 400px;"></div>
		</div>
	</div>
</div>
@endsection