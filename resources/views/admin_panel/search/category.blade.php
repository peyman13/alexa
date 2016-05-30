<form method="get" id="optional">
	<div class="raw">
		<div class="col-lg-4">
			<div class="form-group">
				<label for="exampleInputEmail1">{{trans('validation.attributes.frm.xcategory_title')}} :</label>
				<input type="text" value="{{@$q['xcategory_title']['like']}}" class="form-control" name="q[xcategory_title][like]" />
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<label for="exampleInputEmail1">{{trans('validation.attributes.frm.xcategory_description')}} :</label>
				<input type="text" value="{{@$q['xcategory_description']['like']}}" class="form-control" name="q[xcategory_description][like]" />
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<input type="hidden" id="col" name="o[col]" value=""  />
	<input type="hidden" id="order" name="o[order]" value=""  />
	<div class="raw">
		<div class="col-lg-4">
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="{{trans('panel.search')}}" />
			</div>
		</div>
	</div>
</form>