@extends('layouts.app')

@section('content')
<!-- Bootstrap core CSS     -->
  
    {!!Html::style('css/bootstrap.min.css')!!}
    <!--  Material Dashboard CSS    -->
    {!!Html::style('css/material-dashboard.css')!!}
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    {!!Html::style('css/demo.css')!!}
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
