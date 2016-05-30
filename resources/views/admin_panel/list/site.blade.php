<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
	<thead>
		<tr>
			<th width="10px">
				#
			</th>
			<th>
				<span>
					{{trans('validation.attributes.frm.xsite_title')}}
				</span>
			</th>	
			<th>
				<span>
					<!-- <i class="fa fa-sort"></i>  -->{{trans('validation.attributes.frm.xsite_url')}}
				</span>
			</th>
			{{-- baraye col dynamic ka range domah ro dar khod negah midarad --}}
			@if($head)
				<?php $maket = explode(",", $head) ?>
				@foreach($maket as $key => $value)
					<th>
						{!! FNumber(jDate::forge(explode("::", $value)[1])->format('%B %Y')); !!}
					</th>
				@endforeach
			@endif
			<th>
				<span data-sort='{"col":"xsite_location","order":"DESC"}'>
					<!-- <i class="fa fa-sort"></i>  -->{{trans('validation.attributes.frm.xsite_location')}}
				</span>
			</th>			
			<th>
				<span>
					{{trans('panel.category')}}
				</span>
			</th>
			<th>
				<span data-sort='{"col":"xcategory_desceription","order":"DESC"}'>
					<!-- <i class="fa fa-sort"></i>  -->{{trans('validation.attributes.frm.xsite_description')}}
				</span>
			</th>		
			<th>
				<span data-sort='{"col":"xsite_rank","order":"DESC"}'>
					<!-- <i class="fa fa-sort"></i>  -->{{trans('validation.attributes.frm.xsite_status')}}
				</span>
			</th>
			<th>
				{{trans('panel.tool')}}
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach($list as $key => $item)
			<tr>
				<td>
					{{ ++$key }}
				</td>
				<td>
					{{ $item->xsite_title }}
				</td>
				<td style="direction: ltr">
					{{ $item->xsite_url }}
				</td>
				{{-- baraye col dynamic ka range domah ro dar khod negah midarad --}}
				<?php $rankCol = explode(",", $item->rank_number) ?>
				@foreach($maket as $k => $value)
					<td>
						@foreach($rankCol as $key1 => $value1)
							@if(explode("::",$value1)[1] == explode("::", $value)[1])
								{{explode("::",$value1)[0]}}
							@endif
						@endforeach
					</td>
				@endforeach
				<td>
					{{ trans("panel.location_".$item->xsite_location) }}
				</td>				
				<td>
					<?php $layer = explode(",", $item->layerid) ?>
					@foreach($layer as $k => $value)
						@if($value)
							{{ App\Model\Layer::getLayer($value) }} <br />
						@endif
					@endforeach
				</td>
				<td>
					<span data-toggle="tooltip" data-placement="down" title="{{ $item->xsite_description }}">{{ $item->xsite_description }}</span>
				</td>
				<td>
					{{ trans("panel.status_".$item->xsite_status) }}
				</td>
				<td width="60px">
					<a class="edit btn blue" href="edit/{{ $item->xid }}"><i class="fa fa-pencil-square-o"></i> {{trans('panel.edit')}}</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>