/**
 * Controller71.js for index22.html
 */
 

 
 var app = angular.module('mainApp',[]); // 
 
app.controller('app',function($scope){
	$scope.myRandomNumber = Math.random();
	//$scope.digest() is required when angular links with the plain javascript like below:
	
	document.querySelector('input').addEventListener('click',function(){
		//being this function not part of angular, if left untreated the new number will not update because the digest cycle is not triggered
		//to fix, ad the $scope.$digest() call in the fucntion
		
		console.log('clicked');
		$scope.myRandomNumber = Math.random();
		$scope.$digest();
		
	},false);
}); //end controller

 
 
 