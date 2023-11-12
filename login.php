<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>CHICKETO</title>

    <meta name="description" content="Login" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="author" content="Sugeng Miarsoadi">
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" />

    <!--[if lte IE 9]>
            <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
        <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
</head>

<script type="text/javascript">
function validasi() {
    var user = document.getElementById('user_name').value;
    var password = document.getElementById('password').value;

    if (user == '') {
        alert('Nome de usuário obrigatório');
        document.getElementById('user_name').focus();
        return false;
    }
    if (password == '') {
        alert('Senha obrigatório');
        document.getElementById('password').focus();
        return false;
    }
    return true;
}
</script>

<body class="login-layout">
    <div class="main-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="login-container">
                        <!--<div class="center">
                                <img src="../img/logo-big.png" width="340px";>
                            </div>
                            -->
                        <div class="space-6"></div>

                        <div class="position-relative">
                            <div id="login-box" class="login-box visible no-border">
                                <div class="widget-body">
                                    <div class="widget-main-login padding-20">
                                        <div class="text-center">
                                            <img src="img/chicketo.jpeg" width="200px">
                                        </div>
                                        <center>
                                            <h4 class="header lighter bigger"
                                                style="font-weight:700;text-aling:center;">
                                                LOGIN
                                            </h4>
                                        </center>

                                        <div class="space-6"></div>

                                        <form action="login_act.php" method="POST" onsubmit="return validasi();">
                                            <fieldset>
                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-left">
                                                        <input type="text" class="form-control" name="user_name"
                                                            id="user_name" placeholder="Nome suáriorio" />
                                                        <i class="ace-icon fa fa-user"></i>
                                                    </span>
                                                </label>

                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-left">
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" placeholder="Senha" />
                                                        <i class="ace-icon fa fa-lock"></i>
                                                    </span>
                                                </label>

                                                <div class="space"></div>

                                                <div class="clearfix">

                                                    <button type="submit"
                                                        class="width-35 pull-right btn btn-sm btn-primary">
                                                        <span class="bigger-110">Login</span>
                                                    </button>
                                                </div>
                                                <div class="space-4"></div>
                                                <?php if (isset($_GET['info'])) { ?>
                                                <div class="warning">Login Falha, Username Ou password La Los !
                                                </div>
                                                <?php } ?>
                                            </fieldset>
                                            <center>
                                                <img src="img/irobot.png" alt=""
                                                    style="height:40px;width:40px;border: 1px solid black;border-radius:100%;">
                                                <br>
                                                <small>Customize By Developer Esperança Timor Oan </small>
                                            </center>
                                        </form>
                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div><!-- /.login-box -->
                        </div><!-- /.position-relative -->
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div><!-- /.main-content -->

    </div><!-- /.main-container -->
    <!-- basic scripts -->


    <script src="assets/js/jquery.2.1.1.min.js"></script>



    <script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery.min.js'>" + "<" + "/script>");
    </script>


    <script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write(
        "<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>


    <script type="text/javascript">
    jQuery(function($) {
        $(document).on('click', '.toolbar a[data-target]', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible'); //hide others
            $(target).addClass('visible'); //show target
        });
    });



    //you don't need this, just used for changing background
    jQuery(function($) {
        $('#btn-login-dark').on('click', function(e) {
            $('body').attr('class', 'login-layout');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-light').on('click', function(e) {
            $('body').attr('class', 'login-layout light-login');
            $('#id-text2').attr('class', 'grey');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-blur').on('click', function(e) {
            $('body').attr('class', 'login-layout blur-login');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'light-blue');

            e.preventDefault();
        });

    });
    </script>
</body>

</html>