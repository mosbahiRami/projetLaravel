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
          <div class="panel-body"><div class="col-lg-3"></div>
          <!-- Panel Body --> 

<form class="form-horizontal col-lg-6" action="/modifierChambre" method="POST" enctype="multipart/form-data">

  
    <div class="form-group">
      <label class="control-label col-sm-2" for="wnom1">Bloc:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="wbloc_chambre" placeholder="Code" name="wbloc_chambre" autocomplete="off"  required="true" pattern="[A-Z]{3}" value="{{$chambre->bloc_chambre}}" name="wcode_faculte">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-2" for="wnom1">Numéro chambre:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="wnum_chambre" placeholder="Faculté" value="{{$chambre->num_chambre}}" autocomplete="off"  required="true" name="wlibelle_faculte">
      </div>
    </div>
     <div class="form-group">
      <label class="control-label col-sm-2" for="wnom1">Capacité:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="wcapacite" placeholder="Faculté" value="{{$chambre->capacite}}" autocomplete="off"  required="true" name="wcapacite" pattern="[1-3]{1}">
      </div>
    </div>
         <div class="form-group">
      <label class="control-label col-sm-2" for="wnom1">Etat:</label>
      <div class="col-sm-10">
             <select class="form-control" id="wetat" name="wetat">                
                @if($chambre->etat=="Réservé")
                    <option >{{$chambre->etat}}</option>
                  @else
                    <option >{{$chambre->etat}}</option>
                  @endif
              </select>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-warning">Valider</button>
      
      </div>
       <input type="hidden"  name="wid1" value="{{$chambre->id}}">
    </div>{{ csrf_field() }}   
  </form>



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