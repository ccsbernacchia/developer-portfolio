/**
 * Controller9.js for index24.html
 */
 

 var application = angular.module('mainApp',[]);
 
 
//create a service
//first run the name of the application 
//note: the service will not be available to other modules
//service are embedded in modules so you need to have a service going module to module

 application.service('random',function(){
	 //we are going to use this because referred to the same service itself (here this = random, the name of the service)
	 
	 //note, this is a private var of the service here and can be accessed only from inside the service - since this is OOP generate is at the end a property of the object random
	 var num =  Math.floor(Math.random()*10);
	 
	 this.generate = function(){
		 
		 return num;
		 
	 }; //end function
	 
	 
 }); //end service
 
 
 //the name of the service need to be added in the parameters of the controller function
 application.controller('app',function($scope,random){
	 $scope.generateRandom = function(){
		 
		 //call the service
		 $scope.randomNumber = random.generate();
		 $scope.randomNumber2 = random.generate();
		 
	 }; //end function
	 
	 
 }); // end controller
 

 
 
 