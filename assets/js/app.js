var app = angular.module("productApp", []);
app.controller("headCtrl", function ($scope, $http) {
	$http.get(baseUrl + "product/head/").then(function (response) {
		$scope.title = response.data[0].value;
		$scope.description = response.data[1].value;
	});
});
app.controller("listCtrl", function ($scope, $http) {

	var init = {
		items: [
			{
				name: "Product Name",
				price: 123,
				src: imgFolder + "defaultsquare.jpg"
			}
		],
		orderBy: 'newest',
		showAlert: false
	};
	$scope.items = init.items;
	$scope.orderBy = init.orderBy;
	$scope.showAlert = init.showAlert;
	$http.get(baseUrl + "product/list/").then(function (response) {
		var data = response.data;
		$scope.pages = [];
		if (data.items) {
			for (var i = 0; i < data.items.length; i++) {
				data.items[i].created_at = Date.parse(data.items[i].created_at);
			}
			$scope.items = data.items;
			$scope.message = '';
			$scope.showAlert = false;
			for (var i = 1; i <= data.pagesCount; i++) {
				$scope.pages.push(i);
			}
			console.log(data); console.log($scope.n);
		} else {
			$scope.message = data.message;
			$scope.items = [];
			$scope.showAlert = true;
			console.log($scope.pages);
		}
	});
	$scope.productFilter = function () {
		var xhr = {
			method: 'GET',
			url: baseUrl + "product/list/",
			params: {
				query: $scope.query,
				minprice: $scope.minPrice,
				maxprice: $scope.maxPrice,
				orderby: $scope.orderBy,
				page: $scope.page
			}
		}
		$http(xhr).then(function (response) {
			$scope.status = response.xhrStatus + response.statusText + ' data masuk:' + JSON.stringify(response.data) + JSON.stringify(response.config);
			var data = response.data;
			$scope.pages = [];
			if (data.items) {
				for (var i = 0; i < data.items.length; i++) {
					data.items[i].created_at = Date.parse(data.items[i].created_at);
				}
				$scope.items = data.items;
				$scope.message = '';
				$scope.showAlert = false;
				for (var i = 1; i <= data.pagesCount; i++) {
					$scope.pages.push(i);
				}
				//console.log(data);
			} else {
				$scope.message = data.message;
				$scope.items = [];
				$scope.showAlert = true;
				console.log($scope.pages);
			}
		});
	}
	$scope.reset = function () {
		$scope.query = $scope.minPrice = $scope.maxPrice = null;
		$scope.orderBy = 'newest';
		$scope.productFilter();
	}
	$scope.toPage = function (el) {
		$scope.page = el.pageIndex;
		$scope.productFilter();
		$scope.page = null;
	}
});
