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
							{!! Form::open(['action' => ['Panel\LayerController@store',$id] ,'class' => 'form-horizontal']) !!}
								<div class="form-body">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xlayer_parentid"), null, ['class' => 'control-label']) !!}
											{!! Form::select('frm[xlayer_parentid]', $parent, @$value['xlayer_parentid'], ['class' => 'form-control advance-select']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xlayer_title"), null, ['class' => 'control-label']) !!}
											{!! Form::text("frm[xlayer_title]", @$value['xlayer_title'], ['class' => 'form-control']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 modal-footer">
										{!! Form::submit(trans('panel.store'),['class' => 'btn btn-success']) !!}
										<a href="/{{Route::getCurrentRoute()->getPrefix()}}" class="btn btn-default">{{trans('panel.cancel')}} <i class="fa fa-arrow-circle-left"></i></a>
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