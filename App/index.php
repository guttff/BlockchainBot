<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Blockchain Bot</title>
  </head>
  <body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
  
  
  
  
  	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#"> <img class="logo" src="http://bootstrap-ecommerce.com/main/images/logo-white.png" height="40"> Blockchain Bot</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbar1">
	    <ul class="navbar-nav ml-auto"> 
	<li class="nav-item active">
	<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	</li>
	<li class="nav-item"><a class="nav-link" href="html-components.html"> Documentation </a></li>
	<li class="nav-item dropdown">
		<a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">  Dropdown  </a>
	    <ul class="dropdown-menu">
		  <li><a class="dropdown-item" href="#"> Menu item 1</a></li>
		  <li><a class="dropdown-item" href="#"> Menu item 2 </a></li>
	    </ul>
	</li>
	<li class="nav-item">
	<a class="btn ml-2 btn-warning" href="#">Bittrex</a></li>
	    </ul>
	  </div>
	</nav>
  
  
  
  
  
  
  
  
  
  
  
  
  
  	<div class="container-fluid" >
		<div class="row">
	        <div class="col-sm-12">
	            <legend></legend>
	        </div>
	        <!-- panel preview -->
	        <div class="col-sm-4" style="border-right: 1px solid #ccc;">
	            <div class="form-group row">
		            <div class="col-sm-6 text-left" >
		            	<h4><i class="fas fa-robot"></i> BOT</h4>
		            </div>
	                <div class="col-sm-6 text-right">
	                    <button type="button" class="btn btn-success preview-add-button">
	                        <span class="glyphicon glyphicon-plus"></span> Create
	                    </button>
	                 </div>
	            </div>       
	            <hr>
				<style>
					.panel::-webkit-scrollbar
					{
				        border-radius: 10px;
				        box-shadow: inset 0 0 6px rgba(0,0,0,.3);
				        background-color: #737272;
				        border: 1px solid #000;
				    }
				</style>
	            <div class="panel panel-default " style="max-height: 400px; overflow: auto">
	                <div class="panel-body form-horizontal bot-form container-fluid">
	                    <div class="form-group row">
	                        <label for="concept" class="col-sm-3 control-label">Bot Name</label>
	                        <div class="col-sm-9">
	                            <input type="text" class="form-control" id="concept" name="concept">
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label for="description" class="col-sm-3 control-label">Description</label>
	                        <div class="col-sm-9">
	                            <input type="text" class="form-control" id="description" name="description">
	                        </div>
	                    </div> 
	                    <div class="form-group row">
	                        <label for="amount" class="col-sm-3 control-label">Budget</label>
	                        <div class="col-sm-9">
	                            <input type="number" class="form-control" id="amount" name="amount">
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label for="status" class="col-sm-3 control-label">Status</label>
	                        <div class="col-sm-9">
	                            <select class="form-control" id="status" name="status">
	                                <option>Running</option>
	                                <option>Stopped</option>
	                            </select>
	                        </div>
	                    </div> 
	                    <div class="form-group row">
	                        <label for="status" class="col-sm-3 control-label">Owner</label>
	                        <div class="col-sm-9">
	                            <select class="form-control" id="status" name="status">
	                                <option>Evens Perjuste</option>
	                                <option>Francois Gutt</option>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label for="date" class="col-sm-3 control-label">Start Now</label>
	                        <div class="col-sm-9">
	                            <input type="checkbox" class="form-control" id="date" name="date">
	                        </div>
	                    </div> 
	                    <div class="form-group row">
	                        <label for="date" class="col-sm-3 control-label">Start On</label>
	                        <div class="col-sm-9">
	                            <input type="date" class="form-control" id="date" name="date">
	                        </div>
	                    </div>   
	                    <div class="form-group row">
	                        <label for="status" class="col-sm-3 control-label">Trend</label>
	                        <div class="col-sm-9">
	                            <select class="form-control" id="status" name="status">
	                                <option>UP</option>
	                                <option>DOWN</option>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label for="concept" class="col-sm-3 control-label">Spread Max</label>
	                        <div class="col-sm-9">
	                            <input type="text" class="form-control" id="concept" name="concept">
	                        </div>
	                    </div>
	                     <div class="form-group row">
	                        <label for="concept" class="col-sm-3 control-label">Spread Min</label>
	                        <div class="col-sm-9">
	                            <input type="text" class="form-control" id="concept" name="concept">
	                        </div>
	                    </div>
	                </div>
	            </div>            
	        </div> <!-- / panel preview -->
	        <style>
	        	.dash ul{list-style-type: none;}
	        	.dash li{float: left; text-align: center;  border: 1px solid #ccc; margin: 5px; }
	        	.dash li span{ padding: 5px; font-weight: bold;}
	        </style>
	        <div class="col-sm-8">
	            
	             <div class="form-group row">
		            <div class="col-sm-6 text-left" >
		            	<h4><i class="fas fa-tachometer-alt"></i> Dashboard</h4>
		            </div>
		            <!-- 
	                <div class="col-sm-6 text-right">
	                    <button type="button" class="btn btn-success preview-add-button">
	                        <span class="glyphicon glyphicon-plus"></span> Create
	                    </button>
	                 </div>
	                 -->
	            </div>       
	            <hr>
	            <!-- 
	            <div class="row dash" style="margin: 10px 0; padding: 10px;">
	            	<ul>
	            		<li>
	            			<span class="text-light bg-dark">Account Balance</span>
	            			<br><br>
	            			<h4><strong><span class="preview-total"><span class="text-success">$ 251.89</span></span></strong></h4>
	            		</li>
	            		<li>
	            			<span class="text-light bg-dark">Coins Owned</span>
	            			<br><br>
	            			<h4><strong><span class="preview-total"><span class="">75</span></span></strong></h4>
	            		</li>
	            		<li>
	            			<span class="text-light bg-dark">Bots Total</span>
	            			<br><br>
	            			<h4><strong><span class="preview-total"><span class="">12</span></span></strong></h4>
	            		</li>
	            		<li>
	            			<span class="text-light bg-dark">Running</span>
	            			<br><br>
	            			<h4><strong><span class="preview-total"><span class="">6</span></span></strong></h4>
	            		</li>
	            	</ul>
	            </div>
	            -->
	            <div class="row" style="max-height: 400px; overflow: auto; background: #fff;">
	                <div class="col-xs-12">
	                    <div class="table-responsive">
	                        <table class="table preview-table">
	                            <thead>
	                                <tr>
	                                    <th>Name <i class="fas fa-caret-down"></i></th>
	                                    <th>($) Profit <i class="fas fa-caret-down"></i></th>
	                                    <th>Transaction(s) <i class="fas fa-caret-down"></i></th>
	                                    <th>Created By <i class="fas fa-caret-down"></i></th>
	                                    <th>Status <i class="fas fa-caret-down"></i></th>
	                                    <th>Started On <i class="fas fa-caret-down"></i></th>
	                                    <th>Action <i class="fas fa-caret-down"></i></th>
	                                </tr>

	                            </thead>
	                            <tbody>
	                            	<tr>
	                                    <td>Conservative Bot</td>
	                                    <td><span class="text-success">$ 10.02</span></td>
	                                    <td>
	                                    	Buy <span class="text-success">(10)</span> /
	                                    	Sell<span class="text-warning"> 	(9)</span>
	                                    </td>
	                                    <td>Francois Gutt</td>
	                                    <td><span class="text-success">Running</span></td>
	                                    <td><span class="text-secondary">11/10/2018 3:12 AM</span></td>
	                                    <td>
	                                    	<i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;&nbsp;
	                                    	<i class="far fa-edit text-primary"></i>&nbsp;&nbsp;&nbsp;&nbsp;
	                                    	<i class="far fa-play-circle text-success"></i>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Agressive Bot</td>
	                                    <td><span class="text-danger">($ 44.12)</span></td>
	                                    <td>
	                                    	Buy <span class="text-success">(56)</span> /
	                                    	Sell<span class="text-warning"> 	(57)</span>
	                                    </td>
	                                    <td>Evens Perjuste</td>
	                                    <td><span class="text-danger">Stopped</span></td>
	                                    <td><span class="text-secondary">11/10/2018 3:12 AM</span></td>
	                                    <td>
	                                    	<i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;&nbsp;
	                                    	<i class="far fa-edit text-primary"></i>&nbsp;&nbsp;&nbsp;&nbsp;
	                                    	<i class="far fa-stop-circle text-danger"></i>
	                                    </td>
	                                </tr>
	                            </tbody> <!-- preview content goes here-->
	                        </table>
	                    </div>                            
	                </div>
	            </div>
	            <!-- 
	            <div class="row text-right">
	                <div class="col-xs-12">
	                    <h4>Total: <strong><span class="preview-total"><span class="text-success">$ 25.89</span></span></strong></h4>
	                </div>
	            </div>
	             -->
	             <!-- 
	            <div class="row">
	                <div class="col-xs-12">
	                    <hr style="border:1px dashed #dddddd;">
	                    <button type="button" class="btn btn-primary btn-block">Submit all and finish</button>
	                </div>                
	            </div>
	             -->
	        </div>
		</div>
	</div>
	<style>
		.footer {
		  position: absolute;
		  bottom: 0;
		  width: 100%;
		  height: 50px;
		  background-color: #111;
		  text-align: center;
		}
	</style>
	<div class="footer">
      <div class="container">
              <a href='#'>Bittrex API</i></a>
             

      </div>
    </div>
	
	<script>
		function calc_total(){
		    var sum = 0;
		    $('.input-amount').each(function(){
		        sum += parseFloat($(this).text());
		    });
		    $(".preview-total").text(sum);    
		}
		$(document).on('click', '.input-remove-row', function(){ 
		    var tr = $(this).closest('tr');
		    tr.fadeOut(200, function(){
		    	tr.remove();
			   	calc_total()
			});
		});
	
		$(function(){
		    $('.preview-add-button').click(function(){
		        $('.preview-table > tbody > tr:last').after( $('.preview-table > tbody > tr:first').clone() );    
		    });  
		});
	</script>
  </body>
</html>