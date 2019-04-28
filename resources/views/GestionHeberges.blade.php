@extends('layouts.app')
@section('titre')
Gestion des hébergés
@endsection
@section('navbar')
<div class="collapse navbar-collapse" id="example-navbar-collapse">       
  <ul class="nav navbar-nav">
    <li ><a href="/etudiants"><span class="fa fa-users"></span> Etudiants</a></li>
    <li><a href="/paiements"><span class="glyphicon glyphicon-usd"></span> Paiements</a></li>
    <li class="active"><a href="/heberges"><span class="glyphicon glyphicon-duplicate"></span> Hébergés</a></li>
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
      <li class="active">Gestion des hébergés</li>
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
          <h2 class="panel-title">Gestion des hébergés</h2>
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
            <button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter </button>
           </div> 
<!-- Add input -->         
<!-- Table  -->
<table id="dataTable" class="table table-bordered table-hovered">
            <thead>
              <tr>
                <th>Id</th>
                <th>cin</th>  
                <th>Nom et prénom</th> 
                <th>chambre</th>
                <th>Opérations</th>
              </tr>
            </thead>
            <tbody>      
            @foreach($heberge as $heb)    
              <tr>
                <td>{{$heb->id}}</td>
                <td>{{App\Etudiant::find($heb->etudiant_id)->cin}}</td> 
                <td>{{App\Etudiant::find($heb->etudiant_id)->nom}}</td> 
                <td>{{App\Chambre::find($heb->chambre_id)->num_chambre}}</td>      
                <td><center>
          <a href="/supprimerHeberge/{{$heb->id}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>  
            <a href="/updateHeberge/{{$heb->id}}" class="btn btn-default"  id="bt" name="bt_modifier" ><span class="glyphicon glyphicon-edit"></span></a> </td>
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

        <form class="form-horizontal" id="submitProductForm" action="/ajouterHeberge" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i>  Ajouter un hébergé</h4>
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
                <label for="productName" class="col-sm-3 control-label">CIN </label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                <input align="middle" type="text" class="form-control" name="search" id="search" class="search_box" > 
                    </div>
            </div>                

            <div class="form-group">
                <label for="productName" class="col-sm-3 control-label">Nom & prénom</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                  
                      <h5 align="center"> <span id="wnom"></span></h5>
                    </div>
            </div>      

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Gouvernorat</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8" class="inner">
                      
                      <h5 align="center"> <span id="wgouvernorat" class="inner"></span></h5>
                    </div>
            </div>   


            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Faculté </label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                  
                      <h5 align="center"> <span id="wfaculte"></span></h5>
                    </div>
            </div>         



            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Télephone</label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                  
                      <h5 align="center"> <span id="wtelephone"></span></h5>
                    </div>
            </div>  

            <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Chambre</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wchambre" name="wchambre" data-live-search="true" data-live-search-style="startsWith">                
                @foreach($chambre as $ch)
                <option value="{{$ch->id}}">{{$ch->num_chambre}}</option>
                @endforeach
              </select>
            </div>
          </div> <!-- /form-group-->  
  
            <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Approbation du logement</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wd1" name="wd1" data-live-search="true" data-live-search-style="startsWith">                
                <option value="oui">oui</option>
                <option value="non">non</option>
               
              </select>
            </div>
          </div> <!-- /form-group-->  


            <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">reçu d'inscription universitaire</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wd2" name="wd2" data-live-search="true" data-live-search-style="startsWith">                
                 <option value="oui">oui</option>
                 <option value="non">non</option>
               
              </select>
            </div>
          </div> <!-- /form-group--> 


            <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Certificat de résidence</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wd3" name="wd3" data-live-search="true" data-live-search-style="startsWith">                
                 <option value="oui">oui</option>
                 <option value="non">non</option>
               
              </select>
            </div>
          </div> <!-- /form-group--> 

        <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">copie de CIN</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wd4" name="wd4" data-live-search="true" data-live-search-style="startsWith">                
                 <option value="oui">oui</option>
                 <option value="non">non</option>
               
              </select>
            </div>
          </div> <!-- /form-group--> 


     <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">cértificat médicale</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wd5" name="wd5" data-live-search="true" data-live-search-style="startsWith">                
                 <option value="oui">oui</option>
                 <option value="non">non</option>
               
              </select>
            </div>
          </div> <!-- /form-group--> 

     <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Enveloppes</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wd6" name="wd6" data-live-search="true" data-live-search-style="startsWith">                
                <option value="oui">oui</option>
                <option value="non">non</option>
               
              </select>
            </div>
          </div> <!-- /form-group--> 
          <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">photos</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wd7" name="wd7" data-live-search="true" data-live-search-style="startsWith">                
                 <option value="oui">oui</option>
                 <option value="non">non</option>
                
              </select>
            </div>
          </div> <!-- /form-group--> 



     <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Réglement intérieur</label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <select class="form-control" id="wd8" name="wd8" data-live-search="true" data-live-search-style="startsWith">                
                 <option value="oui">oui</option>
                 <option value="non">non</option>
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
            

            <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign" name="createProductBtn" disabled='disabled'></i> Ajouter</button>
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



