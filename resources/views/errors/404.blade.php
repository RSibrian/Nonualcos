<!doctype html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/pricing.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:32:16 GMT -->
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>ERROR 404</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!-- Bootstrap core CSS     -->
    {{ Html::style('css/bootstrap.min.css') }}
    <!--  Material Dashboard CSS    -->
   {{ Html::style('css/material-dashboard.css') }}
    <!--  CSS for Demo Purpose, don't include it in your project     -->
   {{ Html::style('css/demo.css') }}
    <!--     Fonts and icons     -->
   {{ Html::style('css/font-awesome.css') }}
   {{ Html::style('css/google-roboto-300-700.css') }}
</head>

<body>
<nav class="navbar navbar-primary navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url("/") }}">Nonualcos</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ URL::previous() }}">
                        <i class="material-icons">arrow_back</i> Regresar
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<div class="wrapper wrapper-full-page">
    <div class="full-page pricing-page" data-image="{{ asset('img/bg-pricing.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <h2 class="title">Página no encontrada</h2>
                            </div>
                    </div>
                    <div class="row " align="center">
                        <h5  class="btn btn-rose btn-round">ERROR 404</h5>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">

                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="">Asociación Los Nonualcos</a>
                </p>
            </div>
        </footer>
    </div>
</div>
</body>
</body>
<!--   Core JS Files   -->
{{ Html::script('js/jquery-3.1.1.min.js') }}
{{ Html::script('js/jquery-ui.min.js') }}
{{ Html::script('js/bootstrap.min.js') }}
{{ Html::script('js/material.min.js') }}
{{ Html::script('js/perfect-scrollbar.jquery.min.js') }}
<!-- Forms Validations Plugin -->
{{ Html::script('js/jquery.validate.min.js') }}
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
{{ Html::script('js/moment.min.js') }}
<!--  Charts Plugin -->
{{ Html::script('js/chartist.min.js') }}
<!--  Plugin for the Wizard -->
{{ Html::script('js/jquery.bootstrap-wizard.js') }}
<!--  Notifications Plugin    -->
{{ Html::script('js/bootstrap-notify.js') }}
<!--   Sharrre Library    -->
{{ Html::script('js/jquery.sharrre.js') }}
<!-- DateTimePicker Plugin -->
{{ Html::script('js/bootstrap-datetimepicker.js') }}
<!-- Vector Map plugin -->
{{ Html::script('js/jquery-jvectormap.js') }}
<!-- Sliders Plugin -->
{{ Html::script('js/nouislider.min.js') }}
<!--  Google Maps Plugin    -->
<!--<script src="https://maps.googleapis.com/maps/api/js') }}-->
<!-- Select Plugin -->
{{ Html::script('js/jquery.select-bootstrap.js') }}
<!--  DataTables.net Plugin    -->
{{ Html::script('js/jquery.datatables.js') }}
<!-- Sweet Alert 2 plugin -->
{{ Html::script('js/sweetalert2.js') }}
<!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
{{ Html::script('js/jasny-bootstrap.min.js') }}
<!--  Full Calendar Plugin    -->
{{ Html::script('js/fullcalendar.min.js') }}
<!-- TagsInput Plugin -->
{{ Html::script('js/jquery.tagsinput.js') }}
<!-- Material Dashboard javascript methods -->
{{ Html::script('js/material-dashboard.js') }}
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
{{ Html::script('js/demo.js') }}
<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>
</html>
