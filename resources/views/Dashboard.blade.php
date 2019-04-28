@extends('layouts.app')



@section('navbar')
<div class="collapse navbar-collapse" id="example-navbar-collapse">       
  <ul class="nav navbar-nav">
    <li ><a href="/etudiants"><span class="fa fa-users"></span> Etudiants</a></li>
    <li><a href="/paiements"><span class="glyphicon glyphicon-usd"></span> Paiements</a></li>
    <li><a href="/heberges"><span class="glyphicon glyphicon-duplicate"></span> Hébergés</a></li>
    <li><a href="/administrateurs"><span class="fa fa-user"></span> Administrateurs</a></li>      
    <li><a href="/chambres"><span class="fa fa-university"></span>  Chambres</a></li>

    <li><a href="/login"><span class=""></span> Déconnexion</a></li>
   </ul>
 </div>
@endsection

    <!-- Librairie Chart.JS -->
    <script src="{{url('Assets/Chartjs/Chart.min.js')}}"></script>

@section('content')

<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<ol class="breadcrumb">
		  <li><a href="/dashboard">Gestion des hébergés</a></li>		  
		  <li class="active">Tableau de bord</li>
		</ol>
		<center>


	<div class="col-md-6">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a  style="text-decoration:none;color:black;">
					Nombre de sorties :
					<span class="badge pull pull-right"></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

	<div class="col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<a style="text-decoration:none;color:black;">
					Nombre d'entrées :
					<span class="badge pull pull-right"></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

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
					<h2 class="panel-title">Les Statistiques</h2>
				</div>
				<div class="panel-body">
					
					
   			 <h2></h2><br>
	         	<div class="col-md-6">
                   
	               <canvas id="mycanvas"></canvas>
                   
	            </div>  
                <div class="col-md-6">
                   
	               <canvas id="mycanvas1"></canvas>
                   
	            </div> 
                <!--
                <div class="col-md-6">
                   
                   <canvas id="pie-chart" width="800" height="450"></canvas>
                </div>   
	               -->
                
				

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
  $(document).ready(function() {
    $('.navbar-nav [data-toggle="tooltip"]').tooltip();
    $('.navbar-twitch-toggle').on('click', function(event) {
        event.preventDefault();
        $('.navbar-twitch').toggleClass('open');
    });
    
    $('.nav-style-toggle').on('click', function(event) {
        event.preventDefault();
        var $current = $('.nav-style-toggle.disabled');
        $(this).addClass('disabled');
        $current.removeClass('disabled');
        $('.navbar-twitch').removeClass('navbar-'+$current.data('type'));
        $('.navbar-twitch').addClass('navbar-'+$(this).data('type'));
    });
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.navbar-nav [data-toggle="tooltip"]').tooltip();
    $('.navbar-twitch-toggle').on('click', function(event) {
        event.preventDefault();
        $('.navbar-twitch').toggleClass('open');
    });
    
    $('.nav-style-toggle').on('click', function(event) {
        event.preventDefault();
        var $current = $('.nav-style-toggle.disabled');
        $(this).addClass('disabled');
        $current.removeClass('disabled');
        $('.navbar-twitch').removeClass('navbar-'+$current.data('type'));
        $('.navbar-twitch').addClass('navbar-'+$(this).data('type'));
    });
});
</script>
<script type="text/javascript">

      


var ctx = document.getElementById("mycanvas").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["L", "B", "O"],
        datasets: [{
            label: 'Les Blocs',          
            data: [125, 100, 160],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});


var ctx = document.getElementById("mycanvas1").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Iset", "Stls", "Fseg"],
        datasets: [{
            label: 'Les facultés',          
            data: [40, 125, 160],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});




  












</script>
@endsection