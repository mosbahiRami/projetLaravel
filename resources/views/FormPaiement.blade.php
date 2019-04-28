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
      <li class="active">Gestion des paiements</li>
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
          <h2 class="panel-title">Gestion des paiements</h2>
        </div>
          <div class="panel-body"><div class="col-lg-3"></div>
          <!-- Panel Body --> 

<form class="form-horizontal" id="submitProductForm" action="/modifierPaiement" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
         
          </div>

          <div class="modal-body" style="max-height:450px; overflow:auto;">

            <div id="add-product-messages"></div>
            <div class="form-group">
                <label for="productName" class="col-sm-3 control-label">CIN</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                  
                      <h5 align="center"> <span id="wnom">{{App\Etudiant::find($paiement->etudiant_id)->cin}}</span></h5>
                    </div>
            </div> 
          <div class="form-group">
                <label for="productName" class="col-sm-3 control-label">Nom & prénom</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                  
                      <h5 align="center"> <span id="wnom">{{App\Etudiant::find($paiement->etudiant_id)->nom}}</span></h5>
                    </div>
            </div> 
          <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Trimestre 1</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="trimestre1" name="trimestre1" data-live-search="true" data-live-search-style="startsWith">@if($paiement->trimestre1=="payé")              
                <option value="payé">payé</option>
                <option value="non payé">non payé</option>
              @else 
              <option value="non payé">non payé</option>
                <option value="payé">payé</option>
              @endif
              </select>
            </div>
          </div> 
          <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Trimestre 2</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="trimestre2" name="trimestre2" data-live-search="true" data-live-search-style="startsWith">@if($paiement->trimestre2=="payé")              
                <option value="payé">payé</option>
                <option value="non payé">non payé</option>
              @else 
              <option value="non payé">non payé</option>
                <option value="payé">payé</option>
              @endif
              </select>
            </div>
          </div> <!-- /form-group--> 
          <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Trimestre 3</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="trimestre3" name="trimestre3" data-live-search="true" data-live-search-style="startsWith">@if($paiement->trimestre3=="payé")              
                <option value="payé">payé</option>
                <option value="non payé">non payé</option>
              @else 
              <option value="non payé">non payé</option>
                <option value="payé">payé</option>
              @endif
              </select>
            </div>
          </div> <!-- /form-group-->                  
           <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Cautionnement</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="cautionnement" name="cautionnement" data-live-search="true" data-live-search-style="startsWith">@if($paiement->cautionnement=="rendu")              
                <option value="rendu">rendu</option>
                <option value="non rendu">non rendu</option>
              @else 
              <option value="non rendu">non rendu</option>
                <option value="rendu">rendu</option>
              @endif
              </select>
            </div>
          </div> <!-- /form-group-->    

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

 <input type="hidden"  name="wid1" value="{{$paiement->id}}">
<input type="hidden"  name="cin" value="{{$paiement->cin}}">
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