@extends('layouts.app')
@section('titre')
Gestion des hébergés
@endsection
@section('navbar')
<div class="collapse navbar-collapse" id="example-navbar-collapse">       
  <ul class="nav navbar-nav">
    <li ><a href="/articles"><span class="fa fa-users"></span> Etudiants</a></li>
    <li><a href="/fournisseurs"><span class="glyphicon glyphicon-usd"></span> Paiements</a></li>
    <li ><a href="/clients"><span class="glyphicon glyphicon-duplicate"></span> Hébergés</a></li>
    <li><a href="/mouvements"><span class="fa fa-user"></span> Administrateurs</a></li>      
    <li class=" active dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-wrench"></span> Paramètres <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/chambres"><span class="fa fa-university"></span>  Chambres</a></li>
            <li><a href="/facultes"><span class="fa fa-print"></span>  Facultés</a></li>
            <li><a href="/gouvernorats"><span class="glyphicon glyphicon-home"></span>  Gouvernorats</a></li>
          </ul>
    </li>
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
      <li class="active">Gestion des facultés</li>
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
          <div class="panel-body">
<!-- Panel Body --> 
<h3 align="center">Total Data : <span id="total_records"></span></h3>
      <!-- Search input --> 
          <div class="div-action pull pull-left" style="padding-bottom:20px;">        
           <input type="text" class="form-control" name="search" id="search" class="search_box" > 
          </div>
<!-- Search input --> 
            <div class="div-action pull pull-right" style="padding-bottom:20px;">

            <button onclick="test()" class="btn btn-default button1" > <i class="glyphicon glyphicon-plus-sign"></i> Ajouter Gouvernorat </button>
           </div> 


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


$(document).ready(function(){;
  function test()
  {
    console.log('Hello Rami Mosbahi')
  }

});











$(document).ready(function(){



 function fetch_customer_data(query = '')
 {

  $.ajax({
   url:"/ws",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    console.log("Rami");
    $('#total_records').text(data.result);
   }
  })
 }




$(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
  console.log(query);
 });


  });


</script>


@endsection