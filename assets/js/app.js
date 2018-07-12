var app = angular.module("productApp", []);
app.controller("headCtrl", function($scope, $http) {
$http.get(baseUrl+"/product/head/")
    .then(function(response) {
		$scope.title = response.data[0].value;
		$scope.description = response.data[1].value;
    });
});
app.controller("listCtrl", function($scope, $http) {
$scope.items = [{name:"Product Name",price:123,image:"joget-400x400"}];
$http.get(baseUrl+"/product/list/")
    .then(function(response) {
		var items = response.data;
		
		for(var i=0;i<items.length;i++){
			if(items[i].image==""){
				items[i].image="joget-400x400";
			} else {
				items[i].image+="resized";
			}
			
		}
		
		$scope.items = items;
		
    });

});
