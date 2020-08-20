<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ url('theme') . '/bower_components/' }}bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ url('theme') . '/bower_components/' }}font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ url('theme') . '/bower_components/' }}Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ url('theme') . '/dist/' }}/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ url('theme') . '/dist/' }}/css/skins/_all-skins.min.css">

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ url('theme') . '/plugins/' }}/iCheck/all.css">
<!-- Date Picker -->
<link rel="stylesheet" href="{{ url('theme') . '/bower_components/' }}bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ url('theme') . '/bower_components/' }}bootstrap-daterangepicker/daterangepicker.css">

<link rel="stylesheet" href="{{ url('theme') . '/bower_components/' }}/select2/dist/css/select2.css">

<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ url('theme') . '/plugins/' }}/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<link href="{{ asset('bts4/css/datatables.css') }}" rel="stylesheet">
<script src="{{ asset('js/datatables.js') }}"></script>


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<!-- For page specific styles -->
@yield('styles')
