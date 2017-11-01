<?php
    
    $topics = [
        'swelling',
        'warm',
        'red',
        'tender',
    ];

    $sides = [
        'right',
        'left',
        'both'
    ];

    $quadrants = [
        'upper inner quadrant' => 'upper_inner_quadrant',
        'upper outer quadrant' => 'upper_outer_quadrant',
        'lower inner quadrant' => 'lower_inner_quadrant',
        'lower outer quadrant' => 'lower_outer_quadrant',
    ];
?>

<div class="well clearfix"> 

    <!-- gynecomastia label and content -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">gynecomastia</label>
        <span class="fa fa-ellipsis-v"></span>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_gynecomastia" caption="no gynecomastia,">no</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_gynecomastia" caption="gynecomastia,">yes</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_gynecomastia"><span class="fa fa-remove"></span></button>
        </div>
    </div>

    @foreach($topics as $topic)
    <!-- {{ $topic }} lebel -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">{{ $topic }}</label>
        <span class="fa fa-ellipsis-v"></span>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_{{ $topic }}" child-template-action="off" caption="no {{ $topic }},">no</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_{{ $topic }}" child-template-action="on" caption="{{ $topic }}," fallback-caption="{{ $topic }},">yes</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_{{ $topic }}" child-template-action="off"><span class="fa fa-remove"></span></button>
        </div>
    </div>

    <!-- {{ $topic }} contents -->
    <div class="col-md-12 collapse" id="specified_physical_exam_breasts_{{ $topic }}">
        @foreach($sides as $side)
        <!-- {{ $topic }} sub topic lebel -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">{{ $side }}</label>
            <span class="fa fa-ellipsis-v"></span>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-toggle" role="hide" target="specified_physical_exam_breasts_{{ $topic }}_{{ $side }}" data-toggle="tooltip" data-placement="top" title="show/hide this topic"><span class="fa fa-list-ul"></span></button>
            <button type="button" class="btn btn-default btn-sm btn-template-topic-reset" role="hide" target="specified_physical_exam_breasts_{{ $topic }}_{{ $side }}" data-toggle="tooltip" data-placement="top" title="reset this topic"><span class="fa fa-times-circle-o"></span></button>
        </div>

        <div class="col-md-12 collapse" id="specified_physical_exam_breasts_{{ $topic }}_{{ $side }}">
            
            @foreach($quadrants as $caption => $group)
            <!-- {{ $topic }} sub topic contents -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">{{ $caption }}</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_{{ $topic }}_{{ $side }}_{{ $group }}" caption="{{ $topic }} {{ $side }} {{ $caption }},">yes</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_{{ $topic }}_{{ $side }}_{{ $group }}"><span class="fa fa-remove"></span></button>
                </div>
            </div>
            @endforeach
            
        </div>
        @endforeach

    </div>
    @endforeach

    <!-- nipple discharge label and content -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">nipple discharge</label>
        <span class="fa fa-ellipsis-v"></span>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_nipple_discharge" caption="no nipple discharge,">no</button>
            @foreach($sides as $side)
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_nipple_discharge" caption="nipple discharge {{ $side }},">{{ $side }}</button>
            @endforeach
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_breasts_nipple_discharge"><span class="fa fa-remove"></span></button>
        </div>
    </div>

    <!-- breast control btns -->
    <div class="col-md-12 btn-group-in-well">
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-primary btn-xs btn-template-add" role="put-en" target="specified_physical_exam_breasts" data-toggle="tooltip" data-placement="top" title="Combine selections">Put</button>
        <button type="button" class="btn btn-warning btn-xs btn-template-close" target="specified_physical_exam_breasts" data-toggle="tooltip" data-placement="top" title="Close template"><span class="fa fa-times-circle"></span></button>
        <button type="button" class="btn btn-danger btn-xs btn-template-reset" target="specified_physical_exam_breasts" data-toggle="tooltip" data-placement="top" title="Deselect all"><span class="fa fa-refresh"></span></button>
    </div>

</div>