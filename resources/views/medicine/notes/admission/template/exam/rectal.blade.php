<div class="well clearfix"> 
    <!-- Rectal label -->
    <div class="col-md-12 btn-group-in-well">
        <label class="label label-success label-btn-xs">Examination</label>
        <span class="fa fa-ellipsis-v"></span>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal" child-template-action="off" caption="rectal examination not done,">not done</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal" child-template-action="on" caption="rectal normal," fallback-caption="rectal normal,">normal</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal" child-template-action="on" caption="rectal abnormal," fallback-caption="rectal abnormal,">abnormal</button>
            <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal" child-template-action="off"><span class="fa fa-remove"></span></button>
        </div>
    </div>

    <!-- Rectal content -->
    <div class="col-md-12 collapse" id="specified_physical_exam_rectal">
        
        <!-- sphincter tone label and content -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">sphincter tone</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_sphincter_tone" caption=" normal sphincter tone,">normal tone</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_sphincter_tone" caption=" decrease sphincter tone,">decrease tone</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_sphincter_tone"><span class="fa fa-remove"></span></button>
            </div>
        </div>
    
        <!-- prostate gland label -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">prostate gland</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_prostate_gland" child-template-action="off" caption="prostate gland normal," fallback-caption="prostate gland normal,">normal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_prostate_gland" child-template-action="on" caption="prostate gland abnormal," fallback-caption="prostate gland abnormal,">abnormal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_prostate_gland" child-template-action="off"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <!-- prostate gland content -->
        <div class="col-md-12 collapse" id="specified_physical_exam_rectal_prostate_gland">
            <!-- tender option -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">tender</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_prostate_gland_tender" caption=" not tender,">no</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_prostate_gland_tender" caption=" tender,">yes</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_prostate_gland_tender"><span class="fa fa-remove"></span></button>
                </div>
            </div>

            <!-- consistency option -->
            <div class="col-md-12 btn-group-in-well">
                <span class="fa fa-ellipsis-h"></span>
                <label class="label label-warning label-btn-xs">consistency</label>
                <span class="fa fa-ellipsis-v"></span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_prostate_gland_consistency" caption=" rubbery consistency,">rubbery</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_prostate_gland_consistency" caption=" hard consistency,">hard</button>
                    <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_prostate_gland_consistency"><span class="fa fa-remove"></span></button>
                </div>
            </div>
        </div>

        <!-- mass label and content -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">mass</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_mass" caption=" no mass,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_mass" caption=" mass __detail__ ,">yes</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_mass"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <!-- stool label and content -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">stool</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_stool" caption=" brown stool,">brown</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_stool" caption=" yellow stool,">yellow</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_stool" caption=" no stool,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_stool" caption=" bloody stool,">bloody</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_stool" caption=" melena,">melena</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_stool" caption=" maroon stool,">maroon</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_stool" caption=" stool other __detail__ ,">other</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_stool"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <!-- hemorrhoid label and content -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">hemorrhoid</label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_hemorrhoid" caption=" no hemorrhoid,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_hemorrhoid" caption=" internal hemorrhoid,">internal</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_hemorrhoid" caption=" internal and external hemorrhoid,">internal and external</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_hemorrhoid"><span class="fa fa-remove"></span></button>
            </div>
        </div>

        <!-- annal fissure  label and content -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">annal fissure </label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_annal_fissure" caption=" no annal fissure,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_annal_fissure" caption=" annal fissure,">yes</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_annal_fissure"><span class="fa fa-remove"></span></button>
            </div>
        </div>
        
        <!-- perianal fistula label and content -->
        <div class="col-md-12 btn-group-in-well">
            <span class="fa fa-ellipsis-h"></span>
            <label class="label label-info label-btn-xs">perianal fistula </label>
            <span class="fa fa-ellipsis-v"></span>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_perianal_fistula" caption=" no perianal fistula,">no</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_perianal_fistula" caption=" perianal fistula,">yes</button>
                <button type="button" class="btn btn-default btn-sm btn-template" group="specified_physical_exam_rectal_perianal_fistula"><span class="fa fa-remove"></span></button>
            </div>
        </div>

    </div>

    <!-- rectal control btns -->
    <div class="col-md-12 btn-group-in-well">
        <span class="fa fa-ellipsis-v"></span>
        <button type="button" class="btn btn-primary btn-xs btn-template-add" role="put-en" target="specified_physical_exam_rectal" data-toggle="tooltip" data-placement="top" title="Combine selections">Put</button>
        <button type="button" class="btn btn-warning btn-xs btn-template-close" target="specified_physical_exam_rectal" data-toggle="tooltip" data-placement="top" title="Close template"><span class="fa fa-times-circle"></span></button>
        <button type="button" class="btn btn-danger btn-xs btn-template-reset" target="specified_physical_exam_rectal" data-toggle="tooltip" data-placement="top" title="Deselect all"><span class="fa fa-refresh"></span></button>
    </div>
</div>