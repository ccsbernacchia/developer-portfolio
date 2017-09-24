/**
 * Controller3b.js for index14.html
 */
 
 var app = angular.module('mainApp',['ngRoute']); // includes ngRoute method
 
 app.config(['$routeProvider',function($routeProvider){
	 $routeProvider.when('/',{
		 templateUrl: 'login.html'

		 
	 })
	 
	 //conditional routing - resolve is 
	 .when('/dashboard',{
		 resolve: {
			 "check": function($location, $rootScope){
				 if(!$rootScope.loggedIn){
					 $location.path('/');

						
				 } //end if
			 }
			 
		 }, //end resolve
		templateUrl: 'dashboard.html'
		 
		 
	 })

	 /*
	 */
	 .otherwise({
		 redirectTo:'/'
		 
	 }); //end when/otherwise
	 
 }]); //end app config
 
app.controller('loginCtrl',function($scope,$location,$rootScope){
	$scope.submit = function(){
		/*
		$rootScope.uname = $scope.username; //$rootScope is a global variable accessible by every controller factories 
		$rootScope.password = $scope.password;
		*/
		
		//of course in a REAL place you would use ajax to verify
		if($scope.username == 'admin' && $scope.password == 'admin'){
			$rootScope.loggedIn = true; //autherntication suceeded and put flagh in the superglobal var $rootScope
			$location.path ('/dashboard');
			//location help to change the hash values
		} else {
			alert('whoops!');
		
		} //end if
		
	} //end function
	
}); //end controller
 
 
 