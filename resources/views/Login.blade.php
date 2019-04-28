@extends('layouts.app')
@section('titre')
Gestion de stock
@endsection

@section('navbar')
<div class="collapse navbar-collapse" id="example-navbar-collapse">
       <ul class="nav navbar-nav">

       </ul>
 </div>
@endsection


@section('content')
<div class="row">
	<div class="col-lg-4"></div>
	<div class="col-lg-4">
	
			<div class="panel panel-default">
				<div class="panel-heading">
						<center>
					<h2 class="panel-title"><span class="fa fa-key"></span> Authentification</h2>
					</center>
				</div>
				<div class="panel-body">
					
					<form action="{{url('/checklogin')}}" method="POST">
					  <div class="form-group">
					    <label for="email">Login :</label>
					    <input type="text" class="form-control" name="wlogin">
					  </div>
					  <div class="form-group">
					    <label for="pwd">Mot de passe :</label>
					    <input type="password" class="form-control" name="wmdp">
					  </div>
					  <center>
					  <button type="submit" class="btn btn-primary">Valider</button>
					  </center>
					   {{ csrf_field() }}
					</form>

                </div>
			</div>
		 	
	</div>
  <div class="col-lg-4"></div>
</div>



@endsection