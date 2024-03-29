<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Modal title</h4>
					</div>
					<div class="modal-body">
						 Widget settings form goes here
					</div>
					<div class="modal-footer">
						<button type="button" class="btn blue">Save changes</button>
						<button type="button" class="btn default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
			@if($title)
				{{trans('panel.'.$title)}}
			@else
				{{trans('panel.index')}}
			@endif
			@if($titleSmall)
				<small>{{trans('panel.'.$titleSmall)}}</small>
			@endif
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="/">{{ @trans("panel.index") }}</a>
					<i class="fa fa-angle-left"></i>
				</li>
				<li>
					<a href="#">{{ @trans("panel.".$title) }}</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		@yield('component')
	</div>
</div>	