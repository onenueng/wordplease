<div class="panel panel-primary" id="pregnancy_panel"><!-- Pregnancy panel. -->
	<div class="panel-heading">Pregnancy</div>
	<div class="panel-body">
		<div class="form-horizontal row">
			<div class="col-md-2">
				<div class="form-group">
					<label class="col-md-4 control-label" for="G">G :</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><span class="fa fa-times-circle-o"></span></span>
							<input class="form-control" type="text" name="G">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="col-md-4 control-label" for="P">P :</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><span class="fa fa-times-circle-o"></span></span>
							<input class="form-control" type="text" name="P">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="col-md-4 control-label" for="A">A :</label>
					<div class="col-md-8">
						<div class="input-group">
							<span class="input-group-addon"><span class="fa fa-times-circle-o"></span></span>
							<input class="form-control" type="text" name="A">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4" for="">GA :</label>
					<div class="col-md-4">
						<div class="input-group">
							<input class="form-control" type="number" name="">
							<span class="input-group-addon">weeks</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<input class="form-control" type="number" name="">
							<span class="input-group-addon">days</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='panel panel-default'>
			<div class='panel-heading'>Allergy</div>
			<div class='panel-body'>
				<div class="row">
					<div class="col-md-2">
						<div class="checkbox"><label><input type="checkbox" name="allergy">None</label></div>
					</div>
					<div class="col-md-2">
						<div class="checkbox"><label><input type="checkbox" name="allergy" id="allergy_drugs">Penicilin</label></div>
					</div>
					<div class="col-md-2">
						<div class="checkbox"><label><input type="checkbox" name="allergy" id="allergy_others">Sulfonamide</label></div>
					</div>
					<div class="col-md-2">
						<div class="checkbox"><label><input type="checkbox" name="allergy" id="allergy_others">NSAIDS</label></div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						<textarea name="other_drug_allergy" id="other_drug_allergy" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified other drug allergy. 255 characters max."></textarea>
						<div id="other_drug_allergy_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						<textarea name="other_allergy" id="other_allergy" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified other allergy. 255 characters max."></textarea>
						<div id="other_allergy_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='panel panel-default'>
			<div class='panel-heading'>Diseases</div>
			<div class='panel-body'>
				<div class="row">
					<div class="col-md-2">
						<div class="checkbox"><label><input type="checkbox" name="allergy">None</label></div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						<textarea name="spectified_diseases" id="spectified_diseases" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified other allergy. 255 characters max."></textarea>
						<div id="spectified_diseases_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='panel panel-default'>
			<div class='panel-heading'>Treatments</div>
			<div class='panel-body'>
				<div class="row">
					<div class="col-md-2">
						<div class="checkbox"><label><input type="checkbox" name="allergy">None</label></div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						<textarea name="specified_surgery" id="specified_surgery" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified surgery here. 255 characters max."></textarea>
						<div id="specified_surgery_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						<textarea name="specified_treatment" id="specified_treatment" class="form-control text_area_feedback" rows="1" maxlength="255" placeholder="Specified treatments here. 255 characters max."></textarea>
						<div id="specified_treatment_feedback" style="color:#b3b3b3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>