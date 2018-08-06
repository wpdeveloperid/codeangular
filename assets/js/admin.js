var app = angular.module("adminApp", ["ngRoute", 'ui.tinymce', 'ngFileUpload']);
app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
        .when('/', {
            templateUrl: baseUrl + "template/dashboard"
        })
        .when('/product', {
            templateUrl: baseUrl + "template/manageproduct",
            controller: "productCtrl"
        })
        .when('/product/:action/:id?', {
            templateUrl: baseUrl + "template/productform",
            controller: 'productFormCtrl'
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
                    data.items[i].last_modified_at = Date.parse(data.items[i].last_modified_at);
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
    $scope.delete = function (el) {
        var xhr = {
            method: 'GET',
            url: baseUrl + "product/delete",
            params: {
                id: el.item.id
            }
        }
        $http(xhr).then(function (response) {
            var data = response.data;
            if (data.status) {
                $scope.productFilter();
            } else {
                alert(data.message);
            }
        })
    }
    $scope.productFilter();
})
app.controller("productFormCtrl", function ($scope, Upload, $http, $routeParams) {
    $scope.hideAlert = true;
    var params = $routeParams;
    $scope.id = params.id;
    $scope.action = params.action;
    //console.log(params);
    if ($scope.action == 'edit') {
        var xhr = {
            method: 'GET',
            url: baseUrl + "product/detail/",
            params: {
                id: $scope.id
            }
        }
        $http(xhr).then(function (response) {
            var data = response.data;
            $scope.name = data[0].name;
            $scope.price = data[0].price;
            $scope.description = data[0].description;
        })
    }
    $scope.tinymceOptions = {
        plugins: 'link code',
        toolbar: 'newdocument, bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, styleselect, formatselect, fontselect, fontsizeselect, cut, copy, paste, bullist, numlist, outdent, indent, blockquote, undo, redo, removeformat, link, subscript, superscript, code',
        menubar: false
    };
    $scope.storeupdate = function (file) {
        //console.log([$scope.id, $scope.name, $scope.price, $scope.description, $scope.action]);
        Upload.upload({
            url: baseUrl + 'product/storeupdate',
            data: {
                action: $scope.action,
                id: $scope.id,
                image: file,
                name: $scope.name,
                price: $scope.price,
                description: $scope.description
            }
        }).then(function (response) {
            var data = response.data;
            if (data.status) {
                if ($scope.action == 'add') {
                    window.history.back();
                } else {
                    $scope.hideAlert = false;
                    $scope.alertType = 'success';
                    $scope.message = data.message;
                }
            } else {
                $scope.hideAlert = false;
                $scope.alertType = 'danger';
                $scope.message = data.message;
            }
        })
    }
});