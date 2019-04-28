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
      <li class="active">Gestion des administrateurs</li>
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
          <h2 class="panel-title">Gestion des administrateurs</h2>
        </div>
          <div class="panel-body">
<!-- Panel Body --> 


<!-- Search input --> 
          <div class="div-action pull pull-left" style="padding-bottom:20px;">        
           <input type="text"   placeholder="Recherche"  class="form-control" id="searchTerm" class="search_box" onkeyup="doSearch()"> 
          </div>
<!-- Search input --> 
<!-- Add input --> 
            <div class="div-action pull pull-right" style="padding-bottom:20px;">
            <button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Administrateur </button>
           </div> 
<!-- Add input -->         
<!-- Table  -->
<table id="dataTable" class="table table-bordered table-hovered">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nom</th>  
                <th>Prénom</th>
                <th>adresse</th>
                <th>telephone</th>  
                <th>email</th>
                <th>login</th>  
                <th>mdp</th>
                <th>image</th>
                <th>Opérations</th>
              </tr>
            </thead>
            <tbody>      
            @foreach($administrateur as $adm)    
              <tr>
                <td>{{$adm->id}}</td>
                <td>{{$adm->nom}}</td> 
                <td>{{$adm->prenom}}</td>   
                <td>{{$adm->adresse}}</td>
                <td>{{$adm->telephone}}</td> 
                <td>{{$adm->email}}</td>  
                <td>{{$adm->login}}</td>
                <td>{{$adm->mdp}}</td> 
                <td><img class="img-fluid img-thumbnail img-responsive "   height="42" width="52" src="/images/{{$adm->image}}" /></td>    
                <td><center>
          <a href="/supprimerAdministrateur/{{$adm->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>  
            <a href="/updateAdministrateur/{{$adm->id}}" class="btn btn-default"  id="bt" name="bt_modifier" ><span class="glyphicon glyphicon-edit"></span></a> </td>
                  </center>
                </tr>
            @endforeach
            </tbody>
          </table>
          <!-- Table  -->


          <!-- Panel Body --> 
          </div>
      </div>
    </center>   
  </div>
  <div class="col-lg-1"></div>
</div>






<!-- Ajouter un fournisseur -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

        <form class="form-horizontal" id="submitProductForm" action="/ajouterAdministrateur" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i>  Ajouter un administrateur</h4>
          </div>

          <div class="modal-body" style="max-height:450px; overflow:auto;">

            <div id="add-product-messages"></div>
                           
            <div class="form-group">
            <label for="productImage" class="col-sm-3 control-label">Image: </label>
            <label class="col-sm-1 control-label">: </label>          
      <input class="col-sm-3" type='file' id="imgInp" name="post_image" accept="image/*" onchange="preview_image(event)" />
      <img class="img-fluid img-thumbnail img-responsive col-sm-2" id="output_image" src="#" alt="your image" height="42" width="32"/>  
            </div>

            <div class="form-group">
                <label for="productName" class="col-sm-3 control-label">Nom</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input  type="text"  class="form-control" id="wnom" placeholder="Code" name="wnom" autocomplete="off" required="true">
                    </div>
            </div>      

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Prénom</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="wprenom" placeholder="Prénom" name="wprenom" autocomplete="off" required="true">
                    </div>
            </div>   

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Adresse</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="wadresse" placeholder="Adresse" name="wadresse" autocomplete="off" required="true">
                    </div>
            </div>       

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Télephone</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="wtelephone" placeholder="Télephone" name="wtelephone" autocomplete="off" required="true">
                    </div>
            </div>  

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Email</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="wemail" placeholder="Email" name="wemail" autocomplete="off" required="true">
                    </div>
            </div> 

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">login</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="wlogin" placeholder="login" name="wlogin" autocomplete="off" required="true">
                    </div>
            </div>

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Mot de passe</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="wmdp" placeholder="Mot de passe" name="wmdp" autocomplete="off" required="true">
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
            
            <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Ajouter</button>
          </div> <!-- /modal-footer -->   
          {{ csrf_field() }}    
        </form> <!-- /.form -->     

    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /Ajouter un fournisseur -->

  

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