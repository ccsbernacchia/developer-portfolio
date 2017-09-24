/**
 * Controller.js for index12.html
 */
 
 var app = angular.module('mainApp',['ngRoute']); // includes ngRoute method
 
 app.config(['$routeProvider',function($routeProvider){
	 $routeProvider.when('/',{
		 templateUrl: 'content12.html'
		 //note: template and templateUrl do NOT work together: if both template adn templateUrl are present template will get priority and override templateUrl
		 
	 })
	 .when('/helloUser',{
		 templateUrl: 'content12b.html'
		 
		 
	 })
	 /*
	 .when('',{
		 
		 
	 })
	 */
	 .otherwise({
		 redirectTo:'/'
		 
	 });
	 
 }]);
 
 
 /*
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
 */