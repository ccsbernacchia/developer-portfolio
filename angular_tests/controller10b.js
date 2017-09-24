/**
 * Controller10b.js for index26.html
 */
 
var application = angular.module('mainApp',[]);
 
//lets create our peovider here; a provider have to return something, 
//remember the routing tutorials on $route and $routeProvider


 
application.provider('date',function(){
//creating a provider based on date gives us access to dateProvider in our application.config()	
	return {
		//this will return to the injector - something that happens within our controllers
		$get: function(){
			return {
				//since return is an object we are going to write our return function
				showDate:function(){
					var date = new Date();
					return date.getHours();
				} //end showDate 
				
			} //end return of $get
		} //end $get
		
	} //end return of provider date
	
});// end provider
 
 //this controller uses the date provider
 
 application.controller('app',function($scope,date){
	 $scope.greetMessage = date.showDate();
	 
 });
 
 
 