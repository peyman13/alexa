<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
	<thead>
		<tr>
			<td width="10px">
				#
			</td>
			<td>
				<span data-sort='{"col":"xlayer_title","order":"DESC"}'>
					<i class="fa fa-sort"></i> {{trans('validation.attributes.frm.name')}}
				</span>
			</td>			
			<td>
				<span>
					<i class="fa fa-sort"></i> {{trans('validation.attributes.frm.email')}}
				</span>
			</td>
			<td>
				{{trans('panel.tool')}}
			</td>
		</tr>
	</thead>
	<tbody>
		@foreach($list as $key => $item)
			<tr>
				<td>
					{{ ++$key }}
				</td>
				<td>
					{{ $item->name }}
				</td>
				<td>
					{{ $item->email }}
				</td>
				<td width="60px">
					<i class="fa fa-angle-down openRow2"></i>
					<input type="checkbox">
				</td>
			</tr>
			<tr class="row2">
				<td colspan="5">
					<a class="edit btn blue" href="/{{$section}}/edit/{{ $item->xid }}"><i class="fa fa-pencil-square-o"></i> {{trans('panel.edit')}}</a>
					<bottom class="btn red" data-remover="{!! URL::to('/') !!}/{{$section}}/destroy/{{ $item->xid }}"><i class="fa fa-trash"></i> {{trans('panel.remove')}}</bottom>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>