<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
	<meta name="author" content="@yield('author')">
	<title>@yield('doc_title')</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ url('/assets/styles/bootstrap-3.3.5/css/bootstrap.min.css') }}">
	<!-- font awesome -->
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<!-- jQuery -->
	<script src="{{ url('/assets/script/jquery-1.11.3.min.js') }}"></script>
	<!-- Bootstrap JS -->
	<script src="{{ url('/assets/styles/bootstrap-3.3.5/js/bootstrap.min.js') }}"></script>
	<!-- Fabric -->
	<script src="{{ url('/assets/script/fabric.js') }}"></script>

	<style type="text/css">
		.canvas-container {
			margin:0 auto ;
		} /*set center fabric canvas */
		/*style for form*/
		body {
			/*font-family: "Roboto", Helvetica, Arial, sans-serif;*/
			font-size: 14px;
			line-height: 1.42857143;
			color: #333333;
			padding-top: 70px;
			background: #293f50;
			/*background: #3366CC;*/
		}
		.color-plalet {
			color: transparent;
			font-size: 13px;
			margin: 2px 2px 2px 2px;
		}
		.well {
			padding: 5px;
		}
		.extra-tools-div {
			padding: 2px 1px 2px 1px;
		}
	</style>
	<script type="text/javascript">
		/**
		*	Initial global variables and common functions for this drawing.
		*
		**/
		var canvasWidth = 700;
		var canvasHeight = 600;
		var pickedColor = 'black';
		var textSize = 10;
		var textStyle = 'normal';
		var textWeight = 'normal';
		var textDecoration = 'normal';
		var lastDeleted;
		var lastDeletedLeftOffset;
		var lastDeletedTopOffset;
		var initObjsNo = 0;
		var canvas;
		
		function getCanvasObjByName(name) {
			for (i = 0; i < canvas.size(); i++)
				if (canvas.item(i).name == name)
					return canvas.item(i);
			return false;
		} // find fabric object by name. if not found return false.

		function animateAddingObject(obj) {
			canvas.add(obj).setActiveObject(obj);
			obj.animate('left', canvasWidth/2, { // half width.
				onChange: canvas.renderAll.bind(canvas),
				duration: 1000
				// easing: fabric.util.ease.easeOutBounce
			});
		} // animate adding object to canvas.
		function updateSizeColor(obj) {
			if (canvas.size() > initObjsNo) { // check objects in canvas.
				if (canvas.getActiveGroup()) {
					// console.log('group selected');
					canvas.getActiveGroup().forEachObject(function(obj) {
						updateSizeColorByType(obj);
					});
				} else {
					if (canvas.getActiveObject()) {
						updateSizeColorByType(canvas.getActiveObject());
					}
				}
			}
		}

		function updateSizeColorByType(obj) {
			var objType = obj.get('type');
			if (objType == 'text' || objType == 'textbox') {
				obj.setFill(pickedColor);
				obj.setFontSize(textSize);
			} else if (objType == 'path') {
				obj.setStroke(pickedColor);
			}
			canvas.renderAll();
		}

		function deselectFabric() {
			if (canvas.getActiveObject()){
				canvas.discardActiveObject().renderAll();
			} else if (canvas.getActiveGroup()) {
				canvas.discardActiveGroup().renderAll();
			}
		}

		function setCanvasOverlayImage(filePath, scale) {
			canvas.setOverlayImage(filePath, canvas.renderAll.bind(canvas), {
				scaleX: scale,
				scaleY: scale,
				top: canvas.getCenter().top,
				left: canvas.getCenter().left,
				originX: 'center',
				originY: 'center',
				visible: true
			});
		}

		function setCanvasBackgroundImage(filePath, scale) {
			canvas.setBackgroundImage(filePath, canvas.renderAll.bind(canvas), {
				scaleX: scale,
				scaleY: scale,
				top: canvas.getCenter().top,
				left: canvas.getCenter().left,
				originX: 'center',
				originY: 'center',
				visible: true
			});
		}

		function initCanvas() {
			canvas.isDrawingMode = true;
			canvas.freeDrawingBrush.color = 'black';
			canvas.freeDrawingBrush.width = 1;

			canvas.renderAll();
			$('#extra_tools').css('display', 'none');
			$('#canvas_div').removeClass('col-md-10');
			$('#canvas_div').addClass('col-md-12');
		}  // fall back initiate canvas.

		function clearCanvas() { canvas.clear(); } // fall back clear canvas.
	</script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</button>
				<a class="navbar-brand"><span class="label label-primary" style="font-size: 16px;"><span class="fa fa-paint-brush fa-flip-horizontal"></span> place holder HN + AN</span></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
			    <li><a href="{{ url('/notes') }}" title="Goto My Notes"><span class="label label-success" style="font-size: 16px;"><span class="fa fa-user-md"></span> place holder</span></a></li>
			    <li title="Save draft เพื่อกลับมาแก้ไขได้ภายหลัง"><a onclick="saveForm()" role="button"><span class="fa fa-save fa-lg"></span></a></li>
			    <li class="dropdown active">
			      <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Menu"><span class="fa fa-bars fa-lg"></span></a>
			      <ul class="dropdown-menu">
			        <li class="dropdown-header">Save</li>
			        <li title="Save draft เพื่อกลับมาแก้ไขได้ภายหลัง"><a onclick="saveForm()"><span class="fa fa-save"></span> Draft</a></li>
			        <li title="Save publish ถือว่าเสร็จสมบูรน์แล้วจะไม่สามารถกลับแก้ไขได้อีก"><a onclick="alert('ยังไม่ได้ทำจ้า')"><span class="fa fa-archive"></span> Publish</a></li>
			        <li role="separator" class="divider"></li>
			        <li><a href="{{ url('/notes') }}"><span class="fa fa-list"></span> My Notes</a></li>
			        <li><a title="ออกจากโปรแกรม" href="{{ url('/auth/logout') }}"><span class="fa fa-sign-out"></span> Logout</a></li>
			      </ul>
			    </li>
			  </ul>
			</div><!--/.nav-collapse -->
		</div>
  </nav>
  <form>
  	<input type="hidden" name="note_id" value="{{ $noteID }}">
  </form>
	<div class="container-fluid">
		<div class="row">
			<div class="well clearfix" id="std_tools"><!-- Standard tools. -->
			 	<div class="col-md-10 col-sm-10">
			 		@include('drawings.tools.interact_mode_std_tools')
			 		@include('drawings.tools.color_selector')
			 	</div>
				<div class="col-md-2 col-sm-2 text-right">@include('drawings.tools.delete_tools')</div>
				<div class="col-md-2 col-sm-2 collapse" id="arrow-btns" style="margin-top: 5px;">
					@include('drawings.tools.arrow_buttons')
				</div>
				<div class="col-md-10 col-sm-10" style="margin-top: 5px;">@include('drawings.tools.size_text_tools')</div>
			</div>
			<div class="col-md-10 col-sm-12" id="canvas_div"><!-- Canvas. -->
				<div class="text-center"><canvas id="canvas" style="border: 2px solid; border-radius: 5px;"></canvas></div>
			</div>
			<div class="col-md-2 col-sm-12 well clearfix" id="extra_tools"><!-- Drawing dynamic tools and script. -->
				{{-- @include('drawings.ophthalmology.va') --}}
				{{-- @include('drawings.ophthalmology.ecce_icce') --}}
				{{-- @include('drawings.ophthalmology.phacoemulsification') --}}
				{{-- @include('drawings.ophthalmology.operations') --}}
				{{-- @include('drawings.ophthalmology.exam') --}}
				@yield('canvas')
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	canvas = new fabric.Canvas('canvas', {width: canvasWidth, height: canvasHeight});
	canvas.backgroundColor = 'rgba(251,253,227, 1)';
	initCanvas();	 // Override by this drawing.
</script>
</html>