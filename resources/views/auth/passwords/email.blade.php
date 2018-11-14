<!doctype html>
<html lang="en">
<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:32:19 GMT -->
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Inicio</title>

    <!-- Bootstrap core CSS     -->
    {{ Html::style('css/bootstrap.min.css') }}
    <!--  Material Dashboard CSS    -->
    {{ Html::style('css/material-dashboard.css') }}
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    {{ Html::style('css/demo.css') }}
    <!--     Fonts and icons     -->
    {{ Html::style('css/font-awesome.css') }}
    {{ Html::style('css/google-roboto-300-700.css') }}
    <style>
        .card [data-background-color="azul"] {
            background: linear-gradient(60deg, #2a88bd, #195BAA);
            box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 50, 54, 0.4);
        }
        .form-group.is-focused .form-control {
            outline: none;
            background-image: linear-gradient(#2a88bd, #2a88bd), linear-gradient(#D2D2D2, #D2D2D2);
            background-size: 100% 2px, 100% 1px;
            box-shadow: none;
            transition-duration: 0.3s;
        }
        .form-group.is-focused .form-control .material-input:after {
            background-color: #2a88bd;
        }
    </style>
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
                <a class="navbar-brand" href="../dashboard.html">Sistema Nonualcos</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">

                   <li class=" active ">
                        <a href="{{ url('/login')}}">
                            <i class="material-icons">fingerprint</i> Login
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('password.request') }}">
                            <i class="material-icons">lock_open</i> Recuperar contraseña
                        </a>
                    </li>
                    <li class="  ">
                        <a href="{{ route('register') }}">
                            <i class="material-icons">person_add</i> Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="{{asset('img/login.jpg')}}">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                          <div class="panel-body">
                              @if (session('status'))
                                  <div class="alert alert-success">
                                      {{ session('status') }}
                                  </div>
                              @endif
                              <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                  {{ csrf_field() }}
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="green">
                                        <h4 class="card-title">Recuperar Contraseña</h4>
                                        <div class="social-line row">

                                        </div>
                                    </div>
                                    <p class="category text-center">
                                        Sistema Nonualcos
                                    </p>
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">contact_mail</i>
                                            </span>
                                            <div class="form-group  form-group{{ $errors->has('email') ? ' has-error' : '' }} label-floating">
                                              <label for="email" class="col-md-4 control-label">E-Mail</label>
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-info btn-simple btn-wd btn-lg">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">

                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                       <a href="" target="_blank">Asociación de Municipios Los Nonualcos</a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
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


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:32:19 GMT -->
</html>
