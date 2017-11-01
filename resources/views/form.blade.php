<!DOCTYPE html>
<html lang="th-TH">
<head>
@include('head_form')

<style>
body {
	padding-top: 110px; /*padding tow rows menu*/
	background-image: @yield('background_image')
	background-repeat: repeat;
	background-attachment: fixed;
}

.label-btn-xs {
	font-size: 14px;
}
</style>
@yield('style')

<script type="text/javascript">
function saveForm(){
	@yield('save_ops')
	$('#save_form').trigger('click');
}
</script>
@yield('script')

</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
      </button>
      <a class="navbar-brand"><span class="label label-primary" style="font-size: 16px;"><span class="fa fa-wpforms"></span> {{ $note->note->type->name }}</span></a>
      <a class="navbar-brand"><span class="label label-default" style="font-size: 16px;"><span class="fa fa-wheelchair"></span> HN {{ $note->note->patient->HN . ' : ' . $note->note->patient->getName() }}</span></a>
      <a class="navbar-brand"><span class="label label-default" style="font-size: 16px;"><span class="fa fa-bed"></span> AN {{ $note->note->AN }} : {{ $note->note->getDate() }}</span></a>
    	<div class="extra-tools-div"  id="top-tool-bar" style="display: none;">
    	@yield('top-tool-bar')
    	</div>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown active">
          <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Quick Look Up"><span class="fa fa-binoculars fa-lg"></span></a>
          <ul class="dropdown-menu">
            @yield('nav_menu')
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url('/notes') }}" title="Goto My Notes"><span class="label label-success" style="font-size: 16px;"><span class="fa fa-user-md"></span> {{ Auth::user()->name }}</span></a></li>
        <li title="Save draft เพื่อกลับมาแก้ไขได้ภายหลัง"><a role="button" onclick="saveForm()"><span class="fa fa-save fa-lg"></span></a></li>
        <li class="dropdown active">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Menu"><span class="fa fa-bars fa-lg"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Save</li>
            <li title="Save draft เพื่อกลับมาแก้ไขได้ภายหลัง"><a role="button" onclick="saveForm()"><span class="fa fa-save"></span> Draft</a></li>
            <li title="Save publish ถือว่าเสร็จสมบูรน์แล้วจะไม่สามารถกลับแก้ไขได้อีก"><a role="button" onclick="alert('ยังไม่ได้ทำจ้า')"><span class="fa fa-archive"></span> Publish</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/notes') }}"><span class="fa fa-list"></span> My Notes</a></li>
            <li><a title="ออกจากโปรแกรม" href="{{ url('/auth/logout') }}"><span class="fa fa-sign-out"></span> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<div class="container-fluid">
	<form method="POST" action="{{ $note->note->getPostUrl() }}">
	<input type="hidden" name="_method" value="PATCH">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />	
	<input type="hidden" name="note_type_id" value="{{ $note->note->note_type_id }}">	
	@yield('content')
	<input id="save_form" style="display:none;" type="submit" value="Save">
	</form>
</div>
    
<footer>
	@yield('footer')
