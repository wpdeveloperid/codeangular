var app = angular.module("productApp", ["ngRoute", "ngSanitize"]);
app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
        .when("/", {
            templateUrl: baseUrl + "template/productlist/",
            controller: "listCtrl"
        })
        .when("/detail/:productId/", {
            templateUrl: baseUrl + "template/productdetail/",
            controller: "detailCtrl"
        });
    $locationProvider.html5Mode(true);
});
app.controller("headCtrl", function ($scope, $http) {
    $http.get(baseUrl + "product/head/").then(function (response) {
        $scope.title = response.data[0].value;
        $scope.description = response.data[1].value;
    });
});
app.directive('ngLazy', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            element.bind('load', function () {
                //scope.$apply(attrs.ngLazy);
                element.removeClass('ng-hide');
                element.next().addClass('ng-hide');
            });
            element.bind('error', function () {
                alert('image could not be loaded');
            });
        }
    };
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
    $scope.orderBy = init.orderBy;
    $scope.showAlert = init.showAlert;
    $scope.productFilter = function () {
        $scope.showSpinner = true;
        $scope.showImage = false;
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
            var data = response.data;
            $scope.pages = [];
            if (data.items) {
                for (var i = 0; i < data.items.length; i++) {
                    data.items[i].created_at = Date.parse(data.items[i].created_at);
                }
                $scope.items = data.items;
                //$scope.showSpinner = false;
                //$scope.showImage = true;
                $scope.message = '';
                $scope.showAlert = false;
                $scope.itemsCount = data.items_count;
                $scope.from = (data.page - 1) * 12 + 1;
                $scope.to = Math.min((data.page) * 12, $scope.itemsCount);
                for (var i = 1; i <= data.pages_count; i++) {
                    $scope.pages.push(i);
                }
                //console.log(data);
            } else {
                $scope.message = data.message;
                $scope.items = [];
                $scope.showAlert = true;
                //console.log($scope.pages);
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
    $scope.rePlace = function (el) {
        console.log(el);
    }
    $scope.wew = function () {
        $scope.showSpinner = false;
        $scope.showImage = true;
    }
    $scope.items = init.items;
    $scope.productFilter();
});
app.controller("detailCtrl", function ($scope, $routeParams, $http) {
    $scope.showSpinner = true;
    $scope.showImage = false;
    var xhr = {
        method: 'GET',
        url: baseUrl + "product/detail/",
        params: {
            id: $routeParams.productId
        }
    }
    $http(xhr).then(function (response) {
        var data = response.data;
        $scope.item = data[0];
        //console.log(data);
    })
});

var appLogin = angular.module("loginApp", []);
appLogin.controller("loginCtrl", function ($scope, $http, $httpParamSerializerJQLike) {
    $scope.hideAlert = true;
    $scope.login = function () {
        var xhr = {
            method: 'POST',
            url: baseUrl + "login/action/",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            data: $httpParamSerializerJQLike({
                username: $scope.username,
                password: $scope.password
            })
        }
        $http(xhr).then(function (response) {
            var data = response.data;
            $scope.hideAlert = data.logged_in;
            $scope.message = data.message;
            if (data.logged_in) {
                window.location = baseUrl + "admin";
            }
        });
    }
    $scope.reset = function () {
        $scope.username = $scope.password = null;
    }
});