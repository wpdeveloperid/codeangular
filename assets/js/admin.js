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
        })
        .when('/password', {
            templateUrl: baseUrl + "template/password",
            controller: "passCtrl"
        });
    $locationProvider.html5Mode(true);
})
app.controller("productCtrl", function ($scope, $http) {
    function ajaxDel(id) {
        var xhr = {
            method: 'GET',
            url: baseUrl + "product/delete",
            params: {
                id: id
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
    $scope.toPage = function (el) {
        $scope.page = el.pageIndex;
        $scope.productFilter();
        $scope.page = null;
        $scope.allSelected = false;
        selected = [];
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
                //console.log($scope.pages);
            }
        });
    }
    $scope.delete = function (el) {
        var id = el.item.id;
        ajaxDel(id);
    }
    $scope.select = function (el) {
        if (el.selected) {
            selected.push(el.item.id);
        } else {
            var index = selected.indexOf(el.item.id);
            selected.splice(index, 1);
        }
        //console.log(selected);
    }
    $scope.selectAll = function () {
        if ($scope.allSelected) {
            selected = $scope.items.map(x => x.id);
        } else {
            selected = [];
        }
        //console.log(selected);
    }
    $scope.bulkDelete = function () {
        for (var i = 0; i < selected.length; i++) {
            var id = selected[i];
            ajaxDel(id);
        }
        //console.log(selected);
    }
    var selected = [];
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
            $scope.src = data[0].src;
        })
    }
    $scope.tinymceOptions = {
        plugins: 'link code',
        toolbar: 'newdocument, bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, styleselect, formatselect, fontselect, fontsizeselect, cut, copy, paste, bullist, numlist, outdent, indent, blockquote, undo, redo, removeformat, link, subscript, superscript, code',
        menubar: false
    };
    $scope.storeupdate = function (file) {
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
                    $scope.src = data.src;
                    $scope.image = null;
                }
            } else {
                $scope.hideAlert = false;
                $scope.alertType = 'danger';
                $scope.message = data.message;
            }
        })
    }
});
app.controller("passCtrl", function ($scope, $http, $httpParamSerializerJQLike) {
    function reset() {
        $scope.oldpassword = $scope.newpassword = $scope.confirmpassword = null;
    }
    $scope.hideAlert = true;
    $scope.change = function () {
        var xhr = {
            method: 'POST',
            url: baseUrl + 'admin/changepassword',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            data: $httpParamSerializerJQLike({
                oldpass: $scope.oldpassword,
                newpass: $scope.newpassword,
                confpass: $scope.confirmpassword
            })
        }
        $http(xhr).then(function (response) {
            var data = response.data;
            if (data.status) {
                //console.log(response);
                $scope.alertType = 'success';
                reset()
            } else {
                $scope.alertType = 'danger';
            }
            $scope.message = data.message;
            $scope.hideAlert = false;
        })
    }
    $scope.reset = function () {
        reset();
    }
})