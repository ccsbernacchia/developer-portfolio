/**
 * Controller9.js for index24.html
 */
 

 var application = angular.module('mainApp',[]);
 
 
//create a factory


 application.factory('random',function(){

 //instead of using this. like in services, factories create a new object
 
	var randomObject = {};
	
	 var num =  Math.floor(Math.random()*10);

//compared to the service, where the property was related to this, in the factory the properties are attributed to the created empty object
	 
	 randomObject.generate = function(){
		 
		 return num;
		 
	 }; //end function
	 
//and at the end return the object itself
	return randomObject;
	 
	 
 }); //end factory
 
 
 //the name of the service need to be added in the parameters of the controller function
 application.controller('app',function($scope,random){
	 $scope.generateRandom = function(){
		 
		 //call the service
		 $scope.randomNumber = random.generate();
		 $scope.randomNumber2 = random.generate();
		 
	 }; //end function
	 
	 
 }); // end controller
 

 
 
 