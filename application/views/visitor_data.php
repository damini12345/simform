<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Visitors</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datatables.bootstrap.css">
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script> 
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/angular-datatables.min.js"></script>
	<script src="<?php echo base_url(); ?>angularjs/controller/visitorController.js"></script>
	<script src="<?php echo base_url(); ?>angularjs/directives/export-csv.js"></script>
</head>
<body ng-app="simformApp" ng-controller="visitorController">
<div class="container" ng-init="fetchData()">
	<div class="alert alert-success alert-dismissible" ng-show="success" >
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{successMessage}}
	</div>
	<!-- <div align="right"> -->
		<button type="button" name="add_button" ng-click="createVisitor()" class="btn btn-success">Create Visitor</button>
		<button export-to-csv class="btn btn-primary" >Export CSV</button>
	<!-- </div> -->
	<table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Date of Birth</th>
				<th>Random Number</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="visitor in visitorData">
				<td>{{$index + 1}}</td>
				<td>{{visitor.first_name}}</td>
				<td>{{visitor.last_name}}</td>
				<td>{{visitor.email}}</td>
				<td>{{visitor.date_of_birth | date}}</td>
				<td>{{visitor.random_number | number:0}}</td>
				<td><button type="button" ng-click="editData(visitor.id)" class="btn btn-warning btn-xs">Edit</button></td>
				<td><button type="button" ng-click="deleteData(visitor.id)" class="btn btn-danger btn-xs">Delete</button></td>
			</tr>
		</tbody>
	</table>
	<div class="pull-right">
	<pagination 
      ng-model="currentPage"
      total-items="total_row"
      max-size="maxSize"  
      boundary-links="true">
    </pagination>


</div>
</div>
</body>
</html>

<div class="modal fade" tabindex="-1" role="dialog" id="crudmodal">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
    		<form method="post" ng-submit="submitForm()">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title">{{modalTitle}}</h4>
	      		</div>
	      		<div class="modal-body">
	      			<div class="alert alert-danger alert-dismissible" ng-show="error" >
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{errorMessage}}
					</div>
					<div class="form-group">
						<label>Enter First Name</label>
						<input type="text" name="first_name" ng-model="first_name" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Enter Last Name</label>
						<input type="text" name="last_name" ng-model="last_name" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Enter Email</label>
						<input type="email" name="email" ng-model="email" class="form-control" required />
					</div>
					<div class="form-group">
						<label>Enter DOB</label>
						<input type="text" name="dob" ng-model="dob" class="form-control" placeholder="1994-12-12" required />
					</div>
	      		</div>
	      		<div class="modal-footer">
	      			<input type="hidden" name="id" value="{{id}}" />
	      			<input type="hidden" name="random_number" value="{{random_number}}" />
	      			<input type="submit" name="submit" id="submit" class="btn btn-info" value="{{submit_button}}" />
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        	</div>
	        </form>
    	</div>
  	</div>
</div>