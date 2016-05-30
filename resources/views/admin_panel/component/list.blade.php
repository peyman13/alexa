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
				<div class="tools">
					<i class="fa fa-search"></i>
					@if(@$btn['excel'])
						<i class="fa fa-file-excel-o" id="excelBtn" aria-hidden="true"></i>
					@endif
					@if(@$btn['chart'])
						<a href="/manager/report?date={{ $chart }}">
							<i class="fa fa-bar-chart" id="chartBtn" aria-hidden="true"></i>
						</a>
					@endif	
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar search-holder">
					@if(view()->exists("admin_panel.search.".$listView))
						@include("admin_panel.search.".$listView)
					@endif	
				</div>
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							@if(!@$btn['hidden_add'])
								<div class="btn-group">
									<a href="/{{$section}}/create">
										<button id="sample_editable_1_new" class="btn green">
											{{trans('panel.AddNew')}} <i class="fa fa-plus"></i>
										</button>
									</a>
								</div>
							@endif
						</div>
					<!-- 	<div class="col-md-6">
							<div class="btn-group pull-right">
								<button class="btn dropdown-toggle" data-toggle="dropdown"> {{trans('panel.Tools')}} <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right">
									<li>
										<a href="javascript::void()" id="excelBtn"> {{trans('panel.Excel')}} </a>
									</li>
									<li>
										<a href="manager/report/" id="excelBtn"> {{trans('panel.report')}} </a>
									</li>
								</ul>
							</div>
						</div> -->
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ trans($error) }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>
				@include("admin_panel.list.".$listView)
				<div class="row">
					<div class="col-md-12 paginat">
						{!! $list->appends(['q' => $q])->render() !!}<br />
						{!! Form::select('size', array('10' => '10', '20' => '20', '50' => '50', '100' => '100' , '10000' =>trans("panel.all")),Cookie::get('chunk'),['class' => 'input-sm', 'onChange' => 'doObject.setChunk()' ,'id' => 'chunk']) !!}
					</div>
				</div> 
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT -->
@endsection