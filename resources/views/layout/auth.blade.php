<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRM | Inicio de Sesión</title>
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
    if ($(window).width() > 799) {
        var timer = 4000;

        var i = 0;
        var max = $('#c > li').length;

        $("#c > li").eq(i).addClass('sponsors-active').css('left','0');
        $("#c > li").eq(i + 1).addClass('sponsors-active').css('left','20%');
        $("#c > li").eq(i + 2).addClass('sponsors-active').css('left','40%');
        $("#c > li").eq(i + 3).addClass('sponsors-active').css('left','60%');
        $("#c > li").eq(i + 4).addClass('sponsors-active').css('left','80%');



        setInterval(function(){

            $("#c > li").removeClass('sponsors-active');

            $("#c > li").eq(i).css('transition-delay','0.25s');
            $("#c > li").eq(i + 1).css('transition-delay','0.5s');
            $("#c > li").eq(i + 2).css('transition-delay','0.75s');
            $("#c > li").eq(i + 3).css('transition-delay','1s');
            $("#c > li").eq(i + 4).css('transition-delay','1.25s');

            if (i < max-5) {
                i = i+5;
            }

            else {
                i = 0;
            }

            $("#c > li").eq(i).css('left','0').addClass('sponsors-active').css('transition-delay','1.25s');
            $("#c > li").eq(i + 1).css('left','20%').addClass('sponsors-active').css('transition-delay','1.5s');
            $("#c > li").eq(i + 2).css('left','40%').addClass('sponsors-active').css('transition-delay','1.75s');
            $("#c > li").eq(i + 3).css('left','60%').addClass('sponsors-active').css('transition-delay','2s');
            $("#c > li").eq(i + 4).css('left','80%').addClass('sponsors-active').css('transition-delay','2.25s');

        }, timer);
    }

    else {
        var timer = 4000;

        var i = 0;
        var max = $('#c > li').length;

        $("#c > li").eq(i).addClass('sponsors-active').css('left','0');
        $("#c > li").eq(i + 1).addClass('sponsors-active').css('left','33%');
        $("#c > li").eq(i + 2).addClass('sponsors-active').css('left','66%');



        setInterval(function(){

            $("#c > li").removeClass('sponsors-active');

            $("#c > li").eq(i).css('transition-delay','0.25s');
            $("#c > li").eq(i + 1).css('transition-delay','0.5s');
            $("#c > li").eq(i + 2).css('transition-delay','0.75s');

            if (i < max-3) {
                i = i+3;
            }

            else {
                i = 0;
            }

            $("#c > li").eq(i).css('left','0').addClass('sponsors-active').css('transition-delay','1.25s');
            $("#c > li").eq(i + 1).css('left','33%').addClass('sponsors-active').css('transition-delay','1.5s');
            $("#c > li").eq(i + 2).css('left','66%').addClass('sponsors-active').css('transition-delay','1.75s');

        }, timer);
    }

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
