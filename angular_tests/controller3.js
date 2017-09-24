/**
 * Controller3.js for index13.html
 */
 
 var app = angular.module('mainApp',['ngRoute']); // includes ngRoute method
 
 app.config(['$routeProvider',function($routeProvider){
	 $routeProvider.when('/',{
		 templateUrl: 'login.html'

		 
	 })
	 
	 //conditional routing
	 .when('/dashboard',{
		 templateUrl: 'dashboard.html'
		 
		 
	 })
	 .when('',{
		 
		 
	 })
	 /*
	 */
	 .otherwise({
		 redirectTo:'/'
		 
	 }); //end when/otherwise
	 
 }]); //end app config
 
app.controller('loginCtrl',function($scope,$location){
	$scope.submit = function(){
		var uname = $scope.username;
		var password = $scope.password;
		
		if($scope.username == 'admin' && $scope.password == 'admin'){
			
			$location.path ('/dashboard');
			//location help to change the hash values
		} else {
			alert('whoops!');
		}
		} //end if
		
	} //end function
	
}); //end controller
 
 
 