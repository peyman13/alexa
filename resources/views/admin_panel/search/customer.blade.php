<form method="get" id="optional">
	<div class="raw">
		<div class="col-lg-4">
			<div class="form-group">
				<label for="exampleInputEmail1">{{trans('validation.attributes.frm.xcustomer_name')}} :</label>
				<input type="text" value="{{@$q['xcustomer_name']['like']}}" class="form-control" name="q[xcustomer_name][like]" />
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<label for="exampleInputEmail1">{{trans('validation.attributes.frm.xcustomer_family')}} :</label>
				<input type="text" value="{{@$q['xcustomer_family']['like']}}" class="form-control" name="q[xcustomer_family][like]" />
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