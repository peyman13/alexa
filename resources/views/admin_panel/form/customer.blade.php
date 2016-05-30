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
							{!! Form::open(['action' => ['Panel\CustomerController@store',$id] ,'class' => 'form-horizontal']) !!}
								<div class="form-body">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xcustomer_name"), null, ['class' => 'control-label']) !!}
											{!! Form::text("frm[xcustomer_name]",@$value['xcustomer_name'], ['class' => 'form-control']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xcustomer_family"), null, ['class' => 'control-label']) !!}
											{!! Form::text("frm[xcustomer_family]",@$value['xcustomer_family'], ['class' => 'form-control']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xcustomer_cellphone"), null, ['class' => 'control-label']) !!}
											{!! Form::text("frm[xcustomer_cellphone]",@$value['xcustomer_cellphone'], ['class' => 'form-control']) !!}
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group">
											{!! Form::label(trans("validation.attributes.frm.xcustomer_telephone"), null, ['class' => 'control-label']) !!}
										</div>
									</div>
									<div class="clones">
									@if(Session::has('cellphone'))
										<?php $cellphone = Session::get('cellphone'); ?>
									@endif
									@if(!count($cellphone))
										<div class="item col-xs-12 col-sm-12 col-lg-4">
											<input type="hidden"  data-name="frm1[xxx][xcustomer_cellphoneid]" name="frm1[0][xcustomer_cellphoneid]" class="empty form-control" />
											<input type="text"  data-name="frm1[xxx][xcustomer_cellphone]" name="frm1[0][xcustomer_cellphone]" class="empty form-control" />
											<span class="miultiple-box">
												<span class="miultiple-controller add"><i class="fa fa-plus-square-o"></i></span>
												<span class="miultiple-controller remove"><i class="fa fa-minus-square-o"></i></span>
											</span>
										</div>
									@endif
									@foreach($cellphone as $key => $value)
										<div class="item col-xs-12 col-sm-12 col-lg-4">
											<input type="hidden" value="{{$value['xcustomer_cellphoneid']}}" data-name="frm1[xxx][xcustomer_cellphoneid]" name="frm1[{{$key}}][xcustomer_cellphoneid]" class="empty form-control" />
											<input type="text" value="{{$value['xcustomer_cellphone']}}" data-name="frm1[xxx][xcustomer_cellphone]" name="frm1[{{$key}}][xcustomer_cellphone]" class="empty form-control" />
											<span class="miultiple-box">
												<span class="miultiple-controller add"><i class="fa fa-plus-square-o"></i></span>
												<span class="miultiple-controller remove"><i class="fa fa-minus-square-o"></i></span>
											</span>
										</div>
									@endforeach
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