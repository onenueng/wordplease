<script type="text/javascript">
	/**
	*	These two mathods can be move to master page form handle other collapse show/hide.
	**/

	/**
	*	Handle radio input those has text area in collapse.
	*	Just add class has-other-textarea to those radio input.
	**/
	$('.has-other-textarea').change(function() {
		if ($(this).val() == 99) {
			$('#' + $(this).prop('name') + '_other_collapse').collapse('show');
			$('textarea[name=' + $(this).prop('name') + '_other]').focus();
		} else {
			$('#' + $(this).prop('name') + '_other_collapse').collapse('hide');
			$('textarea[name=' + $(this).prop('name') + '_other]').val('');
		}
	});

	/**
	*	Handle remove icon of radio input those has text area in collapse.
	*	Just add class reset-has-other-textarea to the remove icon.
	**/
	$('.reset-has-other-textarea').click(function() {
		$('#' + $(this).attr('target') + '_other_collapse').collapse('hide');
		$('textarea[name=' + $(this).attr('target') + '_other]').val('');
	});
	//******************************************************************

	/**
	*	Handle controls in Comorbid data.
	**/

	// Handle style when click buttons.
	$('.btn-comorbid-list').click(function() {
		$('.btn-comorbid-list').removeClass('active');
		$(this).addClass('active');
	});

	// Handle set-all-comorbid buttons.
	$('.btn-set-all').click(function() {
		var value = $(this).text() == 'No data all' ? 99 : 0;
		$("input[name*='comorbid'][value='" + value + "']").click();
	});
	//******************************************************************

	/** Common methods use for comorbid. **/
	/**
	*	Also reset all input related to radio input with collapse inputs when click remove icon.
	* The process is just click on radio other option (value=99) to perform its click event,
	* then set its checked to false.
	**/
	$('.reset-comorbid-has-extra-detail').click(function() {
		$('input[name=' + $(this).attr('target') + '][value=99]').click();
		$('input[name=' + $(this).attr('target') + '][value=99]').prop('checked', false);
		$(this).css('display', 'none'); // Hide remove icon itself.
	});

	/**
	*	Show/hide other collapse inputs.
	* When hide, reset all inputs but not all line of code are affected,
	* because of the target elements may be not exist.
	**/
	$('.comorbid-has-extra-detail').click(function() {
		if ($(this).val() == 1) { // Yes.
			$('#' + $(this).prop('name') + '_collapse').collapse('show');
		} else { // Else or no data.
			// Handle checkbox and radio input.
			$('input[name^=' + $(this).prop('name').replace('comorbid_', '') + ']').prop('checked', false);
			$('input[name^=' + $(this).prop('name').replace('comorbid_', '') + ']').val('');
			$('a[target^=' + $(this).prop('name').replace('comorbid_', '') + ']').css('display', 'none');
			
			// Handle textarea input and its collapse.
			$('textarea[name^=' + $(this).prop('name').replace('comorbid_', '') + ']').val('');
			$('[id^=' + $(this).prop('name').replace('comorbid_', '') + '][id$=_collapse]').collapse('hide');
			
			// Hide extra detail.
			$('#' + $(this).prop('name') + '_collapse').collapse('hide');			
		}
	});
	//******************************************************************

	/**
	*	Trigger cirrhosis ethiology to check 'Yes' on related comorbid, But just one-time triggering.
	* Also reset another input when check the cryptogenic, one-time triggering too.
	**/
	$('input[name^=cirrhosis_etiology_]').click(function() { //.cirrhosis-ethiology
		if ($(this).prop('checked')) {
			switch ($(this).prop('name')) {
				case 'cirrhosis_etiology_HBV' :
				case 'cirrhosis_etiology_HCV' :
					$('input[name=' + $(this).prop('name').replace('cirrhosis_etiology_', 'comorbid_') + '][value=1]').click();
				case 'cirrhosis_etiology_NASH' :
					$('input[name=cirrhosis_etiology_cryptogenic]').prop('checked', false);
					break;
				case 'cirrhosis_etiology_cryptogenic' :
					$('input[name^=cirrhosis_etiology_]').prop('checked', false);
					$(this).prop('checked', true);
					$('textarea[name=cirrhosis_etiology_other]').val('');
			}
		}
	});
	/** Uncheck cirrhosis_etiology_cryptogenic when typing on cirrhosis_etiology_other. **/
	$('textarea[name=cirrhosis_etiology_other]').on('input change', function() {
		if ($('input[name=cirrhosis_etiology_cryptogenic]').prop('checked'))
			$('input[name=cirrhosis_etiology_cryptogenic]').prop('checked', false);
	});
	//******************************************************************

	/** Check comorbid_TB when HIV_pre_infect_TB was checked.  **/
	$('input[name=HIV_pre_infect_TB]').click(function() {
		if ($(this).prop('checked')) $('input[name=comorbid_TB][value=1]').click();
	});
	//******************************************************************

	/**
	* .yes-then-extra-input When checked Yes(1) then enable and focus on associate input.
	* Just add .yes-then-extra-input to radio input and name extra input with prefix.
	* Also clear and disable associate input when check else.
	**/
	$('.yes-then-extra-input').change(function() {
		if ($(this).val() == 1) {
			$('input[name^=' + $(this).prop('name') + '_]').prop('disabled', false);
			$('input[name^=' + $(this).prop('name') + '_]').focus();
			return;
		}
		$('input[name^=' + $(this).prop('name') + '_]').prop('disabled', true);
		$('input[name^=' + $(this).prop('name') + '_]').val('');
	});
	//******************************************************************

	/**
	* .has-template-helper When check Yes(1) or not No(!=0) then show template helper.
	* Name the template helper div by radio-input name + _collapse.
	**/
	$('.has-template-helper').change(function() {
		$('[id^=' + $(this).prop('name') + '][id$=_collapse]').collapse($(this).val() >= 1 ? 'show' : 'hide'); // yes == 1.
	});

	

	/**
	* .btn-template When click on button-group then handle an active button.
	**/
	$('.btn-template').click(function() {
		$('.btn-template.active[group=' + $(this).attr('group') + ']').removeClass('active');
		$(this).addClass('active');
		
		if (!!$(this).attr('child-template-action')) { // equivalent to (typeof attr !== typeof undefined && attr !== false)
			$('#' + $(this).attr('group')).collapse($(this).attr('child-template-action') == 'off' ? 'hide' : 'show');
		}

		if (!!$(this).attr('extra-template-action')) { // equivalent to (typeof attr !== typeof undefined && attr !== false)
			if ($(this).attr('extra-template-action') == 'off') {
				$('[group^=' + $(this).attr('group') + '_').removeClass('active');
				$('#' + $(this).attr('group')).collapse('hide');
			} else {
				$('#' + $(this).attr('group')).collapse('show');
			}
		}
	});

	$('.has-parent-template').click(function() {
		var splitName = $(this).attr('group').split('_');
		var parentGroupName = '';
		var siblingName = '';
		var caption = '';

		/**
		* Remove first and last word of $(this) group name, then we get parent group name.
		* Use group = parentGroupName + fallback-caption = $(this) parent name as selector.
		**/
		for (var i = 1; i <= splitName.length - 3; i++) parentGroupName += (splitName[i] + '_');
		parentGroupName += splitName[i];
		parentGroupName = "[group=" + parentGroupName + "][fallback-caption=" + $(this).attr('parent') + "]";

		/**
		* Remove last word of $(this) group name, then we get start of sibling name.
		**/
		for (var i = 0; i <= splitName.length - 2; i++) siblingName += (splitName[i] + '_');
		
		/**
		* Concat all sibling text.
		* Then set it to parent caption.
		**/
		$('.btn-template.has-parent-template.active[group^=' + siblingName + ']').each(function() {
			caption += ((!!$(this).attr('caption')) ? $(this).attr('caption') : $(this).text() ) + ' ';
		});
		$(parentGroupName).attr('caption', caption.trim());

		/**
		* In case of remove all child choices.
		* Then reset parent caption using fallback-caption.
		**/
		if ($(this).attr('caption') == "") {
			$(this).removeClass('active');
			if ($(parentGroupName).attr('caption') == "") {
				$(parentGroupName).attr('caption', $(parentGroupName).attr('fallback-caption'));
			}
			return;
		}

		/**
		* Update grandparent.
		***/
		if (!!$(parentGroupName).attr('parent')) {
			// console.log('has grandparent');
		} else {
			// console.log('no grandparent');
		}

	});

	/**
	* .btn-template-add, 'Add' button on template helper.
	* Concat text on all active button then put it on target textarea, autosize and focus.
	* Also provide roles 'put' and 'append'.
	**/
	$('.btn-template-add').click(function() {
		var reply = '';
		$('.btn-template.active[group^=' + $(this).attr('target') + ']').each(function() {
			reply +=  ((!!$(this).attr('caption')) ? $(this).attr('caption') : $(this).text() ) + ' ';
		});

		// if (reply == '') { // case reset.
		// 	$('textarea[name=' + $(this).attr('target') + ']').val('');
		// 	autosize.update($('textarea[name=' + $(this).attr('target') + ']'));
		// 	return;
		// }

		reply.trim();

		if ($(this).attr('role') == 'put-en') {
			if (reply.length > 1) {
				reply = reply.charAt(0).toUpperCase() + reply.slice(1);
				reply = (reply[reply.length - 1] == ',') ? reply.substr(0, (reply.length - 1)) + '.' : reply.substr(0, (reply.length - 2)) + '.';
				$('textarea[name=' + $(this).attr('target') + ']').val(reply);
			} else { // case reset
				$('textarea[name=' + $(this).attr('target') + ']').val('');
			}
		}
		else if ($(this).attr('role') == 'put' || $('textarea[name=' + $(this).attr('target') + ']').val() == '')
			$('textarea[name=' + $(this).attr('target') + ']').val(reply);
		else
			$('textarea[name=' + $(this).attr('target') + ']').val($('textarea[name=' + $(this).attr('target') + ']').val() + '\n' + reply);

		autosize.update($('textarea[name=' + $(this).attr('target') + ']'));
		$('textarea[name=' + $(this).attr('target') + ']').focus();
	});

	/**
	* .btn-template-close, Close template helper.
	**/
	$('.btn-template-close').click(function() {
		$('#' + $(this).attr('target') + '_template_collapse').collapse('hide');
	});

	/**
	* .btn-template-reset, reset template helper.
	**/
	$('.btn-template-reset').click(function() {
		$('.btn-template.active[group^=' + $(this).attr('target') + ']').each(function() {
			$(this).removeClass('active');
		});
		$('.btn-template.active[group^=child_' + $(this).attr('target') + ']').each(function() {
			$(this).removeClass('active');
		});
		console.log('.collapse[group^=' + $(this).attr('target') + ']');
		$('.collapse[id^=' + $(this).attr('target') + ']').not('[id*=collapse]').each(function() {
			console.log($(this).prop('id'));
			$(this).collapse('hide');
		});
	});

	$('.btn-template-topic-toggle').click(function() {
		if ($(this).attr('role') == 'show') {
			$('#' + $(this).attr('target')).collapse('hide');
			$(this).attr('role', 'hide')
			// $(this).children().removeClass('fa-remove');
			// $(this).children().addClass('fa-check-circle-o');
			// $('[group^=' + $(this).attr('target') + '_]').removeClass('active');
		} else {
			$('#' + $(this).attr('target')).collapse('show');
			$(this).attr('role', 'show')
			// $(this).children().removeClass('fa-check-circle-o');
			// $(this).children().addClass('fa-remove');
		}
	});

	$('.btn-template-topic-reset').click(function() {
		$('[group^=' + $(this).attr('target') + '_]').removeClass('active');
		$('[group^=child_' + $(this).attr('target') + '_]').removeClass('active');
	});

	/**
	* Addition code for btn Put on smoking.
	* Need to place code after .btn-template-add event.
	**/
	$('#btn_put_smoking').click(function() {
		if ($("input[name='smoking']:checked").val() == 2) //case ex-smoker
			var endText = '\n\nเริ่มสูบเมื่อ ปี xx / อายุ xx ปี\nหยุดสูบเมื่อ ปี xx / อายุ xx ปี';				
		else //case smoker
			var endText = '\n\nเริ่มสูบเมื่อ ปี xx / อายุ xx ปี';
		$('textarea[name=smoking_amount]').val($('textarea[name=smoking_amount]').val() + endText);
		autosize.update($('textarea[name=smoking_amount]'));
		$('textarea[name=smoking_amount]').focus();
	});
	//******************************************************************

	$("input[name=ward_name]").data("ui-autocomplete")._renderItem = function(ul, item) {
				return $("<li></li>")
								.data("item.autocomplete", item)
								.append("<span>" + String(item.label)
									.replace(new RegExp(this.term, "gi"),"<span class='ui-state-highlight'>$&</span>") + "</span>")
								.appendTo(ul);
	}; // Mannual format autocomplete result for ward_name.

	$("input[name=attending_name]").data("ui-autocomplete")._renderItem = function(ul, item) {
				return $("<li></li>")
								.data("item.autocomplete", item)
								.append("<span>" + String(item.label)
									.replace(new RegExp(this.term, "gi"),"<span class='ui-state-highlight'>$&</span>") + "</span>")
								.appendTo(ul);
	}; // Mannual format autocomplete result for attending_name.

	$("input[name=division_name]").data("ui-autocomplete")._renderItem = function(ul, item) {
		return $("<li></li>")
						.data("item.autocomplete", item)
						.append("<span>" + String(item.label)
							.replace(new RegExp(this.term, "gi"),"<span class='ui-state-highlight'>$&</span>") + "</span>")
						.appendTo(ul);
	}; // Mannual format autocomplete result for division_name.

	$('input[target=current_medications]').data("ui-autocomplete")._renderItem = function(ul, item) {
			return $("<li></li>")
						.data("item.autocomplete", item)
						.append("<span>" + String(item.label)
							.replace(new RegExp(this.term, "gi"),"<span class='ui-state-highlight'>$&</span>") + "</span>")
						.appendTo(ul);
	}; // Mannual format autocomplete result for current_medications.	
	//******************************************************************

	/** Show/Hide textarea and change icon. **/
	$('.icon-toggle-collapse-textarea').click(function() {
		if ($(this).hasClass('fa-toggle-on')) {
			$(this).removeClass('fa-toggle-on');
			$(this).addClass('fa-toggle-off');
			$('#' + $(this).attr('target')).collapse('hide');
			return;
		}
		$(this).removeClass('fa-toggle-off');
		$(this).addClass('fa-toggle-on');
		$('#' + $(this).attr('target')).collapse('show');
	});
	//******************************************************************

	/**
	* Function on Vital signs.
	**/

	/** auto-calculate BMI. **/
	$('.bmi-params').change(function() {
		if ($.isNumeric($('input[name=height_cm]').val()) && $.isNumeric($('input[name=weight_kg]').val())) {
			var bmi = $('input[name=weight_kg]').val() / $('input[name=height_cm]').val() / $('input[name=height_cm]').val() * 10000;
			$('input[name=BMI]').val(bmi.toFixed(2));
			return;
		}
		$('input[name=BMI]').val('');
	});

	/** Handle breathing selection. Show/Hide extra input and change unit label. **/
	$('input[name=breathing]').click(function() {
		if ($(this).val() == 1) {
			$('#o2_rate_collapse').collapse('hide');
			$('input[name=o2_rate]').val('');
			$('#o2_rate_unit').text('');
			return;
		}
		$('#o2_rate_collapse').collapse('show');
		if ($(this).val() == 4) {
			$('#o2_rate_unit').text('FiO2');
			return;
		}
		$('#o2_rate_unit').text('L/min');
	});

	/** Also clear extra input when reset breathing radio input. **/
	$('a[target=breathing]').click(function() {
		$('input[name=breathing][value=1]').click();
		$('input[name=breathing][value=1]').prop('checked', false);
		$(this).css('display', 'none');
	});

	/** auto-calculate GCS. **/
	$('select[name^=GCS_]').change(function() {
		var sum = 0;
		$('select[name^=GCS_]').each(function() { sum += parseInt($(this).val()); });
		if (!isNaN(sum)) handleGCSChange(sum);
	});

	/** Also clear extra input when reset GCS radio input. **/
	$('a[target^=GCS_]').click(function() {
		$('input[name=GCS]').val('');
		$('input[name=GCS_label]').val('');
	});

	/** Calculate and fill in GCS inputs. **/
	function handleGCSChange(sum) {
		var gcs, gcsLabel;
		if (sum < 9) {
			gcs = 3;
			gcsLabel = 'Severe [GCS < 9]';
		} else if (sum < 13) {
			gcs = 2;
			gcsLabel = 'Moderate [9 <= GCS < 13]';
		} else {
			gcs = 1;
			gcsLabel = 'Minor [13 <= GCS <= 15]'
		}
		$('input[name=GCS]').val(gcs);
		$('input[name=GCS_label]').val(gcsLabel);
	}
	//******************************************************************
	$('.create-canvas').click(function() {
		// if ($(this).attr('drawingsNo') > 1) {
		// 	console.log('show gallery');
		// 	return;
		// }
		
		// console.log('create canvas');
		
		$('#' + $(this).attr('target')).collapse('show');
		$('.active.select-canvas.fa-unlock-alt').addClass('fa-lock');
		$('.active.select-canvas.fa-unlock-alt').removeClass('fa-unlock-alt');
		$('.active.select-canvas').removeClass('active');

		initCanvas($(this).attr('target'), $(this).attr('drawing'));
	});

	// function initCanvas(divID, name) {
	// 	/*** Clear style of last active object. ***/
	// 	$('.active.select-canvas.fa-unlock-alt').addClass('fa-lock');
	// 	$('.active.select-canvas.fa-unlock-alt').removeClass('fa-unlock-alt');
	// 	$('.active.select-canvas').removeClass('active');
	// 	$('canvas.active').removeClass('active');

	// 	/*** Create canvas element and its div container and select button. ***/
	// 	$('#' + divID).append('<div class="text-center canvas-div" drawing="' + name + '" id="' + name + '_canvas_div"><span class="btn btn-default btn-xs active select-canvas fa fa-unlock-alt" target="' + name + '" role="button"></span><canvas id="' + name + '_canvas" class="active"></canvas></div>');

	// 	/*** Define click event for new canvas select button on the fly. ***/
	// 	$('.active.select-canvas').click(function() {
	// 		if (!$(this).hasClass('active')) { // Check if click on inactive button.
	// 			/*** Clear style of last active object. ***/
	// 			$('.active.select-canvas.fa-unlock-alt').addClass('fa-lock');
	// 			$('.active.select-canvas.fa-unlock-alt').removeClass('fa-unlock-alt');
	// 			$('.active.select-canvas').removeClass('active');
	// 			$('canvas.active').removeClass('active');

	// 			/*** Style this active object. ***/
	// 			$(this).removeClass('fa-lock');
	// 			$(this).addClass('fa-unlock-alt');
	// 			$(this).addClass('active');
	// 			$('#' + $(this).attr('target') + '_canvas').addClass('active');

	// 			/*** Set active canvas point to selected canvas. Also set size and color too. ***/
	// 			canvas = getCanvasByName($(this).attr('target'));
	// 			canvas.freeDrawingBrush.color = pickedColor;
	// 			canvas.freeDrawingBrush.width = textSize;

	// 			/*** Set current canvas label. ***/
	// 			currentDrawing = name;
	// 			$('#drawing_label').text(name);
	// 		} // case active, do nothing.
	// 	});

	// 	/*** Set current canvas label. ***/
	// 	currentDrawing = name;
	// 	$('#drawing_label').text(name);

	// 	/*** Create new canvas then push in drawings. ***/
	// 	drawings[drawings.length] = new fabric.Canvas(name + '_canvas', {width: canvasWidth, height: canvasHeight, name: name });
	// 	canvas = drawings[drawings.length - 1]; // Set global canvas point to this canvas.
	// 	canvas.backgroundColor = backgroundColor;

	// 	/*** these methods should be review. ***/
	// 	canvas.isDrawingMode = true;
	// 	canvas.freeDrawingBrush.color = 'black';
	// 	canvas.freeDrawingBrush.width = 1;
	// 	setCanvasOverlayImage('/assets/images/drawings/medicine/' + name + '.svg', 0.8);
		
	// 	canvas.renderAll();

	// 	/*** Show canvas div collapse and drawing tools. ***/
	// 	$('#' + $(this).attr('target')).collapse('show');
	// 	$('#top-tool-bar').collapse('show');
	// }
	
	//******************************************************************

	/**
	*	Perform necessery methods after page is loaded.
	**/
	$(document).ready(function(){
		
		// $('#sticker').sticky({topSpacing:70});
		// Show collapse div.
		@if ($note->reason_admit == 99) $('#reason_admit_other').collapse('show'); @endif

		$('input[name^=comorbid_]:radio:checked').each(function() {
			console.log($(this).prop('name') + ' ' + $(this).val());
			$('#' + $(this).prop('name') + '_collapse').collapse('show');			
		});

		@if ($note->comorbid_DM == 1) $('#comorbid_DM_collapse').collapse('show'); @endif

		@if ($note->comorbid_CAD == 1) $('#comorbid_CAD_collapse').collapse('show'); @endif

		@if ($note->comorbid_VHD == 1) $('#comorbid_VHD_collapse').collapse('show'); @endif

		@if ($note->comorbid_stroke == 1) $('#comorbid_stroke_collapse').collapse('show'); @endif

		@if ($note->comorbid_CKD == 1) $('#comorbid_CKD_collapse').collapse('show'); @endif

		@if ($note->comorbid_hyperlipidema == 1) $('#comorbid_hyperlipidema_collapse').collapse('show'); @endif

		@if ($note->comorbid_cirrhosis == 1) $('#comorbid_cirrhosis_collapse').collapse('show'); @endif

		@if ($note->comorbid_HIV == 1) $('#comorbid_HIV_collapse').collapse('show'); @endif

		@if ($note->comorbid_epilepsy == 1) $('#comorbid_epilepsy_collapse').collapse('show'); @endif
		
		@if ($note->comorbid_leukemia == 1) $('#comorbid_leukemia_collapse').collapse('show'); @endif
		
		@if ($note->comorbid_lymphoma == 1) $('#comorbid_lymphoma_collapse').collapse('show'); @endif

		@if ($note->comorbid_pacemaker_implant == 1) $('#comorbid_pacemaker_implant_collapse').collapse('show'); @endif
		
		@if ($note->comorbid_ICD == 1) $('#comorbid_ICD_collapse').collapse('show'); @endif
		
		@if ($note->comorbid_cancer == 1) $('#comorbid_cancer_collapse').collapse('show'); @endif
		
		@if ($note->comorbid_chronic_arthritis == 1) $('#comorbid_chronic_arthritis_collapse').collapse('show'); @endif
		
		@if ($note->comorbid_other_autoimmune_disease == 1) $('#comorbid_other_autoimmune_disease_collapse').collapse('show'); @endif
		
		@if ($note->comorbid_TB == 1) $('#comorbid_TB_collapse').collapse('show'); @endif
		
		@if ($note->comorbid_dementia == 1) $('#comorbid_dementia_collapse').collapse('show'); @endif
		
		@if ($note->comorbid_psychiatric_illness == 1) $('#comorbid_psychiatric_illness_collapse').collapse('show'); @endif

	});
</script>