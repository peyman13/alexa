<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
		<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
		<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
		<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
			<li class="sidebar-toggler-wrapper">
				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				<div class="sidebar-toggler">
				</div>
				<!-- END SIDEBAR TOGGLER BUTTON -->
			</li>
			<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
			<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="AngularJS version demo">
				<a href="/">
				<i class="icon-home"></i>
					<span class="title">{{ @trans("panel.Home") }}</span>
				</a>
			</li>
			
			{{-- quick start example --}}
			{{--<li>
				<a href="javascript:;">
					<i class="icon-users"></i>
					<span class="title">{{trans("panel.customer manager")}}</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="/manager/customer/create">
							<i class="icon-user-follow"></i><span class="title"> {{trans("panel.add customer")}} </span>
						</a>
					</li>
					<li>
						<a href="/manager/customer">
							<i class="icon-user-following"></i><span class="title"> {{trans("panel.customer list")}} </span>
						</a>
					</li>
				</ul>
			</li>--}}
			{{-- quick end example --}}

			<li>
				<a href="/manager/layer">
				<i class="icon-folder"></i>
					<span class="title">{{ @trans('panel.category manager') }}</span>
				</a>
			</li>
			@foreach($dataShare as $key => $value)
				<li>
					<a href="javascript:;">
						<i class="icon-globe"></i>
						<span class="title">{{ trans("panel.archive") }} {{ @FNumber($value['xyear']) }}</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<?php $monthArray = explode(',', $value['xmonth']) ?>
						@foreach($monthArray as $k => $v)
							<li>
								<a href="/manager/site/index/?q[xdate_rankid][{{ explode(':', $v)[0] }}]={{ explode(':', $v)[0] }}">
									<i class="icon-calendar"></i><span class="title"> {{ explode(':', $v)[1] }}</span>
								</a>
							</li>
						@endforeach
					</ul>
				</li>
			@endforeach
			<li>
				<a href="javascript:;">
					<i class="icon-user"></i>
					<span class="title">{{trans("panel.report")}}</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="/manager/report/all_category">
							<i class="fa fa-pie-chart"></i>
							<span class="title">{{trans("panel.all chart")}}</span>
						</a>
					</li>
					<li>
						<a href="/manager/report/service">
							<i class="fa fa-pie-chart"></i>
							<span class="title">{{trans("panel.service")}}</span>
						</a>
					</li>
					<li>
						<a href="/manager/report/connection">
							<i class="fa fa-pie-chart"></i>
							<span class="title">{{trans("panel.connection")}}</span>
						</a>
					</li>
					<li>
						<a href="/manager/report/content">
							<i class="fa fa-pie-chart"></i>
							<span class="title">{{trans("panel.content")}}</span>
						</a>
					</li>
				</ul>
			</li>	
			<li>
				<a href="javascript:;">
					<i class="icon-user"></i>
					<span class="title">{{trans("panel.users manager")}}</span>
					<span class="arrow "></span>
				</a>
				<ul class="sub-menu">
					<li>
						<a href="/manager/account/role">
							<i class="icon-lock"></i>
							<span class="title">{{trans("panel.role")}}</span>
						</a>
					</li>
					<li>
						<a href="/manager/account/permission">
							<i class="icon-shield"></i>
							<span class="title">{{trans("panel.permission")}}</span>
						</a>
					</li>
					<li>
						<a href="/manager/account/users">
							<i class="icon-user-following"></i>
							<span class="title">{{trans("panel.users")}}</span>
						</a>
					</li>
				</ul>
			</li>	
		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>