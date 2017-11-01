<?php
    $topics = [
        'supraclavicular',
        'axillary',
        'epitrochlear',
        'inguinal',
        'popliteal',  
    ];

    $sides = [
        'right',
        'left',
        'both',
    ];

    $consistency = [
        'soft',
        'rubbery',
        'firm',
        'hard',
    ];

    $tender = [
        'not',
        'mild',
        'moderate',
        'marked',
    ];

    $movement = [
        'movable' => 'movable',
        'matted' => 'matted (stuck to each other)',
        'fixed' => 'fixed'
    ];

    $cervicalPart1 = [
        'posterior auricular' => 'posterior_auricular',
        'preauricular' => 'preauricular',
        'anterior cervical' => 'anterior_cervical',
        'posterior cervical' => 'posterior_cervical',
        'sub-mandibular' => 'sub_mandibular',
    ];

    $cervicalPart2 = [
        'sublingual',
        'tonsilar',
        'parotid',
    ];
?>
<div class="well clearfix"> 
    
    <!-- Palpable lymph node -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">palpable lymph node</label>
        <span class="fa fa-ellipsis-v"></span>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes" child-template-action="off" caption="no palpable lymph node,">no</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes" child-template-action="on" caption="palpable lymph node," fallback-caption="palpable lymph node,">yes</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes" child-template-action="off"><span class="fa fa-remove"></span></button>
        </div>
    </div>

    <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes">

        <!-- cervical lebel -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">cervical</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_lymph_nodes_cervical" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_lymph_nodes_cervical" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- cervical content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_cervical">
            <!-- occipital label -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">occipital</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_lymph_nodes_cervical_occipital" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_lymph_nodes_cervical_occipital" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <!-- occipital contents -->
            <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_cervical_occipital">
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">LN</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_ln" caption=" occipital xx LN, xx cm (Auto),">yes</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_ln"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <!-- Consistency -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">consistency</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        @foreach($consistency as $option)
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_consistency" caption=" occipital {{ $option }} consistency,">{{ $option }}</button>
                        @endforeach
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_consistency"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <!-- Tender -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">tender</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        @foreach($tender as $option)
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_tender" caption=" occipital {{ $option }} tender,">{{ $option }}</button>
                        @endforeach
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_tender"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <!-- **** Topic **** -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">**** Topic ****</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        @foreach($movement as $caption => $label)
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_movement" caption=" occipital {{ $caption }},">{{ $label }}</button>
                        @endforeach
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_movement"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <!-- other -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">other</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_other" caption=" occipital other __detail__,">yes</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_occipital_other"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div>

            <!---->
            <!---->
            @foreach($cervicalPart1 as $topic => $group)
            <!-- {{ $topic }} lebel -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">{{ $topic }}</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_lymph_nodes_cervical_{{ $group }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_lymph_nodes_cervical_{{ $group }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <!-- {{ $topic }} contents -->
            <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_cervical_{{ $group }}">
                @foreach($sides as $side)
                <!-- {{ $topic }} {{ $side }} lebel -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">{{ $side }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
                </div>  

                <!-- {{ $topic }} {{ $side }} contents -->
                <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}">
                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">LN</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_ln" caption=" {{ $topic }} {{ $side }} xx LN, xx cm (Auto),">yes</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_ln"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>

                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">consistency</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            @foreach($consistency as $option)
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_consistency" caption=" {{ $topic }} {{ $side }} {{ $option }} consistency,">{{ $option }}</button>
                            @endforeach
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_consistency"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>

                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">tender</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            @foreach($tender as $option)
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_tender" caption=" {{ $topic }} {{ $side }} {{ $option }} tender,">{{ $option }}</button>
                            @endforeach
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_tender"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>

                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">**** Topic ****</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            @foreach($movement as $caption => $label)
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_movement" caption=" {{ $topic }} {{ $side }} {{ $caption }},">{{ $label }}</button>
                            @endforeach
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_movement"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>

                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">other</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_other" caption=" {{ $topic }} {{ $side }} other __detail__,">yes</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $group }}_{{ $side }}_other"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
            <!---->
            <!---->

            <!-- submental label -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">sub-mental</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_lymph_nodes_cervical_submental" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_lymph_nodes_cervical_submental" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <!-- submental contents -->
            <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_cervical_submental">
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">LN</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_ln" caption=" submental xx LN, xx cm (Auto),">yes</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_ln"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <!-- Consistency -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">consistency</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        @foreach($consistency as $option)
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_consistency" caption=" submental {{ $option }} consistency,">{{ $option }}</button>
                        @endforeach
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_consistency"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <!-- Tender -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">tender</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        @foreach($tender as $option)
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_tender" caption=" submental {{ $option }} tender,">{{ $option }}</button>
                        @endforeach
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_tender"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <!-- **** Topic **** -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">**** Topic ****</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        @foreach($movement as $caption => $label)
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_movement" caption=" submental {{ $caption }},">{{ $label }}</button>
                        @endforeach
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_movement"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <!-- other -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">other</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_other" caption=" submental other __detail__,">yes</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_submental_other"><span class="fa fa-remove"></span></button>
                    </div>
                </div>
            </div>

            <!---->
            <!---->
            @foreach($cervicalPart2 as $topic)
            <!-- {{ $topic }} lebel -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">{{ $topic }}</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>

            <!-- {{ $topic }} contents -->
            <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}">
                @foreach($sides as $side)
                <!-- {{ $topic }} {{ $side }} lebel -->
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">{{ $side }}</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                    <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
                </div>  

                <!-- {{ $topic }} {{ $side }} contents -->
                <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}">
                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">LN</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_ln" caption=" {{ $topic }} {{ $side }} xx LN, xx cm (Auto),">yes</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_ln"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>

                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">consistency</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            @foreach($consistency as $option)
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_consistency" caption=" {{ $topic }} {{ $side }} {{ $option }} consistency,">{{ $option }}</button>
                            @endforeach
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_consistency"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>

                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">tender</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            @foreach($tender as $option)
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_tender" caption=" {{ $topic }} {{ $side }} {{ $option }} tender,">{{ $option }}</button>
                            @endforeach
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_tender"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>

                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">**** Topic ****</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            @foreach($movement as $caption => $label)
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_movement" caption=" {{ $topic }} {{ $side }} {{ $caption }},">{{ $label }}</button>
                            @endforeach
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_movement"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>

                    <div class="col-md-12 btn-group-in-well">
                        <span class="fa fa-ellipsis-h"></span>
                        <label class="label label-template-level-5 label-btn-xs">other</label>
                        <span class="fa fa-ellipsis-v"></span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_other" caption=" {{ $topic }} {{ $side }} other __detail__,">yes</button>
                            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_cervical_{{ $topic }}_{{ $side }}_other"><span class="fa fa-remove"></span></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
            <!---->
            <!---->

        </div>

        @foreach($topics as $topic)
        <!-- {{ $topic }} lebel -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">{{ $topic }}</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_lymph_nodes_{{ $topic }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_lymph_nodes_{{ $topic }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <!-- {{ $topic }} contents -->
        <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_{{ $topic }}">
            @foreach($sides as $side)
            <!-- {{ $topic }} {{ $side }} lebel -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">{{ $side }}</label>
                <span class="fa fa-ellipsis-v"></span>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
                <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
            </div>
            

            <!-- {{ $topic }} {{ $side }} contents -->
            <div class="col-md-12 collapse" id="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}">
                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">LN</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_ln" caption=" {{ $topic }} {{ $side }} xx LN, xx cm (Auto),">yes</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_ln"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">consistency</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        @foreach($consistency as $option)
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_consistency" caption=" {{ $topic }} {{ $side }} {{ $option }} consistency,">{{ $option }}</button>
                        @endforeach
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_consistency"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">tender</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        @foreach($tender as $option)
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_tender" caption=" {{ $topic }} {{ $side }} {{ $option }} tender,">{{ $option }}</button>
                        @endforeach
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_tender"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">**** Topic ****</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        @foreach($movement as $caption => $label)
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_movement" caption=" {{ $topic }} {{ $side }} {{ $caption }},">{{ $label }}</button>
                        @endforeach
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_movement"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

                <div class="col-md-12 btn-group-in-well">
                    <span class="fa fa-ellipsis-h"></span>
                    <label class="label label-template-level-4 label-btn-xs">other</label>
                    <span class="fa fa-ellipsis-v"></span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_other" caption=" {{ $topic }} {{ $side }} other __detail__,">yes</button>
                        <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_lymph_nodes_{{ $topic }}_{{ $side }}_other"><span class="fa fa-remove"></span></button>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        
        @endforeach

    </div>

    <!-- lymph nodes control btns -->
    <div class="col-md-12 btn-group-in-well">
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-primary btn-xs btn-template-add" role="put-en" target="specified_physical_exam_lymph_nodes" data-toggle="tooltip" data-placement="top" title="Combine selections">Put</button>
        <button type="button" class="btn btn-warning btn-xs btn-template-close" target="specified_physical_exam_lymph_nodes" data-toggle="tooltip" data-placement="top" title="Close template"><span class="fa fa-times-circle"></span></button>
        <button type="button" class="btn btn-danger btn-xs btn-template-reset" target="specified_physical_exam_lymph_nodes" data-toggle="tooltip" data-placement="top" title="Deselect all"><span class="fa fa-refresh"></span></button>
    </div>
</div>