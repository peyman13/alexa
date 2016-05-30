<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
		<thead>
			<tr style="background-color:#00AD95; font-weight: bold; color: #fff;">
				<td>
					{{trans('validation.attributes.frm.xsite_title')}}
				</td>	
				<td>
					{{trans('validation.attributes.frm.xsite_url')}}
				</td>
				{{-- baraye col dynamic ka range domah ro dar khod negah midarad --}}
				<?php $maket = explode(",", $head) ?>
				@foreach($maket as $key => $value)
					<td>
						{!! FNumber(jDate::forge(explode("::", $value)[1])->format('%B %Y')); !!}
					</td>
				@endforeach
				<td>
					{{trans('validation.attributes.frm.xsite_location')}}
				</td>			
				<td>
					{{trans('panel.category')}}	
				</td>
				<td>
					{{trans('validation.attributes.frm.xsite_description')}}
				</td>		
				<td>
				 	{{trans('validation.attributes.frm.xsite_status')}}
				</td>
			</tr>
		</thead>
		<tbody>
			@foreach($list as $key => $item)
				<tr>
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
				</tr>
			@endforeach
		</tbody>
	</table>
</html>