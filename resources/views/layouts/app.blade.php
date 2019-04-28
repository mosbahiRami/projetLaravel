<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
    @yield('titre')
    </title>
    <!-- Bootstrap -->
    <link href="{{url('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('bootstrap/dist/css/all.min.css')}}" rel="stylesheet">


  </head>
<body>
 <!--Navbar -->
 <nav class="navbar navbar-default" role="navigation">
   <div class="navbar-header">
     <button type="button" class="navbar-toggle" data-toggle="collapse"
     data-target="#example-navbar-collapse">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
   <a class="navbar-brand" href="/dashboard"><span class="fa fa-cube"></span> Gestion des hébergés</a>
   </div>
   @yield('navbar')
  </nav>

  @yield('content')
<!-- jQuery -->
    <script src="{{url('bootstrap/dist/js/jquery.min.js')}}"></script>
    <!-- Javascript -->
    <script src="{{url('bootstrap/dist/js/bootstrap.min.js')}}"></script>
</body>
</html>