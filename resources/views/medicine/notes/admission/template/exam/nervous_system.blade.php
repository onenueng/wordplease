<?php
    $sides = [
            'right',
            'left',
            'both'
        ];
?>
<div class="well clearfix"> 
    
    <!-- level of consciousness -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">level of consciousness</label>
        <span class="fa fa-ellipsis-v"></span>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_consciousness" caption="Alert,">alert</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_consciousness" caption="Drawsy,">drawsy</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_consciousness" caption="Stuporous,">stuporous</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_consciousness" caption="Semicoma,">semicoma</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_consciousness" caption="Coma,">coma</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_consciousness"><span class="fa fa-remove"></span></button>
        </div>
    </div>

    <!-- higher cognitive function -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">higher cognitive function</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cognitive" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cognitive" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>
    
    <!-- indent higher cognitive function -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cognitive">
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">language</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_language" child-template-action="off" caption="normal language,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_language" child-template-action="on" caption="abnormal language," fallback-caption="abnormal language,">abnormal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_language" child-template-action="off"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cognitive_language">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">aphasia</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="'abnormal language,'" group="child_specified_physical_exam_nervous_system_cognitive_language_aphasia" caption="Broca aphasia,">Broca (slow, disarticulation)</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="'abnormal language,'" group="child_specified_physical_exam_nervous_system_cognitive_language_aphasia" caption="Wernicke aphasia,">Wernicke (content abnormality)</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="'abnormal language,'" group="child_specified_physical_exam_nervous_system_cognitive_language_aphasia" caption="global aphasia,">global</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="'abnormal language,'" group="child_specified_physical_exam_nervous_system_cognitive_language_aphasia" caption="please_specify_other_aphasia,">other</button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">dysphasia</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="'abnormal language,'" group="child_specified_physical_exam_nervous_system_cognitive_language_dysphasia" caption="Broca dysphasia,">Broca (slow, disarticulation)</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="'abnormal language,'" group="child_specified_physical_exam_nervous_system_cognitive_language_dysphasia" caption="Wernicke dysphasia,">Wernicke (content abnormality)</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="'abnormal language,'" group="child_specified_physical_exam_nervous_system_cognitive_language_dysphasia" caption="global dysphasia,">global</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" parent="'abnormal language,'" group="child_specified_physical_exam_nervous_system_cognitive_language_dysphasia" caption="please_specify_other_dysphasia,">other</button>
                </div>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">neglect</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect" extra-template-action="off" caption="no neglect,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect" extra-template-action="on" caption="neglect,">yes</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect" extra-template-action="off"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cognitive_neglect">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">sensory</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect_sensory" caption="sensory right,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect_sensory" caption="sensory left,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect_sensory" caption="sensory both,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect_sensory"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">visual</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect_visual" caption="visual right,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect_visual" caption="visual left,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect_visual" caption="visual both,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_neglect_visual"><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">astereognosia</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_astereognosia" caption="no astereognosia,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_astereognosia" caption="astereognosia right,">right</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_astereognosia" caption="astereognosia left,">left</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_astereognosia" caption="astereognosia both,">both</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_astereognosia"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">acalculia</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_acalculia" caption="no acalculia,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_acalculia" caption="acalculia,">yes</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_acalculia"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">agraphia</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_agraphia" caption="no agraphia,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_agraphia" caption="agraphia right,">right</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_agraphia" caption="agraphia left,">left</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_agraphia" caption="agraphia both,">both</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_agraphia"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">naming</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_naming" caption="normal naming,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_naming" caption="describe_abnormal_naming,">yes</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cognitive_naming"><span class="fa fa-remove"></span></button>
            </div>
        </div>
    </div>

    <!-- cranial nerves I -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">cranial nerves I :</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_i" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_i" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- indent cranial nerves I -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_i">
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">smelling</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_i_smelling" child-template-action="off" caption="normal smelling,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_i_smelling" child-template-action="on" caption="abnormal smelling," fallback-caption="abnormal smelling,">abnormal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_i_smelling" child-template-action="off" caption="smelling not test,">not test</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_i_smelling" child-template-action="off"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_i_smelling">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">side</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_i_smelling_abnormal" parent="'abnormal smelling,'" caption="abnormal smelling right,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_i_smelling_abnormal" parent="'abnormal smelling,'" caption="abnormal smelling left,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_i_smelling_abnormal" parent="'abnormal smelling,'" caption="abnormal smelling both,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_i_smelling_abnormal" parent="'abnormal smelling,'"><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- cranial nerves II -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">cranial nerves II</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_ii" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_ii" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- indent cranial nerves II -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_ii">
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">confrontation test</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_ii_confrontation" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_ii_confrontation" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_ii_confrontation"><!-- indent -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right side</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ii_confrontation_right" child-template-action="off" caption="normal right visual field,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ii_confrontation_right" child-template-action="on" caption="abnormal right visual," fallback-caption="abnormal right visual,">abnormal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ii_confrontation_right" child-template-action="off"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_ii_confrontation_right">
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption="total blindness right eye,">total blindness</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">

                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption="nasal hemianopia right eye,">nasal hemianopia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption="homonymous hemianopia right eye,">homonymous hemianopia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption="homonymous hemianopia with macular sparing right eye,">homonymous hemianopia with macular sparing</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption="quadrantoanopia upper right eye,">quadrantoanopia upper</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption="quadrantoanopia lower right eye,">quadrantoanopia lower</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_right_abnormal" parent="'abnormal right visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left side</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ii_confrontation_left" child-template-action="off" caption="normal left visual field,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ii_confrontation_left" child-template-action="on" caption="abnormal left visual," fallback-caption="abnormal left visual,">abnormal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ii_confrontation_left" child-template-action="off"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_ii_confrontation_left">
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption="total blindness left eye,">total blindness</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption="nasal hemianopia left eye,">nasal hemianopia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption="homonymous hemianopia left eye,">homonymous hemianopia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption="homonymous hemianopia with macular sparing left eye,">homonymous hemianopia with macular sparing</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption="quadrantoanopia upper left eye,">quadrantoanopia upper</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption="quadrantoanopia lower left eye,">quadrantoanopia lower</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_left_abnormal" parent="'abnormal left visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">both sides</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ii_confrontation_both" child-template-action="off" caption="normal both visual field,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ii_confrontation_both" child-template-action="on" caption="abnormal both visual," fallback-caption="abnormal both visual,">abnormal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ii_confrontation_both" child-template-action="off"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_ii_confrontation_both">
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption="total blindness both eyes,">total blindness</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption="bitemporal heteronymous hemianopia,">bitemporal heteronymous hemianopia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption="nasal hemianopia both eyes,">nasal hemianopia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption="quadrantoanopia upper both eyes,">quadrantoanopia upper</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">&#8226;</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption="quadrantoanopia lower both eyes,">quadrantoanopia lower</button>
                        <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_cranial_ii_confrontation_both_abnormal" parent="'abnormal both visual,'" caption=""><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div>
        </div><!-- indent -->

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">fundi</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_fundi" child-template-action="off" caption="normal fundi,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_fundi" child-template-action="on" caption="abnormal fundi," fallback-caption="abnormal fundi,">abnormal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_fundi" child-template-action="off" caption="fundi not test,">not test</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_fundi" child-template-action="off"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_fundi">
            
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">papilledema</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_papilledema" parent="'abnormal fundi,'" caption="papilledema right eye,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_papilledema" parent="'abnormal fundi,'" caption="papilledema left eye,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_papilledema" parent="'abnormal fundi,'" caption="papilledema both eyes,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_papilledema" parent="'abnormal fundi,'" caption=""><span class="fa fa-remove"></span></button>
                </div>
            </div>
            
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">exudate</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_exudate" parent="'abnormal fundi,'" caption="exudate right eye,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_exudate" parent="'abnormal fundi,'" caption="exudate left eye,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_exudate" parent="'abnormal fundi,'" caption="exudate both eyes,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_exudate" parent="'abnormal fundi,'" caption=""><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">hemorrhage</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_hemorrhage" parent="'abnormal fundi,'" caption="hemorrhage right eye,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_hemorrhage" parent="'abnormal fundi,'" caption="hemorrhage left eye,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_hemorrhage" parent="'abnormal fundi,'" caption="hemorrhage both eyes,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_hemorrhage" parent="'abnormal fundi,'" caption=""><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">A/V nicking</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_AVnicking" parent="'abnormal fundi,'" caption="A/V nicking right eye,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_AVnicking" parent="'abnormal fundi,'" caption="A/V nicking left eye,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_AVnicking" parent="'abnormal fundi,'" caption="A/V nicking both eyes,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template has-parent-template" group="child_specified_physical_exam_nervous_system_fundi_AVnicking" parent="'abnormal fundi,'" caption=""><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- cranial nerves III, IV, VI -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">cranial nerves III, IV, VI</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_iii_iv_vi" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_iii_iv_vi" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- indent cranial nerves III, IV, VI -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_iii_iv_vi">
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">ptosis</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_ptosis" caption="no ptosis,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_ptosis" caption="ptosis right eye,">right</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_ptosis" caption="ptosis left eye,">left</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_ptosis" caption="ptosis both eyes,">both</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_ptosis"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">pupil</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil"><!-- indent -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">round</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_round" caption="round pupil _xx_ CM right,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_round" caption="round pupil _xx_ CM left,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_round" caption="round pupil _xx_ CM both,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_round"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">oval shape</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_oval" caption="oval shape right pupil,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_oval" caption="oval shape left pupil,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_oval" caption="oval shape both pupils,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_oval"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">irregular</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_irregular" caption="irregular right pupil,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_irregular" caption="irregular left pupil,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_irregular" caption="irregular both pupils,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_pupil_irregular"><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div><!-- indent -->

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">direct light reflex</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_direct_light_reflex" caption="direct light reflex normal,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_direct_light_reflex" caption="direct light reflex impair right,">impair right</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_direct_light_reflex" caption="direct light reflex impair left,">impair left</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_direct_light_reflex" caption="direct light reflex impair both,">impair both</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_direct_light_reflex"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">indirect light reflex</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_indirect_light_reflex" caption="indirect light reflex normal,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_indirect_light_reflex" caption="indirect light reflex impair right,">impair right</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_indirect_light_reflex" caption="indirect light reflex impair left,">impair left</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_indirect_light_reflex" caption="indirect light reflex impair both,">impair both</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_indirect_light_reflex"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">extraocular muscle</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle" extra-template-action="off" caption="extraocular muscle normal,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle" extra-template-action="on" caption="extraocular muscle impair,">impair</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle" extra-template-action="off" caption="extraocular muscle not test,">not test</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle" extra-template-action="off"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">medial gaze</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_medial" caption="medial gaze right,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_medial" caption="medial gaze left,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_medial" caption="medial gaze both,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_medial"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">lateral gaze</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_lateral" caption="lateral gaze right,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_lateral" caption="lateral gaze left,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_lateral" caption="lateral gaze both,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_lateral"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">upward gaze</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_upward" caption="upward gaze right,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_upward" caption="upward gaze left,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_upward" caption="upward gaze both,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_upward"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">downward gaze</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_downward" caption="downward gaze right,">right</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_downward" caption="downward gaze left,">left</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_downward" caption="downward gaze both,">both</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_extraocular_muscle_downward"><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">nystagmus</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_right" caption="no nystagmus right eye,">no</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_right" caption="nystagmus right eye not test,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_right" caption="vertical nystagmus right eye,">vertical</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_right" caption="horizontal nystagmus right eye,">horizontal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_right"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_left" caption="no nystagmus left eye,">no</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_left" caption="nystagmus left eye not test,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_left" caption="vertical nystagmus left eye,">vertical</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_left" caption="horizontal nystagmus left eye,">horizontal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_iii_iv_vi_nystagmus_left"><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div><!-- indent -->
    </div>

    <!-- cranial nerves V -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">cranial nerves V</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- indent cranial nerves V -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_v">
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">motor</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v_motor" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v_motor" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_v_motor"><!-- indent -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">masseter</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v_motor_masseter" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v_motor_masseter" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_v_motor_masseter">
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">right</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_right" caption="masseter right normal,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_right" caption="masseter right atrophy,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_right" caption="masseter right weakness,">weakness</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_right" caption="masseter right weakness and atrophy,">weakness and atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_right" caption="masseter right not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_right"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">left</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_left" caption="masseter left normal,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_left" caption="masseter left atrophy,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_left" caption="masseter left weakness,">weakness</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_left" caption="masseter left weakness and atrophy,">weakness and atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_left" caption="masseter left not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_masseter_left"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">temporalis</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v_motor_temporalis" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v_motor_temporalis" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_v_motor_temporalis">
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">right</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_right" caption="temporalis right normal,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_right" caption="temporalis right atrophy,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_right" caption="temporalis right weakness,">weakness</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_right" caption="temporalis right weakness and atrophy,">weakness and atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_right" caption="temporalis right not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_right"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">left</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_left" caption="temporalis left normal,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_left" caption="temporalis left atrophy,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_left" caption="temporalis left weakness,">weakness</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_left" caption="temporalis left weakness and atrophy,">weakness and atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_left" caption="temporalis left not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_temporalis_left"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">pterygoid</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid">
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">right</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_right" caption="pterygoid right normal,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_right" caption="pterygoid right atrophy,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_right" caption="pterygoid right weakness,">weakness</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_right" caption="pterygoid right weakness and atrophy,">weakness and atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_right" caption="pterygoid right not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_right"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">left</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_left" caption="pterygoid left normal,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_left" caption="pterygoid left atrophy,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_left" caption="pterygoid left weakness,">weakness</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_left" caption="pterygoid left weakness and atrophy,">weakness and atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_left" caption="pterygoid left not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_motor_pterygoid_left"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->
        </div><!-- indent -->       

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">sensation</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v_sensation" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v_sensation" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_v_sensation"><!-- indent -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">V1 (ophthalmic)</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v_sensation_v1" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v_sensation_v1" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <div class="col-md-12" id="specified_physical_exam_nervous_system_cranial_v_sensation_v1"><!-- indent -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">right</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v1_right" caption="normal V1 (ophthalmic) right,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v1_right" caption="abnormal V1 (ophthalmic) right,">abnormal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v1_right" caption="V1 (ophthalmic) right not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v1_right"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">left</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v1_left" caption="normal V1 (ophthalmic) left,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v1_left" caption="abnormal V1 (ophthalmic) left,">abnormal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v1_left" caption="V1 (ophthalmic) left not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v1_left"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">V2 (maxillary)</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v_sensation_v2" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v_sensation_v2" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_v_sensation_v2"><!-- indent -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">right</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v2_right" caption="normal V2 (maxillary) right,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v2_right" caption="abnormal V2 (maxillary) right,">abnormal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v2_right" caption="V2 (maxillary) right not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v2_right"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">left</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v2_left" caption="normal V2 (maxillary) left,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v2_left" caption="abnormal V2 (maxillary) left,">abnormal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v2_left" caption="V2 (maxillary) left not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v2_left"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">V3 (mandibular)</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v_sensation_v3" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v_sensation_v3" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_v_sensation_v3"><!-- indent -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">right</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v3_right" caption="normal V3 (mandibular) right,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v3_right" caption="abnormal V3 (mandibular) right,">abnormal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v3_right" caption="V3 (mandibular) right not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v3_right"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">left</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v3_left" caption="normal V3 (mandibular) left,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v3_left" caption="abnormal V3 (mandibular) left,">abnormal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v3_left" caption="V3 (mandibular) left not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_sensation_v3_left"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->
        </div><!-- indent -->

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">corneal reflex</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_v_corneal_reflex" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_v_corneal_reflex" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_v_corneal_reflex">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_corneal_reflex_right" caption="normal corneal reflex right,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_corneal_reflex_right" caption="abnormal corneal reflex right,">abnormal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_corneal_reflex_right" caption="corneal reflex right not test,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_corneal_reflex_right"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_corneal_reflex_left" caption="normal corneal reflex left,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_corneal_reflex_left" caption="abnormal corneal reflex left,">abnormal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_corneal_reflex_left" caption="corneal reflex left not test,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_v_corneal_reflex_left"><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div><!-- indent -->
    </div>

    <!-- cranial nerves VII -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">cranial nerves VII</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_vii" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_vii" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- indent cranial nerves VII -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_vii">
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">muscle power</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_vii_muscle_power" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_vii_muscle_power" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_vii_muscle_power"><!-- indent -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_right" caption="normal muscle power right,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_right" caption="right upper motor neuron lesion,">upper lension</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_right" caption="right lower motor neuron lesion,">lower lension</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_right" caption="right upper and lower motor neuron lesion,">upper and lower lension</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_right" caption="muscle power right not test,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_right"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_left" caption="normal muscle power left,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_left" caption="left upper motor neuron lesion,">upper lension</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_left" caption="left lower motor neuron lesion,">lower lension</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_left" caption="left upper and lower motor neuron lesion,">upper and lower lension</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_left" caption="muscle power left not test,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_vii_muscle_power_left"><span class="fa fa-remove"></span></button>
                </div>
            </div>          
        </div><!-- indent -->
    </div>

    <!-- cranial nerves VIII -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">cranial nerves VIII</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_viii" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_viii" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- indent cranial nerves VIII -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_viii">
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">Rinne's test</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_viii_rinne" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_viii_rinne" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_viii_rinne">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_rinne_test_right" caption="negative Rinne's test right,">negative</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_rinne_test_right" caption="positive Rinne's test right,">positive</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_rinne_test_right" caption="not test Rinne's test right,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_rinne_test_right"><span class="fa fa-remove"></span></button>
                </div>
            </div>      
        
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_rinne_test_left" caption="negative Rinne's test left,">negative</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_rinne_test_left" caption="positive Rinne's test left,">positive</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_rinne_test_left" caption="not test Rinne's test left,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_rinne_test_left"><span class="fa fa-remove"></span></button>
                </div>
            </div>      
        </div><!-- indent -->

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">Weber's test</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_viii_weber" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_viii_weber" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_viii_weber">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_weber_test_right" caption="normal Weber's test right,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_weber_test_right" caption="Weber's test lateralization to the right,">lateralization</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_weber_test_right" caption="not test Weber's test right,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_weber_test_right"><span class="fa fa-remove"></span></button>
                </div>
            </div>      
    
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_weber_test_left" caption="normal Weber's test left,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_weber_test_left" caption="Weber's test lateralization to the left,">lateralization</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_weber_test_left" caption="not test Weber's test left,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_viii_weber_test_left"><span class="fa fa-remove"></span></button>
                </div>
            </div>      
        </div><!-- indent -->
    </div>

    <!-- cranial nerves IX, X -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">cranial nerves IX, X</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_ix_x" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_ix_x" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- indent cranial nerves IX, X -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_ix_x">
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">voice</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_voice" caption="normal voice,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_voice" caption="hoarseness of voice,">hoarseness</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_voice" caption="describe_other_abnormal_voice,">others</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_voice" caption="voice can't be evaluated,">can't evaluated</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_voice"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">swallowing</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_swallowing" caption="normal swallowing,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_swallowing" caption="abnormal swallowing,">abnormal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_swallowing" caption="swallowing not test,">not test</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_swallowing"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">uvula</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_uvula" caption="normal uvula,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_uvula" caption="uvula deviated to the right,">deviated right</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_uvula" caption="uvula deviated to the left,">deviated left</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_uvula"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">gag reflex</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_gag_reflex" caption="normal gag reflex,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_gag_reflex" caption="decrease gag reflex,">decrease</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_gag_reflex" caption="absent gag reflex,">absent</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_gag_reflex" caption="gag reflex not test,">not test</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_ix_x_gag_reflex"><span class="fa fa-remove"></span></button>
            </div>
        </div>
    </div>

    <!-- cranial nerves XI -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">cranial nerves XI</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_xi" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_xi" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- indent cranial nerves XI -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_xi">
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">sternocleidomastoid</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid_right" caption="normal right sternocleidomastoid,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid_right" caption="weakness right sternocleidomastoid,">weakness</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid_right" caption="not test right sternocleidomastoid,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid_right"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid_left" caption="normal left sternocleidomastoid,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid_left" caption="weakness left sternocleidomastoid,">weakness</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid_left" caption="not test left sternocleidomastoid,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_sternocleidomastoid_left"><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div><!-- indent -->

        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">trapezius</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cranial_xi_trapezius" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cranial_xi_trapezius" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cranial_xi_trapezius">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_trapezius_right" caption="normal right trapezius,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_trapezius_right" caption="weakness right trapezius,">weakness</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_trapezius_right" caption="not test right trapezius,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_trapezius_right"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_trapezius_left" caption="normal left trapezius,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_trapezius_left" caption="weakness left trapezius,">weakness</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_trapezius_left" caption="not test left trapezius,">not test</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xi_trapezius_left"><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div><!-- indent -->
    </div>

    <!-- cranial nerves XII : tongue atrophy -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">cranial nerves XII : tongue atrophy</label>
        <span class="fa fa-ellipsis-v"></span>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xii_tongue_atrophy" caption="no tongue atrophy,">no</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xii_tongue_atrophy" caption="tongue atrophy right,">right</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xii_tongue_atrophy" caption="tongue atrophy left,">left</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xii_tongue_atrophy" caption="tongue atrophy both,">both</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xii_tongue_atrophy" caption="tongue atrophy not test,">not test</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cranial_xii_tongue_atrophy"><span class="fa fa-remove"></span></button>
        </div>
    </div>

    <!-- motor label -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">motor</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_motor" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_motor" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- motor content -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_motor">
        
        <!-- general appearance lebel -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">general appearance</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_motor_general_appearance" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_motor_general_appearance" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- general appearance content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_motor_general_appearance">
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right side</label>
                <span class="fa fa-ellipsis-v"></span>
            </div>

            <div class="col-md-12"><!-- indent -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">arm</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_arm" caption="right arm normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_arm" caption="atrophy right arm,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_arm" caption="fasciculation left arm,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_arm" caption="describe_abnormal_right_arm_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_arm"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">hand</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_hand" caption="right hand normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_hand" caption="atrophy right hand,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_hand" caption="fasciculation left hand,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_hand" caption="describe_abnormal_right_hand_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_hand"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">leg</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_leg" caption="right leg normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_leg" caption="atrophy right leg,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_leg" caption="fasciculation left leg,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_leg" caption="describe_abnormal_right_leg_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_leg"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">foot</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_foot" caption="right foot normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_foot" caption="atrophy right foot,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_foot" caption="fasciculation left foot,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_foot" caption="describe_abnormal_right_foot_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_foot"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left side</label>
                <span class="fa fa-ellipsis-v"></span>
            </div>

            <div class="col-md-12"><!-- indent -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">arm</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_arm" caption="left arm normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_arm" caption="atrophy left arm,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_arm" caption="fasciculation left arm,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_arm" caption="describe_abnormal_left_arm_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_arm"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">hand</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_hand" caption="left hand normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_hand" caption="atrophy left hand,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_hand" caption="fasciculation left hand,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_hand" caption="describe_abnormal_left_hand_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_hand"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">leg</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_leg" caption="left leg normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_leg" caption="atrophy left leg,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_leg" caption="fasciculation left leg,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_leg" caption="describe_abnormal_left_leg_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_leg"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">foot</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_foot" caption="left foot normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_foot" caption="atrophy left foot,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_foot" caption="fasciculation left foot,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_foot" caption="describe_abnormal_left_foot_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_left_foot"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->

            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">both sides</label>
                <span class="fa fa-ellipsis-v"></span>
            </div>

            <div class="col-md-12"><!-- indent -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">arms</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_arms" caption="both arms normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_arms" caption="atrophy both arms,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_arms" caption="fasciculation both arms,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_arms" caption="describe_abnormal_both_arms_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_arms"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">hands</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_hands" caption="both hands normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_hands" caption="atrophy both hands,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_hands" caption="fasciculation both hands,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_hands" caption="describe_abnormal_both_hands_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_hands"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">legs</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_legs" caption="both legs normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_legs" caption="atrophy both legs,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_legs" caption="fasciculation both legs,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_legs" caption="describe_abnormal_both_legs_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_legs"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">feet</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_feet" caption="both feet normal motor,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_feet" caption="atrophy both feet,">atrophy</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_feet" caption="fasciculation both feet,">fasciculation</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_feet" caption="describe_abnormal_both_feet_motor,">other</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_both_feet"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->
        </div>
    
        <div class="col-md-12 btn-group-in-well"><!-- tone -->
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">tone</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_motor_tone" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_motor_tone" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_motor_tone">
            <div class="col-md-12 btn-group-in-well"><!-- tone right -->
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">right side</label>
                <span class="fa fa-ellipsis-v"></span>
            </div>

            <div class="col-md-12"><!-- tone right parts -->
                <div class="col-md-12 btn-group-in-well"><!-- shoulder -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">shoulder</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_shoulder" caption="right shoulder tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_shoulder" caption="right shoulder normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_shoulder" caption="hypotonia left shoulder,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_shoulder"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well"><!-- elbow -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">elbow</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_elbow" caption="right elbow tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_elbow" caption="right elbow normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_elbow" caption="hypotonia left elbow,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_elbow"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well"><!-- radio_ulnar -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">radio-ulnar</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_radio_ulnar" caption="right radio-ulnar tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_radio_ulnar" caption="right radio-ulnar normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_radio_ulnar" caption="hypotonia left radio-ulnar,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_radio_ulnar"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well"><!-- wrist -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">wrist</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_wrist" caption="right wrist tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_wrist" caption="right wrist normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_wrist" caption="hypotonia left wrist,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_right_wrist"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->

            <div class="col-md-12 btn-group-in-well"><!-- tone left -->
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">left side</label>
                <span class="fa fa-ellipsis-v"></span>
            </div>

            <div class="col-md-12"><!-- tone left parts -->
                <div class="col-md-12 btn-group-in-well"><!-- shoulder -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">shoulder</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_shoulder" caption="left shoulder tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_shoulder" caption="left shoulder normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_shoulder" caption="hypotonia left shoulder,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_shoulder"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well"><!-- elbow -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">elbow</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_elbow" caption="left elbow tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_elbow" caption="left elbow normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_elbow" caption="hypotonia left elbow,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_elbow"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well"><!-- radio_ulnar -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">radio-ulnar</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_radio_ulnar" caption="left radio-ulnar tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_radio_ulnar" caption="left radio-ulnar normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_radio_ulnar" caption="hypotonia left radio-ulnar,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_radio_ulnar"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well"><!-- wrist -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">wrist</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_wrist" caption="left wrist tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_wrist" caption="left wrist normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_wrist" caption="hypotonia left wrist,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_left_wrist"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->

            <div class="col-md-12 btn-group-in-well"><!-- tone both -->
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">both sides</label>
                <span class="fa fa-ellipsis-v"></span>
            </div>

            <div class="col-md-12"><!-- tone both parts -->
                <div class="col-md-12 btn-group-in-well"><!-- shoulder -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">shoulder</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_shoulder" caption="both shoulders tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_shoulder" caption="both shoulders normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_shoulder" caption="hypotonia both shoulders,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_shoulder"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well"><!-- elbow -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">elbow</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_elbow" caption="both elbows tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_elbow" caption="both elbows normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_elbow" caption="hypotonia both elbows,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_elbow"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well"><!-- radio_ulnar -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">radio-ulnar</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_radio_ulnar" caption="both radio-ulnar tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_radio_ulnar" caption="both radio-ulnar normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_radio_ulnar" caption="hypotonia both radio-ulnar,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_radio_ulnar"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well"><!-- wrist -->
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">wrist</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_wrist" caption="both wrists tone note test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_wrist" caption="both wrists normal tone,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_wrist" caption="hypotonia both wrists,">hypotonia</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_tone_both_wrist"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div><!-- indent -->
        </div>

        <!-- power valiables -->
        <?php
            $upperExtremities = [
                'deltoid ' => 'deltoid ',
                'biceps' => 'biceps',
                'triceps' => 'triceps',
                'brachioradialis' => 'brachioradialis',
                'pronator' => 'pronator',
                'supinator' => 'supinator',
                'wrist flexion' => 'wrist_flexion',
                'wrist extension' => 'wrist_extension',
                'hand grip' => 'hand_grip',
                'fingers extension' => 'fingers_extension',
                'fingers abduction' => 'fingers_abduction',
                'opponens' => 'opponens',
            ];

            $lowerExtremities = [
                'hip flexion' => 'hip_flexion',
                'hip extension' => 'hip_extension',
                'hip abduction' => 'hip_abduction',
                'knee flexion' => 'knee_flexion',
                'knee extension' => 'knee_extension',
                'ankle dorsiflexion' => 'ankle_dorsiflexion',
                'ankle plantar flexion' => 'ankle_plantar_flexion',
                'eversion' => 'eversion',
                'inversion' => 'inversion',
                'toe dorsiflexion' => 'toe_dorsiflexion',
                'plantarflexion' => 'plantarflexion',
            ];
        ?>

        <!-- power label -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">power</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_motor_power" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_motor_power" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>
        
        <!-- power content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_motor_power">
            <!-- upper extremities label -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">upper extremities</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_motor_power_upper_extremities" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_motor_power_upper_extremities" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <!-- upper extremities content -->
            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_motor_power_upper_extremities">
                
                <!-- upper extremities side grade template -->
                @foreach($sides as $side)
                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-4 label-btn-xs">{{ $side }}</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade" caption="{{ $side }} upper extremities grade 0,">0</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade" caption="{{ $side }} upper extremities grade I,">I</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade" caption="{{ $side }} upper extremities grade II,">II</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade" caption="{{ $side }} upper extremities grade III,">III</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade" caption="{{ $side }} upper extremities grade IV,">IV</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade" caption="{{ $side }} upper extremities grade V,">V</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade"><span class="fa fa-remove"></span></button>
                        </div>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade_detail" caption="distal,">distal</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade_detail" caption="proximal,">proximal</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $side }}_grade_detail"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>
                @endforeach

                <!-- Gen content for each upper extremities topic -->
                @foreach($upperExtremities as $topicName => $btnGroupName)
                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-4 label-btn-xs">{{ $topicName }}</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $btnGroupName }}" caption="{{ $topicName }} right,">right</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $btnGroupName }}" caption="{{ $topicName }} left,">left</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $btnGroupName }}" caption="{{ $topicName }} both,">both</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_{{ $btnGroupName }}"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>
                @endforeach

                <!-- upper extremities topic pronator drift -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">pronator drift</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_pronator_drift" caption="no right pronator drift,">no</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_pronator_drift" caption="pronator drift right,">right</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_pronator_drift" caption="pronator drift left,">left</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_pronator_drift" caption="pronator drift both,">both</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_upper_extremities_pronator_drift"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div>

            <!-- lower extremities label -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">lower extremities</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_motor_power_lower_extremities" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_motor_power_lower_extremities" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <!-- lower extremities content -->
            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_motor_power_lower_extremities">

                <!-- extremities side grade template -->
                @foreach($sides as $side)
                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-4 label-btn-xs">{{ $side }}</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $side }} lower extremities grade 0,">0</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $side }} lower extremities grade I,">I</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $side }} lower extremities grade II,">II</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $side }} lower extremities grade III,">III</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $side }} lower extremities grade IV,">IV</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $side }} lower extremities grade V,">V</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade"><span class="fa fa-remove"></span></button>
                        </div>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade_detail" caption="distal,">distal</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade_detail" caption="proximal,">proximal</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade_detail"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>
                @endforeach

                <!-- Gen content for each lower extremities topic -->
                @foreach($lowerExtremities as $topic => $topicGroup)
                    <!-- topic lebel -->
                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-4 label-btn-xs">{{ $topic }}</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <!-- show content -->
                        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" data-placement="top" data-toggle="tooltip" role="hide" target="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $topicGroup }}" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                        <!-- reset buttons -->
                        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" data-placement="top" data-toggle="tooltip" role="hide" target="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $topicGroup }}" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
                    </div>

                    <!-- topic side grade template -->
                    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $topicGroup }}">
                        @foreach($sides as $side)
                            <!-- each side grade template -->
                            <div class="col-md-12 btn-group-in-well" id="">
                                <span class="fa fa-ellipsis-h"></span>
                                <label class="label label-template-level-5 label-btn-xs">{{ $side }}</label>
                                <span class="fa fa-ellipsis-v"></span>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $topic }} {{ $side }} grade 0,">0</button>
                                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $topic }} {{ $side }} grade I,">I</button>
                                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $topic }} {{ $side }} grade II,">II</button>
                                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $topic }} {{ $side }} grade III,">III</button>
                                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $topic }} {{ $side }} grade IV,">IV</button>
                                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade" caption="{{ $topic }} {{ $side }} grade V,">V</button>
                                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_power_lower_extremities_{{ $side }}_grade"><span class="fa fa-remove"></span></button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

    </div><!-- indent -->

    <!-- sensory variables -->
    <?php
        $vibration = [
            'clavicle' => 'clavicle',
            'toes' => 'toes'
        ];

        $positionSensation = [
            'fingers' => 'fingers',
            'toes' => 'toes'
        ];
    ?>
    <!-- sensory label -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">sensory</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_sensory" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_sensory" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- sensory content -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_sensory">
        
        <!-- pinprick -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">pinprick</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_pinprick" caption="right pinprick normal motor,">รอถาม : บรรยาย_รูปสีดำ (ลายแนวตั้ง/แนวขวาง/ทะแยง/ตาหมากรุก)</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_pinprick"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <!-- touch -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">touch</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_touch" caption="right touch normal motor,">รอถาม : รูปสีเขียว (ลายแนวตั้ง/แนวขวาง/ทะแยง/ตาหมากรุก)</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_touch"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <!-- pain-temperature -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">pain-temperature</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_pain_temperature" caption="right pain-temperature normal motor,">รอถาม : รูปสีแดง (ลายแนวตั้ง/แนวขวาง/ทะแยง/ตาหมากรุก)</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_motor_general_appearance_right_pain_temperature"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <!-- vibration lebel -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">vibration : vibration sensation (128Hz)</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_sensory_vibration" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_sensory_vibration" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>
        
        <!-- vibration content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_sensory_vibration">

            <!-- sternum -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">sternum</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_vibration_sternum" caption="normal sternum,">normal</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_vibration_sternum" caption="decrease sternum,">decrease</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_vibration_sternum" caption="not test sternum,">not test</button> 
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_vibration_sternum"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <!-- generate topic template -->
            @foreach($vibration as $topicName => $topicGroup)
                <!-- topic lebel -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-warning label-btn-xs">{{ $topicName }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_sensory_vibration_{{ $topicName }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_sensory_vibration_{{ $topicName }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
                </div>

                <!-- topic content -->
                <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_sensory_vibration_{{ $topicName }}">

                    <!-- side -->
                    @foreach($sides as $side)
                        <div class="col-md-12 btn-group-in-well">
                            <span class="fa fa-ellipsis-h"></span>
                            <label class="label label-template-level-4 label-btn-xs">{{ $side }}</label>
                            <span class="fa fa-ellipsis-v"></span>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_vibration_{{ $side }}_{{ $topicName }}" caption="normal {{ $side }} {{ $topicName }},">normal</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_vibration_{{ $side }}_{{ $topicName }}" caption="decrease {{ $side }} {{ $topicName }},">decrease</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_vibration_{{ $side }}_{{ $topicName }}" caption="not test {{ $side }} {{ $topicName }},">not test</button> 
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_vibration_{{ $side }}_{{ $topicName }}"><span class="fa fa-remove"></span></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>

        <!-- position lebel -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">position : position sensation</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_sensory_position" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_sensory_position" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- position content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_sensory_position">

            <!-- generate topic template -->
            @foreach($positionSensation as $topicName => $topicGroup)
                
                <!-- topic lebel -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-warning label-btn-xs">{{ $topicName }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_sensory_position_{{ $topicName }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_sensory_position_{{ $topicName }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
                </div>

                <!-- topic content -->
                <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_sensory_position_{{ $topicName }}">

                    <!-- generate side -->
                    @foreach($sides as $side)
                        <div class="col-md-12 btn-group-in-well">
                            <span class="fa fa-ellipsis-h"></span>
                            <label class="label label-template-level-4 label-btn-xs">{{ $side }}</label>
                            <span class="fa fa-ellipsis-v"></span>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_position_{{ $side }}_{{ $topicName }}" caption="normal {{ $side }} {{ $topicName }},">normal</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_position_{{ $side }}_{{ $topicName }}" caption="impair {{ $side }} {{ $topicName }},">impair</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_position_{{ $side }}_{{ $topicName }}" caption="not test {{ $side }} {{ $topicName }},">not test</button> 
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_position_{{ $side }}_{{ $topicName }}"><span class="fa fa-remove"></span></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- two-point discrimination lebel -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">two-point discrimination</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_sensory_discrimination" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_sensory_discrimination" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- two-point discrimination content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_sensory_discrimination">

            <!-- generate side -->
            @foreach($sides as $side)
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-warning label-btn-xs">{{ $side }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_discrimination_{{ $side }}" caption="normal {{ $side }} two-point discrimination,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_discrimination_{{ $side }}" caption="decrease {{ $side }} two-point discrimination,">decrease</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_discrimination_{{ $side }}" caption="not test {{ $side }} two-point discrimination,">not test</button> 
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_sensory_discrimination_{{ $side }}"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Deep tendon reflex topic variables -->
    <?php
        $deepTendonUpperExtremities = [
            'biceps' => 'biceps',
            'triceps' => 'triceps',
            'brachioradialis' => 'brachioradialis',
            'fingers' => 'fingers',
        ];

        $deepTendonLowerExtremities = [
            'knee' => 'knee',
            'ankle' => 'ankle',
        ];

        $deepTendonSides = [
            'right',
            'left',
        ]
    ?>
    <!-- Deep tendon reflex label -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">Deep tendon reflex</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- Deep tendon reflex content -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_deep_tendon_reflex">
        
        <!-- upper extremities label  -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">upper extremities</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_upper_extremities" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_upper_extremities" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- upper extremities content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_deep_tendon_reflex_upper_extremities">
            
            @foreach($deepTendonUpperExtremities as $topicName => $topicGroup)
                
                <!-- topic label -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-warning label-btn-xs">{{ $topicName }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
                </div>

                <!-- topic content -->
                <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}">
                    @foreach($sides as $side)
                        <div class="col-md-12 btn-group-in-well">
                            <span class="fa fa-ellipsis-h"></span>
                            <label class="label label-template-level-4 label-btn-xs">{{ $side }}</label>
                            <span class="fa fa-ellipsis-v"></span>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 0,">0</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 1+,">1+</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 2+,">2+</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 3+,">3+</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 4+,">4+</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}"><span class="fa fa-remove"></span></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- lower extremities label  -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">lower extremities</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_lower_extremities" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_lower_extremities" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- lower extremities content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_deep_tendon_reflex_lower_extremities">
            
            @foreach($deepTendonLowerExtremities as $topicName => $topicGroup)
                
                <!-- topic label -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-warning label-btn-xs">{{ $topicName }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
                </div>

                <!-- topic content -->
                <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}">
                    @foreach($sides as $side)
                        <div class="col-md-12 btn-group-in-well">
                            <span class="fa fa-ellipsis-h"></span>
                            <label class="label label-template-level-4 label-btn-xs">{{ $side }}</label>
                            <span class="fa fa-ellipsis-v"></span>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 0,">0</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 1+,">1+</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 2+,">2+</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 3+,">3+</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}" caption="{{ $topicGroup }} {{ $side }} 4+,">4+</button>
                                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_{{ $topicGroup }}_{{ $side }}"><span class="fa fa-remove"></span></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- plantar reflex label  -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">plantar reflex</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_plantar_reflex" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_plantar_reflex" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- plantar reflex content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_deep_tendon_reflex_plantar_reflex">
            
            @foreach($deepTendonSides as $side)
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-warning label-btn-xs">{{ $side }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_plantar_reflex_{{ $side }}" caption="plantar reflex {{ $side }} normal,">normal</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_plantar_reflex_{{ $side }}" caption="plantar reflex {{ $side }} dorsiflex,">dorsiflex</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_plantar_reflex_{{ $side }}" caption="plantar reflex {{ $side }} plantarflex,">plantarflex</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_plantar_reflex_{{ $side }}" caption="plantar reflex {{ $side }} not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_plantar_reflex_{{ $side }}"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ankle clonus label  -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">ankle clonus</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_ankle_clonus" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_deep_tendon_reflex_ankle_clonus" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- ankle clonus content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_deep_tendon_reflex_ankle_clonus">
            
            @foreach($deepTendonSides as $side)
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-warning label-btn-xs">{{ $side }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_ankle_clonus_{{ $side }}" caption="ankle clonus {{ $side }} negative,">negative</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_ankle_clonus_{{ $side }}" caption="ankle clonus {{ $side }} positive,">positive</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_ankle_clonus_{{ $side }}" caption="ankle clonus {{ $side }} not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_deep_tendon_reflex_ankle_clonus_{{ $side }}"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <?php
        $cerebellarAbnormal = [
            'finger-to-finger' => 'finger_to_finger',
            'finger-to-nose' => 'finger_to_nose',
            'finger-to-nose-to-finger' => 'finger_to_nose_to_finger',
            'heel-to-knee' => 'heel_to_knee',
            'dysdiadochokinesia' => 'dysdiadochokinesia',
            'alternate foot tap' => 'alternate_foot_tap',
        ];
    ?>

    <!-- Cerebellar label -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">Cerebellar</label>
        <span class="fa fa-ellipsis-v"></span>

        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar" child-template-action="off" caption="cerebellar normal,">normal</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar" child-template-action="on" caption="cerebellar abnormal," fallback-caption="cerebellar abnormal,">abnormal</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar" child-template-action="off" caption="cerebellar not test," fallback-caption="cerebellar not test,">not test</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar" child-template-action="off"><span class="fa fa-remove"></span></button>
        </div>
    </div>

    <!-- Cerebellar content -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cerebellar">
        <!-- abnormal content -->
        <!-- generate abnormal topic -->
        @foreach($cerebellarAbnormal as $topicName => $topicGroup)
            <!-- topic label -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-info label-btn-xs">{{ $topicName }}</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_cerebellar_abnormal_{{ $topicGroup }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_cerebellar_abnormal_{{ $topicGroup }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <!-- topic content -->
            <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_cerebellar_abnormal_{{ $topicGroup }}">
                @foreach($sides as $side)
                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-warning label-btn-xs">{{ $side }}</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar_abnormal_{{ $topicName }}_{{ $side }}" caption="cerebellar {{ $topicName }} {{ $side }} normal,">normal</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar_abnormal_{{ $topicName }}_{{ $side }}" caption="cerebellar {{ $topicName }} {{ $side }} impair,">impair</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar_abnormal_{{ $topicName }}_{{ $side }}" caption="cerebellar {{ $topicName }} {{ $side }} not test,">not test</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar_abnormal_{{ $topicName }}_{{ $side }}"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">tandem walk</label>
            <span class="fa fa-ellipsis-v"></span>

            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar_abnormal_tandem_walk" caption="tandem walk normal,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar_abnormal_tandem_walk" caption="tandem walk sway to the left,">sway to the left</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar_abnormal_tandem_walk" caption="tandem walk sway to the right,">sway to the right</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_cerebellar_abnormal_tandem_walk"><span class="fa fa-remove"></span></button>
            </div>
        </div>
    </div>

    <!-- Meningeal sign label -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">Meningeal sign</label>
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_meningeal_sign" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
        <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_meningeal_sign" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
    </div>

    <!-- Meningeal sign content -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_meningeal_sign">
        
        <!-- Stiff neck topic and content -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">stiff neck</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_meningeal_sign_stiff_neck" caption="stiff neck negative,">negative</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_meningeal_sign_stiff_neck" caption="stiff neck positive,">positive</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_meningeal_sign_stiff_neck" caption="stiff neck not test,">not test</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_meningeal_sign_stiff_neck" ><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <!-- Kerning's sign topic -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">Kernig 's sign</label>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_nervous_system_meningeal_sign_kernigs_sign" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_nervous_system_meningeal_sign_kernigs_sign" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- Kerning's sign content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_meningeal_sign_kernigs_sign">
            @foreach($sides as $side)
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-warning label-btn-xs">{{ $side }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_meningeal_sign_kernigs_sign_{{ $side }}" caption="kerning sign {{ $side }} negative,">negative</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_meningeal_sign_kernigs_sign_{{ $side }}" caption="kerning sign {{ $side }} positive,">positive</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_meningeal_sign_kernigs_sign_{{ $side }}" caption="kerning sign {{ $side }} not test,">not test</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_meningeal_sign_kernigs_sign_{{ $side }}" ><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Gait label -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">Gait</label>
        <span class="fa fa-ellipsis-v"></span>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_gait" child-template-action="off" caption="gait normal,">normal</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_gait" child-template-action="on" caption="gait abnormal," fallback-caption="gait abnormal,">abnormal</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_gait" child-template-action="off" caption="gait not test," fallback-caption="gait not test,">not test</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_gait" child-template-action="off"><span class="fa fa-remove"></span></button>
        </div>
    </div>

    <?php 
        $gaitAbnormal = [
            'ataxic',
            'parkinsonian',
            'spastic',
            'steppage',
            'wadding',
            'other type here',
        ];
    ?>

    <!-- Gait abnormal content -->
    <div class="col-md-12 collapse" id="specified_physical_exam_nervous_system_gait">
        @foreach($gaitAbnormal as $topicName)
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">{{ $topicName }}</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_gait_{{ $topicName }}" caption="gait {{ $topicName }},">yes</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_gait_{{ $topicName }}" caption="no gait {{ $topicName }},">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_nervous_system_gait_{{ $topicName }}" ><span class="fa fa-remove"></span></button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- nervous control btns -->
    <div class="col-md-12 btn-group-in-well">
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-primary btn-xs btn-template-add" role="put-en" target="specified_physical_exam_nervous_system" data-toggle="tooltip" data-placement="top" title="Combine selections">Put</button>
        <button type="button" class="btn btn-warning btn-xs btn-template-close" target="specified_physical_exam_nervous_system" data-toggle="tooltip" data-placement="top" title="Close template"><span class="fa fa-times-circle"></span></button>
        <button type="button" class="btn btn-danger btn-xs btn-template-reset" target="specified_physical_exam_nervous_system" data-toggle="tooltip" data-placement="top" title="Deselect all"><span class="fa fa-refresh"></span></button>
    </div>
</div>      