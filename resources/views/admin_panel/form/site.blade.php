@extends('admin_panel.layout')

<!-- BEGIN DASHBOARD STATS -->
@section('component')
<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>{{ trans('panel.'.$title)}}
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							@if (count($errors) > 0)
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
						</div>
						<div class="portlet-body form">
							{!! Form::open(['action' => ['Panel\SiteController@store',$id] ,'class' => 'form-horizontal']) !!}
								<div class="form-body">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group">
											{!! Form::label(trans('panel.category select'), null, ['class' => 'control-label']) !!}:
						        			<div id="html1" class="tree-holder scroller">
												{{ @makeTree($tree)}}
											</div>
										</div>
										<input type="hidden" name="frm1[xlayerid]" id="multilayer" value="" /> 
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xsite_url"), null, ['class' => 'control-label']) !!}:
											{!! Form::text("frm[xsite_url]",@$value['xsite_url'], ['class' => 'form-control ltr']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xsite_title"), null, ['class' => 'control-label']) !!}:
											{!! Form::text("frm[xsite_title]",@$value['xsite_title'], ['class' => 'form-control ltr']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xsite_description"), null, ['class' => 'control-label']) !!}:
											{!! Form::textarea("frm[xsite_description]",@$value['xsite_description'], ['class' => 'form-control']) !!}
										</div>
									</div>									
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xsite_location"), null, ['class' => 'control-label']) !!}:
											{!! Form::select("frm[xsite_location]",@$site_location,@$value['xsite_location'], ['class' => 'form-control advance-select']) !!}
										</div>
									</div>									
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xsite_status"), null, ['class' => 'control-label']) !!}:
											{!! Form::select("frm[xsite_status]",@$site_status,@$value['xsite_status'], ['class' => 'form-control advance-select']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-footer">
										{!! Form::submit(trans('panel.store'),['class' => 'btn btn-success']) !!}
										<button onclick="window.history.back()" class="btn btn-default">{{trans('panel.cancel')}} <i class="fa fa-arrow-circle-left"></i></button>
									</div>
								</div>
							{!! Form::close() !!} 
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT -->
@endsection