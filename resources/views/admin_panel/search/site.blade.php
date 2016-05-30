<form method="get" id="optional">
	<div class="raw">
		<div class="col-lg-4">
			<div class="portlet box blue">
				<div class="portlet-title">
				    <div class="caption">
				        <i class="fa fa-code-fork"></i>{{trans('panel.category select')}} </div>
				    <div class="tools">
				        <a href="javascript:;" class="collapse"></a>
				    </div>
				</div>
				<div class="portlet-body tabs-below">
				    <div class="tab-content">        
				        <div class="tab-pane active" id="tab_4_1">
		        			<div id="html1" class="tree-holder scroller">
								{{ @makeTree($tree)}}
							</div>	
				        </div>
				    </div>
				</div>
				<input type="hidden" id="layerid" name="q[xlayerid]" value="{{ @$q['xlayerid']}}" />
			</div>
		</div>
		<div class="col-lg-2">
			<div class="portlet box blue">
				<div class="portlet-title">
				    <div class="caption">
				        <i class="fa fa-filter"></i>{{trans('panel.filter status')}} </div>
				    <div class="tools">
				        <a href="javascript:;" class="collapse"></a>
				    </div>
				</div>
				<div class="portlet-body tabs-below">
					<div class="tab-content">
						<div class="tab-pane active" id="tab_4_1">
							<div class="tree-holder scroller">
								<div dir="ltr" style="text-align: right;">
									{!! Form::label(trans("panel.status_up"), null, ['class' => 'control-label']) !!}
									{!! Form::checkbox("q[xsite_status][up]",'up',@$q['xsite_status']['up'],  ['class' => 'form-control']) !!}
								</div>
								<div dir="ltr" style="text-align: right;">
									{!! Form::label(trans("panel.status_down"), null, ['class' => 'control-label']) !!}
									{!! Form::checkbox("q[xsite_status][down]",'down',@$q['xsite_status']['down'],  ['class' => 'form-control']) !!}
								</div>
								<div dir="ltr" style="text-align: right;">
									{!! Form::label(trans("panel.status_filter"), null, ['class' => 'control-label']) !!}
									{!! Form::checkbox("q[xsite_status][filter]",'filter',@$q['xsite_status']['filter'],  ['class' => 'form-control']) !!}
								</div>
								<div dir="ltr" style="text-align: right;">
									{!! Form::label(trans("panel.status_block"), null, ['class' => 'control-label']) !!}
									{!! Form::checkbox("q[xsite_status][block]",'block',@$q['xsite_status']['block'],  ['class' => 'form-control']) !!}
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>		
		<div class="col-lg-2">
			<div class="portlet box blue">
				<div class="portlet-title">
				    <div class="caption">
				        <i class="fa fa-map-marker"></i>{{trans('panel.site location')}} </div>
				    <div class="tools">
				        <a href="javascript:;" class="collapse"></a>
				    </div>
				</div>
				<div class="portlet-body tabs-below">
					<div class="tab-content">
						<div class="tab-pane active" id="tab_4_1">
							<div class="tree-holder scroller">
								<div dir="ltr" style="text-align: right;">
									{!! Form::label(trans("panel.iran server"), null, ['class' => 'control-label']) !!}
									{!! Form::checkbox("q[xsite_location][in]","in", @$q['xsite_location']['in'], ['class' => 'form-control']) !!}
								</div>
								<div dir="ltr" style="text-align: right;">
									{!! Form::label(trans("panel.no iran server"), null, ['class' => 'control-label']) !!}
									{!! Form::checkbox("q[xsite_location][out]","out", @$q['xsite_location']['out'], ['class' => 'form-control']) !!}
								</div>
								<div dir="ltr" style="text-align: right;">
									{!! Form::label(trans("panel.unknown server"), null, ['class' => 'control-label']) !!}
									{!! Form::checkbox("q[xsite_location][unknown]","unknown", @$q['xsite_location']['unknown'], ['class' => 'form-control']) !!}
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="portlet box blue">
				<div class="portlet-title">
				    <div class="caption">
				        <i class="fa fa-calendar"></i>{{trans('panel.alexa archive')}} </div>
				    <div class="tools">
				        <a href="javascript:;" class="collapse"></a>
				    </div>
				</div>
				<div class="portlet-body tabs-below">
					<div class="tab-content">
						<div class="tab-pane active" id="tab_4_1">
							<div class="tree-holder scroller">
								<div class="archive-search">
									@foreach($dataShare as $key => $value)
										<li>
											<i class="icon-globe"></i>
											<span class="title">{{ trans("panel.archive") }} {{ @FNumber($value['xyear']) }}</span>
											<span class="arrow "></span>
											<dl class="sub-menu archive-search">
												<?php $monthArray = explode(',', $value['xmonth']) ?>
												@foreach($monthArray as $k => $v)
													<dd>
														<?php $rankid =  explode(':', $v)[0] ?>
														{!! Form::checkbox("q[xdate_rankid][".$rankid."]", $rankid, @$q['xdate_rankid'][$rankid], ['class' => 'form-control']) !!}
														<span class="title"> {{ explode(':', $v)[1] }}</span>
													</dd>
												@endforeach
											</dl>
										</li>
									@endforeach
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>		
		<div class="col-lg-2">
			<div class="portlet box blue">
				<div class="portlet-title">
				    <div class="caption">
				        <i class="fa fa-caret-up"></i>{{trans('panel.delta')}} </div>
				    <div class="tools">
				        <a href="javascript:;" class="collapse"></a>
				    </div>
				</div>
				<div class="portlet-body tabs-below">
					<div dir="ltr" style="text-align: right;">
						<span>{{ @FNumber(trans('panel.delta uper 100')) }}</span>
						{!! Form::radio("frm[xcustomer_name]",@$value['xcustomer_name'], ['class' => 'form-control']) !!}
					</div>
					<div dir="ltr" style="text-align: right;">
						<span>{{ @FNumber(trans('panel.delta down 100')) }}</span>
						{!! Form::radio("frm[xcustomer_name]",@$value['xcustomer_name'], ['class' => 'form-control']) !!}
					</div>	
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="portlet box blue">
				<div class="portlet-title">
				    <div class="caption">
				        <i class="icon-globe"></i>{{trans('panel.view from web site')}} </div>
				    <div class="tools">
				        <a href="javascript:;" class="collapse"></a>
				    </div>
				</div>
				<div class="portlet-body tabs-below">
					<div class="tab-content">
						<div class="tab-pane active" id="tab_4_1">
							<div class="tree-holder scroller">
								<div class="archive-search">
									<div dir="ltr" style="text-align: right;">
										{!! Form::label(FNumber(trans("panel.list 500 website")), null, ['class' => 'control-label']) !!}
										{!! Form::radio("frm[xcustomer_name]",@$value['xcustomer_name'], ['class' => 'form-control']) !!}
									</div>
									<div dir="ltr" style="text-align: right;">
										{!! Form::label(FNumber(trans("panel.in of 500")), null, ['class' => 'control-label']) !!}
										{!! Form::radio("frm[xcustomer_name]",@$value['xcustomer_name'], ['class' => 'form-control']) !!}
									</div>
									<div dir="ltr" style="text-align: right;">
										{!! Form::label(FNumber(trans("panel.out if 500")), null, ['class' => 'control-label']) !!}
										{!! Form::radio("frm[xcustomer_name]",@$value['xcustomer_name'], ['class' => 'form-control']) !!}
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<br />
	<input type="hidden" id="col" name="o[col]" value=""  />
	<input type="hidden" id="order" name="o[order]" value=""  />
	<input type="hidden" name="export" id="excel_export"> 
	<div class="raw">
		<div class="col-lg-4">
			<div class="form-group">
				<input type="button" id="submit_search" class="btn btn-primary" value="{{trans('panel.search')}}" />
			</div>
		</div>
	</div>
</form>