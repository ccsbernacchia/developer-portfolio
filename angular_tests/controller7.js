/**
 * Controller7.js for index21.html
 */
 

 
 var app = angular.module('mainApp',[]); // 
 
app.controller('app',function($scope){
	$scope.counter = -1;
	
	//this function will check the myText textfield
	$scope.$watch('myText',function(newValue,oldValue){
//debug functions		
	//	console.log('new val: ' + newValue);
	//	console.log('old val: ' + oldValue);
		$scope.counter++;
		//this will update counter at every change - included init (so will be 1 at start)
		if($scope.counter == 100){
			alert('Yay!'); // a little reward system
			
		} //end if
	
	});
	
	
}); //end controller

 
 
 