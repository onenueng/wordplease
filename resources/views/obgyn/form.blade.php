<!DOCTYPE html>
<html lang="th-TH">
<head>
@include('head_form')
@yield('script')
<style>
body {
    background-image: url("/assets/images/blu_stripes.png");
    background-repeat: repeat;
}
</style>

</head>
<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="">HN {{ $anote->HN }} : {{ session('patient_name') }}</a>
                <a class="navbar-brand" href="">AN {{ $anote->AN }} : {{ $anote->date_admit }}</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li title="Save draft เพื่อกลับมาแก้ไขได้ภายหลัง"><a onclick="saveForm()">Save</a></li>
                    <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nav<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a onclick="$('#HN').focus();">Preliminary data</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">History</li>
                            <li><a onclick="$('#chief_complant').focus();">Chief Complant</a></li>
                            <li><a href="#comorbid_id">Co-morbid</a></li>
                            <li><a onclick="$('#history_present_illness').focus();">History of illness</a></li>
                            <li><a href="#history_past_illness">Personal and Social history</a></li>
                            <li><a href="#personal_social_history">Special requirement</a></li>
                            <li><a onclick="$('#personal_family_history').focus();">Family history</a></li>
                            <li><a onclick="$('#current_medications_suggest').focus();">Current medications</a></li>
                            <li><a onclick="$('#allergy').focus();">Allergy</a></li>
                            <li><a href="#allergy">Review of system</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Physical examination and investigation</li>
                            <li><a onclick="$('#temperature').focus();">Vital signs</a></li>
                            <li><a href="#orientation">Physical examination</a></li> 
                            <li><a onclick="$('#pertinent_investigation').focus();">Pertinent investigation</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Problem list, Discussion and Plan</li>
                            <li><a onclick="$('#problem_list').focus();">Problem list</a></li>
                            <li><a onclick="$('#discussion').focus();">Discussion</a></li>
                            <li><a onclick="$('#provisional_dx').focus();">Provisional diagnosis</a></li>
                            <li><a onclick="$('#plan_management').focus();">Plan of management</a></li>
                            <li><a onclick="$('#special_group_CPG_select').focus();">Special group (accoring to CPG)</a></li>
                            <li><a onclick="$('#plan_consult').focus();">Plan of consultation</a></li>
                            <li><a onclick="$('#estimated_los').focus();">Estimated dulation of hospitalization</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
<!-- 
<li><a href="../navbar/">Default</a></li>
<li><a href="../navbar-static-top/">Static top</a></li>
-->
                    
                    <li class="active"><a>{{ session('user_name') }}<span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Save</li>
                            <li title="Save draft เพื่อกลับมาแก้ไขได้ภายหลัง"><a onclick="saveForm()">Draft</a></li>
                            <li title="Save publish ถือว่าเสร็จสมบูรน์แล้วจะไม่สามารถกลับแก้ไขได้อีก"><a onclick="alert('ยังไม่ได้ทำจ้า')">Publish</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a title="กลับสู่หน้าจอหลัก" href="/dashboard">Back</a></li>
                            <li><a title="ออกจากโปรแกรม" href="/auth/logout">Logout</a></li>
                        </ul>
                    </li><!-- 
                    <li><a href="/dashboard">Back</a></li>
                    <li><a href="/auth/logout">Logout</a></li> -->
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container-fluid">
      @yield('content')
    </div>
    <script type="text/javascript">
      function saveForm(){
        @yield('save_ops')
        $('#save_form').trigger('click');
      }
    </script>
    <footer>
      @yield('footer')
    </footer>
</body>
</html>