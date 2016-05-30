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
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-6">
							<div class="btn-group">
								<button id="sample_editable_1_new" class="btn green">
								{{trans('panel.AddNew')}} <i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
						<div class="col-md-6">
							<div class="btn-group pull-right">
								<button class="btn dropdown-toggle" data-toggle="dropdown"> {{trans('panel.Tools')}} <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right">
									<li>
										<a href="#"> {{trans('panel.Print')}} </a>
									</li>
									<li>
										<a href="#"> {{trans('panel.Excel')}} </a>
									</li>
									<li>
										<a href="#"> {{trans('panel.PDF')}} </a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
				<thead>
				<tr>
					<th>
						 Username
					</th>
					<th>
						 Full Name
					</th>
					<th>
						 Points
					</th>
					<th>
						 Notes
					</th>
					<th>
						<i class="fa fa-wrench"></i> {{trans('panel.Tools')}}
					</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>
						 alex
					</td>
					<td>
						 Alex Nilson
					</td>
					<td>
						 1234
					</td>
					<td class="center">
						 power user
					</td>
					<td>
						<a class="edit" href="javascript:;"><i class="fa fa-pencil-square-o"></i></a>
						<a class="delete" href="javascript:;"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT -->
@endsection