<!doctype html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/user.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:33:47 GMT -->
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Nonualcos|Administración </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Canonical SEO -->
    <link rel="canonical" href="" />
    <!--  Social tags      -->
    <meta name="keywords" content="material dashboard, bootstrap material admin, bootstrap material dashboard, material design admin, material design, creative tim, html dashboard, html css dashboard, web dashboard, freebie, free bootstrap dashboard, css3 dashboard, bootstrap admin, bootstrap dashboard, frontend, responsive bootstrap dashboard, premiu material design admin">
    <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta itemprop="image" content="../../../../s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template">
    <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="../../../../s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Material Dashboard PRO by Creative Tim | Premium Bootstrap Admin Template" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="../../../../s3.amazonaws.com/creativetim_bucket/products/51/opt_mdp_thumbnail.jpg" />
    <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design." />
    <meta property="og:site_name" content="Creative Tim" />
    <!-- Bootstrap core CSS     -->
    {{ Html::style('css/bootstrap.min.css') }}
    <!--  Material Dashboard CSS    -->
    {{ Html::style('css/material-dashboard.css') }}
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    {{ Html::style('css/demo.css') }}
    <!--     Fonts and icons     -->
    {{ Html::style('css/font-awesome.css') }}
    {{ Html::style('css/google-roboto-300-700.css') }}
<!-- css para galeria de imagines-->
    {!!Html::style('css/lightbox.css')!!}
    <style>

        .campoObligatorio {
            color: red;
        }
        .btn-ocre, .btn-ocre:hover{
            background-color: #831517;
            color: #ffffff;
            background-color: #831517;
            box-shadow: none;
        }
        .btn-azul, .btn-azul:hover{
            background-color: #195BAA;
            color: #FFFFFF;
            background-color: #195BAA;
            box-shadow: none;
        }
        .btn-verde, .btn-verde:hover{
            background-color: #65BC45;
            color: #FFFFFF;
            background-color: #65BC45;
            box-shadow: none;
        }
        .btn-verde-ico
        {
            background-color: #65BC45;
        }
        .btn-amarrillo, .btn-amarrillo:hover{
            background-color: #F6EB13;
            color: #FFFFFF;
            background-color: #F6EB13;
            box-shadow: none;
        }
        .card [data-background-color="ocre"] {
            background: linear-gradient(60deg, #831517, #831517);
            box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 50, 54, 0.4);
        }
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

        .label-unaL{
          margin-top:3%;
          text-align: center;
        }

        .label-dosL{
          margin-top:2.5%;
          text-align: center;
        }
        label.error{
          color: #FF0000;
        }



    </style>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-active-color="green" data-background-color="white" >
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
            <div class="logo">
                <a href="" class="simple-text">

                      <img  src="{{ asset('img/favicon.png') }}" class="" alt="User Image" width="60px" height="50px">
                    Nonualcos
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="" class="simple-text">
                    SN
                </a>
            </div>
            <div class="sidebar-wrapper">
              <div class="user">
                  @if(Auth::user()->idEmpleado!=null)
                      <div class=" photo">
                              <img src="{{ asset( Auth::user()->empleado->imagenEmpleado) }}"  alt="{{Auth::user()->empleado->nombresEmpleado}}">
                      </div>
                  @endif
              <ul class="nav">
              <li>
                  <a data-toggle="collapse" href="#formsExamples">
                      <i class="material-icons">person</i>
                         <p>{{Auth::user()->name }}
                          <b class="caret"></b>
                        </p>

                  </a>
                  <div class="collapse" id="formsExamples">
                    <ul class="nav">
                        <li>
                            <a href="#">Mi Cuenta</a>
                        </li>
                        <li>
                            <a href="{{url('users/'.Auth::user()->id.'/edit')}}">Editar Cuenta</a>
                        </li>
                        <li>
                            <a href="{{url('users/password')}}">Cambiar mi Contraseña</a>
                        </li>
                        <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Salir
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                    </ul>
                  </div>
              </li>
            </ul>
          </div>



                <ul class="nav">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    {{-- Usuario*********************************************--}}
                    @can('users.index')
                    <li>
                      <a data-toggle="collapse" href="#UseExamples">
                          <i class="material-icons">face</i>
                          <p>Gestión Usuarios
                              <b class="caret"></b>
                          </p>
                      </a>
                      <div class="collapse" id="UseExamples">
                          <ul class="nav">
                              <li>
                                  <a href="{{ url('/users') }}">Usuarios</a>
                              </li>
                              <li>
                                @can('roles.index')
                                  <a href="{{ url('/roles') }}">Roles</a>
                                @endcan
                              </li>


                          </ul>
                      </div>

                    </li>
                    @endcan
<?php //Empleado*********************************************?>
                    <li>
                        <a data-toggle="collapse" href="#EmpleExamples">
                            <i class="material-icons">content_paste</i>
                            <p>Gestión Empleados
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="EmpleExamples">
                            <ul class="nav">
                              <li>
                                  <a href="{{ url('/unidades') }}">Unidades</a>
                              </li>
                              <li>
                                  <a href="{{ url('/cargos') }}">Cargos</a>
                              </li>
                                <li>
                                    <a href="{{ url('/empleados') }}">Empleados</a>
                                </li>

                                <li>
                                    <a href="{{ url('/planillas') }}">Planilla de pago</a>
                                </li>


                            </ul>
                        </div>
                    </li>
<?php //activo fijo**************************************?>
<li>
    <a data-toggle="collapse" href="#activoExamples">
        <i class="material-icons">note_add</i>
        <p>Gestión Activo Fijo
            <b class="caret"></b>
        </p>
    </a>
    <div class="collapse" id="activoExamples">
        <ul class="nav">
          <li>
              <a href="{{ url('/clasificaciones') }}">Clasificaciones</a>
          </li>
            <li>
                <a href="{{ url('/activos') }}">Activos</a>
            </li>
            <li>
                <a href="{{ url('/proveedores') }}">Proveedores</a>
            </li>
            <li>
                <a href="{{ url('/mantenimientos') }}">Mantenimientos</a>
            </li>
            <li>
                <a href="{{ url('/activos/generarReporte') }}">Generar Reporte</a>
            </li>

            <li>
                <a href="">Préstamos</a>
            </li>
            <li>
                <a href="">Depreciaciones</a>
            </li>

        </ul>
    </div>
</li>
<?php //transporte********************************************** ?>

<li>
    <a data-toggle="collapse" href="#TransExamples">
        <i class="material-icons">content_paste</i>
        <p>Gestión Transporte
            <b class="caret"></b>
        </p>
    </a>
    <div class="collapse" id="TransExamples">
        <ul class="nav">
            <li>
                <a href="{{ route('vales.index') }}">Vales</a>
            </li>
            <li>
                <a href="">Salidas</a>
            </li>
            <li>
                <a href="{{ route('liquidaciones.index') }}">Liquidacines</a>
            </li>
        </ul>
    </div>
</li>

                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> Contenido </a>
                    </div>

                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    @include('errors.alert_error')
                    @include('alertas.alert_password')
                    @include('alertas.alert_modificar')
                    @include('alertas.alert_crear')
                    @yield('plantilla')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">

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
<!-- plugin para galeria de imagenes-->
{!!Html::script('js/lightbox.js')!!}
@section('scripts')
@show

<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/user.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2017 21:33:48 GMT -->
</html>
