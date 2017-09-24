/**
 * Controller6.js for index20.html
 */
 

 
 var app = angular.module('mainApp',[]); // 
 
 app.controller('app',function($scope){
	 /*
	 //this loop is resource expensive as time and memory
	 var range = 10;
	 var myRange = []; //create an empty array
	 for(i=0; i<range ;i++){
		 myRange.push(i); //push i to myRange array
		 
	 } //end for
	 $scope.myRange = myRange;
	 */
	 var range = new Array(100); //will create an array with 100 either undefined  elements

	 $scope.range = range;
	 
 });

 
 
 