</footer>
</body>
<script type="text/javascript">
	$('.text_area_feedback').keyup(function() {
		var maxLength = $(this).prop('maxlength');
		var textLength = $(this).val().length;
		var textRemaining = maxLength - textLength;
		var set50 = false; // flag.
		var set75 = false; // flag.
		var setDefault = false;
		if (textLength/maxLength > 0.75) { // exceed 75%.
			if (!set75) { // check flag if process already fired.
				$(this).css('background', '#ffcccc');
				et75 = true; // change flag.
		}
			$('#' + $(this).attr('id') + '_feedback').html(textRemaining + ' characters remaining'); // update char remaining.
		}
		else if (textLength/maxLength > 0.5) {
			if (!set50) {
				$(this).css('background', '#ffff99');
				set50 = true;
			}
			$('#' + $(this).attr('id') + '_feedback').html(textRemaining + ' characters remaining');
		}
		else { // less than 50%. 
			if (!setDefault) { 
				$(this).css('background', '');
				$('#' + $(this).attr('id') + '_feedback').html('');
				setDefault = true;
			}
		}
	}); // update feedback for text and textarea.

	$('.text_area_feedback').change(function(){
		$('#' + $(this).attr('id') + '_feedback').html('');
		$(this).css('background', '');
	}); // clear css and feeback of text and textarea after change.

	$('.datetimepicker-date').datetimepicker({
		locale: 'th',
		format: 'DD-MM-YYYY',
		showTodayButton: true,
		showClear: true
	}); // enable .datetimepicker-date datetimepicker funtionality.

	$(".autocomplete-to-hidden").autocomplete({
		source: function(request, response) {
			$.ajax({
				url: $(document.activeElement).attr('endpoint') + request.term,
				dataType: "JSON",
				success: function( data ) {
					response(data);
				}
			});
		},
		focus: function(event, ui) {
			event.preventDefault();
			$(this).val(ui.item.name);
		},
		select: function(event, ui) {
			event.preventDefault();
			$('input[name=' + $(this).attr('target') + ']').val(ui.item.value);
			$('a[for=' + $(this).prop('name') + ']').attr('data-original-title',ui.item.label);
		},
		minLength: 2,
	}); // enable .autocomplete-to-hidden auto-complete functionality.

	$(".autocomplete-to-textarea").autocomplete({
		source: function(request, response) {
			$.ajax({
				url: $(document.activeElement).attr('endpoint') + request.term, // Siriraj drugs URL.
				dataType: "JSON",
				success: function( data ) {
					response(data);
				}
			});
		},
		focus: function(event, ui) {
			event.preventDefault();
			$(this).val(ui.item.label); // set division_name = division_name.
		},
		select: function(event, ui) {
			event.preventDefault(); // prevent defualt select event.
			$(this).val(ui.item.label); // set home_medications_suggest to label selected.
			$("textarea[name=" + $(this).attr('target') + "]").val() != '' ? $("textarea[name=" + $(this).attr('target') + "]").val($("textarea[name=" + $(this).attr('target') + "]").val() + '\n' + $(this).val()) : $("textarea[name=" + $(this).attr('target') + "]").val($(this).val()); // set home_medications + selected label.
			$(this).val(''); // clear home_medications_suggest input after added.
			autosize.update($("textarea[name=" + $(this).attr('target') + "]")); // update home_medications rows.
		},
		minLength: 2,
	}); // enable .autocomplete-to-textarea auto-complete functionality.

	$('.btn-autocomplete-to-textarea').click(function() {
		$("textarea[name=" + $(this).attr('target') + "]").val() != '' ? 
			$("textarea[name=" + $(this).attr('target') + "]").val($("textarea[name=" + $(this).attr('target') + "]").val() + '\n' + $('.autocomplete-to-textarea[target=' + $(this).attr('target') + ']').val()) : 
			$("textarea[name=" + $(this).attr('target') + "]").val($('.autocomplete-to-textarea[target=' + $(this).attr('target') + ']').val());

		autosize.update($("textarea[name=" + $(this).attr('target') + "]"));
		$('.autocomplete-to-textarea[target=' + $(this).attr('target') + ']').val('');
		$('.autocomplete-to-textarea[target=' + $(this).attr('target') + ']').focus();
	}); // .autocomplete-to-textarea Add btn.

	$('.handle-datetime').focusout(function() {
		$(this).val(handleYear($(this).val()));
	}); // Add handel Buddish year to all datetime inputs with handle-datetime class.

	$('input[type=radio]').click(function() {
		$('a[target=' + $(this).prop('name') +  ']').removeAttr('style');
	}); // Show remove icon when radio data checked by remove css display:none.

	$(".radio-reset").click(function (){
		$("input[name=" + $(this).prop('target') + "]").prop('checked', false);
		$(this).css('display', 'none'); // Hide remove icon itself.
	}); // reset radio input.

	$('select').change(function() {
		$('a[target=' + $(this).prop('name') +  ']').removeAttr('style');
	}); // Show remove icon when select is changed by remove css display:none.

	$('.select-reset').click(function (){
		$('#' + $(this).attr('target') + '_select select').val('');
		$(this).css('display', 'none'); // Hide remove icon itself.
	}); // reset select.
</script>
@yield('form_script')
</html>