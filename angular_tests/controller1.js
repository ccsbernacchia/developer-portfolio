/**
 * Controller.js for index11.html
 */
 
 var app = angular.module('mainApp',['ngRoute']); // includes ngRoute method
 
 app.config(['$routeProvider',function($routeProvider){
	 //configure the route
	 $routeProvider.when('/',{
		 template: 'Welcome to you!'

	 })
	 .when('/anotherPage',{
		 template: 'Welcome Aghen'
 
	 })
	 .otherwise({
		redirectTo: '/' // will dredirect to home when not recognized 
		 
	 });
	 
	 
 }]);
 