$(document).ready(function(){



 function fetch_customer_data(query = '')
 {

  $.ajax({
   url:"/wsHeberge",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    console.log("Rami");
    console.log(data.result);



    if(data.gouvernorat=='pas de données')
    {

      document.getElementById("createProductBtn").disabled = true;
      document.getElementById("wchambre").disabled = true;
      document.getElementById("wd1").disabled = true;
      document.getElementById("wd2").disabled = true;
      document.getElementById("wd3").disabled = true;
      document.getElementById("wd4").disabled = true;
      document.getElementById("wd5").disabled = true;
      document.getElementById("wd6").disabled = true;
      document.getElementById("wd7").disabled = true;
      document.getElementById("wd8").disabled = true;
    }
    else if(data.gouvernorat=='étudiant deja hébergé'){

      document.getElementById("createProductBtn").disabled = true;
      document.getElementById("wchambre").disabled = true;
      document.getElementById("wd1").disabled = true;
      document.getElementById("wd2").disabled = true;
      document.getElementById("wd3").disabled = true;
      document.getElementById("wd4").disabled = true;
      document.getElementById("wd5").disabled = true;
      document.getElementById("wd6").disabled = true;
      document.getElementById("wd7").disabled = true;
      document.getElementById("wd8").disabled = true;
    }
    else
    {

      document.getElementById("createProductBtn").disabled = false;
      document.getElementById("wchambre").disabled = false;
      document.getElementById("wd1").disabled = false;
      document.getElementById("wd2").disabled = false;
      document.getElementById("wd3").disabled = false;
      document.getElementById("wd4").disabled = false;
      document.getElementById("wd5").disabled = false;
      document.getElementById("wd6").disabled = false;
      document.getElementById("wd7").disabled = false;
      document.getElementById("wd8").disabled = false;
     
    }

    $('#wnom').text(data.result);
    $('#wgouvernorat').text(data.gouvernorat);
    $('#wfaculte').text(data.faculte);
    $('#wtelephone').text(data.telephone);




   }
  })
 }




$(document).on('keyup', '#search', function(){
  var query = $(this).val();
  document.getElementById("createProductBtn").disabled = true;
document.getElementById("wd1").disabled = true;
document.getElementById("wd2").disabled = true;
document.getElementById("wd3").disabled = true;
document.getElementById("wd4").disabled = true;
document.getElementById("wd5").disabled = true;
document.getElementById("wd6").disabled = true;
document.getElementById("wd7").disabled = true;
document.getElementById("wd8").disabled = true;

    $('#wnom').text('pas de données');
    $('#wgouvernorat').text('pas de données');
    $('#wfaculte').text('pas de données');
    $('#wtelephone').text('pas de données');
  fetch_customer_data(query);
  console.log('CIN :  '+query);
 });


  });



document.getElementById("createProductBtn").disabled = true;
document.getElementById("wd1").disabled = true;
document.getElementById("wd2").disabled = true;
document.getElementById("wd3").disabled = true;
document.getElementById("wd4").disabled = true;
document.getElementById("wd5").disabled = true;
document.getElementById("wd6").disabled = true;
document.getElementById("wd7").disabled = true;
document.getElementById("wd8").disabled = true;

    $('#wnom').text('pas de données');
    $('#wgouvernorat').text('pas de données');
    $('#wfaculte').text('pas de données');
    $('#wtelephone').text('pas de données');
</script>


@endsection