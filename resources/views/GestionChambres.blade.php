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
    <li><a href="/administrateurs"><span class="fa fa-user"></span> Administrateurs</a></li>      
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
      <li class="active">Gestion des chambres</li>
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
          <h2 class="panel-title">Gestion des chambres</h2>
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
            <button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Chambre </button>
           </div> 
<!-- Add input -->         
<!-- Table  -->
<table id="dataTable" class="table table-bordered table-hovered">
            <thead>
              <tr>
                <th>Id</th>
                <th>Bloc</th>  
                <th>Numéro chambre</th>
                <th>Capacité</th>
                <th>Etat</th>
                <th>Opérations</th>
              </tr>
            </thead>
            <tbody>      
            @foreach($chambre as $ch)    
              <tr>
                <td>{{$ch->id}}</td>
                <td>{{$ch->bloc_chambre}}</td> 
                <td>{{$ch->num_chambre}}</td>     
                <td>{{$ch->capacite}}</td>  
                <td>
                  @if($ch->etat=="Réservé")
                    <label class="label label-danger">{{$ch->etat}}</label>
                  @else
                    <label class="label label-success">{{$ch->etat}}</label>
                  @endif
                </td>
                <td><center>
          <a href="/supprimerChambre/{{$ch->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>  
       <a href="/updateChambre/{{$ch->id}}" class="btn btn-default"  id="bt" name="bt_modifier" ><span class="glyphicon glyphicon-edit"></span></a> </td>
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

<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

        <form class="form-horizontal" id="submitProductForm" action="/ajouterChambre" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i>  Ajouter une chambre</h4>
          </div>

          <div class="modal-body" style="max-height:450px; overflow:auto;">

            <div id="add-product-messages"></div>
                           

            <div class="form-group">
                <label for="productName" class="col-sm-3 control-label">Bloc</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input pattern="[A-Z]{1}" type="text"  class="form-control" id="wbloc_chambre" placeholder="Code" name="wbloc_chambre" autocomplete="off" required="true">
                    </div>
            </div>   

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Numéro chambre</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="wnum_chambre" placeholder="Faculté" name="wnum_chambre" autocomplete="off" required="true">
                    </div>
            </div>         
            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Capacité</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="wcapacite" placeholder="Faculté" name="wcapacite" autocomplete="off" required="true" pattern="[1-3]{1}">
                    </div>
            </div>
  
            <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Etat</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wetat" name="wetat">                
                <option >Réservé</option>
                <option >Non Reservé</option>
              </select>
            </div>
          </div> <!-- /form-group-->  


      <div class="form-group">
                <label for="rate" class="col-sm-3 control-label"></label>
                <label class="col-sm-1 control-label"> </label>
                    <div class="col-sm-8">
            
                    </div>
            </div>                                               


          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Fermer</button>
            
            <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Ajouter</button>
          </div> <!-- /modal-footer -->   
          {{ csrf_field() }}    
        </form> <!-- /.form -->     

    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
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