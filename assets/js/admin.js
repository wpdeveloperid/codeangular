var app = angular.module("adminApp", ["ngRoute", 'ui.tinymce']);
app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
        .when('/', {
            templateUrl: baseUrl + "template/dashboard"
        })
        .when('/product', {
            templateUrl: baseUrl + "template/manageproduct",
            controller: "productCtrl"
        })
        .when('/product/add', {
            templateUrl: baseUrl + "template/addproduct"
        });
    $locationProvider.html5Mode(true);
})
app.controller("productCtrl", function ($scope, $http) {
    $scope.toPage = function (el) {
        $scope.page = el.pageIndex;
        $scope.productFilter();
        $scope.page = null;
    }
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
                $scope.itemsCount = data.items_count;
                $scope.from = (data.page - 1) * 12 + 1;
                $scope.to = Math.min((data.page) * 12, $scope.itemsCount);
                $scope.currentPage = data.page;
                $scope.pagesCount = data.pages_count;
                for (var i = 1; i <= data.pages_count; i++) {
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
    $scope.productFilter();
})
app.controller("addProductCtrl", function ($scope) {
    $scope.tinymceModel = 'Initial content';

    $scope.getContent = function () {
        console.log('Editor content:', $scope.tinymceModel);
    };

    $scope.setContent = function () {
        $scope.tinymceModel = 'Time: ' + (new Date());
    };

    $scope.tinymceOptions = {
        plugins: 'link image code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
    };
});