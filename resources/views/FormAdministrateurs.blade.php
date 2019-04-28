@extends('layouts.app')
@section('titre')
Gestion des hébergés
@endsection
@section('navbar')
<div class="collapse navbar-collapse" id="example-navbar-collapse">       
  <ul class="nav navbar-nav">
    <li ><a href="/etudiants"><span class="fa fa-users"></span> Etudiants</a></li>
    <li><a href="/paiements"><span class="glyphicon glyphicon-usd"></span> Paiements</a></li>
    <li ><a href="/heberges"><span class="glyphicon glyphicon-duplicate"></span> Hébergés</a></li>
    <li class="active"><a href="/administrateurs"><span class="fa fa-user"></span> Administrateurs</a></li>      
    <li><a href="/chambres"><span class="fa fa-university"></span>  Chambres</a></li>
    <li><a href="/login"><span class=""></span> Déconnexion</a></li>
   </ul>
 </div>
@endsection


@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $key)
 @if(Session::has($key))
     <p class="alert alert-{{ $key }}">{{ Session::get($key) }}</p>
 @endif
@endforeach
<div class="row">
  <div class="col-lg-1"></div>
  <div class="col-lg-10">
    <ol class="breadcrumb">
      <li><a href="/dashboard">Gestion des hébergés</a></li>      
      <li class="active">Gestion des gouvernorats</li>
    </ol>
    <center>


    </center>   
  </div>
  <div class="col-lg-1"></div>
</div>
<div class="row">
  <div class="col-lg-1"></div>
  <div class="col-lg-10">
    <center>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title">Gestion des facultés</h2>
        </div>
          <div class="panel-body"><div class="col-lg-3"></div>
          <!-- Panel Body --> 

<form class="form-horizontal" id="submitProductForm" action="/modifierAdministrateur" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i>  Ajouter un administrateur</h4>
          </div>

          <div class="modal-body" style="max-height:450px; overflow:auto;">

            <div id="add-product-messages"></div>
                           
            <div class="form-group">
            <label for="productImage" class="col-sm-3 control-label">Photo: </label>
            <label class="col-sm-1 control-label">: </label>          
      <input class="col-sm-3" type='file' id="imgInp" name="post_image" accept="image/*" onchange="preview_image(event)" />
      <img class="img-fluid img-thumbnail img-responsive col-sm-2" id="output_image" src="/images/{{$administrateur->image}}" alt="your image" height="42" width="32"/>  
            </div>

            <div class="form-group">
                <label for="productName" class="col-sm-3 control-label">Nom</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input  value="{{$administrateur->nom}}" type="text"  class="form-control" id="wnom" placeholder="Code" name="wnom" autocomplete="off" required="true">
                    </div>
            </div>      

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Prénom</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input value="{{$administrateur->prenom}}" type="text" class="form-control" id="wprenom" placeholder="Gouvernorat" name="wprenom" autocomplete="off" required="true">
                    </div>
            </div>   

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Adresse</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input value="{{$administrateur->adresse}}" type="text" class="form-control" id="wadresse" placeholder="Gouvernorat" name="wadresse" autocomplete="off" required="true">
                      <input type="hidden"  name="wid1" value="{{$administrateur->id}}">
                    </div>
            </div>       

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Télephone</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input value="{{$administrateur->telephone}}" type="text" class="form-control" id="wtelephone" placeholder="Gouvernorat" name="wtelephone" autocomplete="off" required="true">
                    </div>
            </div>  

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Email</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input value="{{$administrateur->email}}" type="text" class="form-control" id="wemail" placeholder="Gouvernorat" name="wemail" autocomplete="off" required="true">
                    </div>
            </div> 

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">login</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input value="{{$administrateur->login}}" type="text" class="form-control" id="wlogin" placeholder="Gouvernorat" name="wlogin" autocomplete="off" required="true">
                    </div>
            </div>

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Mot de passe</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input value="{{$administrateur->mdp}}" type="text" class="form-control" id="wmdp" placeholder="Gouvernorat" name="wmdp" autocomplete="off" required="true">
                    </div>
            </div>

      <div class="form-group">
                <label for="rate" class="col-sm-3 control-label"></label>
                <label class="col-sm-1 control-label"> </label>
                    <div class="col-sm-8">
            
                    </div>
            </div> <!-- /form-group-->                                                 


          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
            
            <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Valider</button>
          </div> <!-- /modal-footer -->   
          {{ csrf_field() }}    
        </form> <!-- /.form -->     



          <!-- Panel Body --> 
          </div>
      </div>
    </center>   
  </div>
  <div class="col-lg-1"></div>
</div>

  

<!-- jQuery -->
<script src="{{url('bootstrap/dist/js/jquery.min.js')}}"></script>
<script src="{{url('js/app1.js')}}"></script>
<script type="text/javascript">
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}

function preview_image1(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image1');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}



    function doSearch() {
    var searchText = document.getElementById('searchTerm').value;
    var targetTable = document.getElementById('dataTable');
    var targetTableColCount;
            
    //Loop through table rows
    for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
        var rowData = '';

        //Get column count from header row
        if (rowIndex == 0) {
           targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
           continue; //do not execute further code for header row.
        }
                
        //Process data rows. (rowIndex >= 1)
        for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
            rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
        }

        //If search term is not found in row data
        //then hide the row, else show
        if (rowData.indexOf(searchText) == -1)
            targetTable.rows.item(rowIndex).style.display = 'none';
        else
            targetTable.rows.item(rowIndex).style.display = 'table-row';
    }
}
</script>


@endsection