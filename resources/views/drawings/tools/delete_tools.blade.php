<!-- Delete tools -->
<span class="fa fa-ellipsis-v"></span>
<div class="btn btn-warning btn-xs" id="delete_selected"><span class="fa fa-trash"></span></div>
<div class="btn btn-default btn-xs" id="undelete"><span class="fa fa-recycle"></span></div>
<div class="btn btn-danger btn-xs" onclick="clearCanvas();"><span class="fa fa-file-o"></span></div>
<script type="text/javascript">
	$('#delete_selected').click(function() {
		if (canvas.size() > initObjsNo) {
			if(canvas.getActiveGroup()) { // Case Group selected.
				var count = 0;
				lastDeleted = [];
				lastDeletedTopOffset = canvas.getActiveGroup().top + canvas.getActiveGroup().height/2;
				lastDeletedLeftOffset = canvas.getActiveGroup().left + canvas.getActiveGroup().width/2;
				canvas.getActiveGroup().forEachObject(function(obj) {
					lastDeleted[count] = obj;
					canvas.remove(obj);
					count++;
				});
  			canvas.discardActiveGroup().renderAll(); // remove select control.
			}	 else { // Case Object selected.
				lastDeleted = canvas.getActiveObject(); 
				canvas.remove(canvas.getActiveObject());
			}				
		}
	});

	$('#undelete').click(function() {
		if (lastDeleted) {
			if (!Array.isArray(lastDeleted)) { // Check Object or Group.
				canvas.add(lastDeleted);
			} else { // case group.
				for (i = 0; i < lastDeleted.length; i++) {
					/**
					* If just add objects to canvas then no controls visible, not sure why.
					* So, Clone object before add to canvas.
					*/
					if (fabric.util.getKlass(lastDeleted[i].type).async) {
						lastDeleted[i].clone(function(clone) {
							canvas.add(clone.set({left: lastDeleted[i].left + lastDeletedLeftOffset, top: lastDeleted[i].top + lastDeletedTopOffset}));
						});	
					} else {
						canvas.add(lastDeleted[i].clone().set({left: lastDeleted[i].left + lastDeletedLeftOffset, top: lastDeleted[i].top + lastDeletedTopOffset}));
					}
				}
			}
			lastDeleted = false;
		}
	});	
</script><!-- Delete tools -->