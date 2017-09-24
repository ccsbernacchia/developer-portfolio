/**
 * Controller4b.js for index16.html
 */
 
 var app = angular.module('mainApp',[]); // 
 
 //$http is built-in on angular 1.3.14 so no dependencies needed
 app.controller('people',function($scope, $http){ 
	 
	 $http.get('peopledata.json')
	 .success(function(response){
		 $scope.persons = response.records; 
	 }); //end get
	 
 }); //end controller
 

 
 
 