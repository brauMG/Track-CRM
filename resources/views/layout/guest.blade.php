<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Track | Ingreso de Datos</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ url('theme') . '/bower_components/' }}bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('theme') . '/bower_components/' }}bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('theme') . '/bower_components/' }}bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('theme') . '/dist/' }}/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('theme') . '/plugins/' }}/iCheck/square/blue.css">


    <!-- Styles Login-->
    <script src="bts4/js/login.js"></script>
    <link href="{{ asset('bts4/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('bts4/css/sponsors.css') }}" rel="stylesheet">
    <link href="{{ asset('bts4/css/login.less') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5f5a1b784704467e89edcc37/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
<body class="hold-transition login-page" style="background: #25bfb6 !important;">
@yield('content')
</body>

<!-- jQuery 3 -->
<script src="{{ url('theme') . '/bower_components/' }}/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('theme') . '/bower_components/' }}/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{ url('theme') . '/plugins/' }}/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
