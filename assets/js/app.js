var app = angular.module("productApp", []);
app.controller("headCtrl", function($scope, $http) {
$http.get(baseUrl+"/product/head/")
    .then(function(response) {
		$scope.title = response.data[0].value;
		$scope.description = response.data[1].value;
    });
});
app.controller("listCtrl", function($scope, $http) {
$scope.items = [{name:"Product Name",price:123,src:imgFolder+"defaultsquare.jpg"}];
$http.get(baseUrl+"/product/list/")
    .then(function(response) {
		var items = response.data;

		for(var i=0;i<items.length;i++){
			items[i].created_at = Date.parse(items[i].created_at);
		}
				
		$scope.items = items;
		
    });

});
