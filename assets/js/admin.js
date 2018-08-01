var app = angular.module("adminApp", ["ngRoute"]);
app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
        .when('/', {
            templateUrl: baseUrl + "template/dashboard"
        })
        .when('/product', {
            templateUrl: baseUrl + "template/manageproduct"
        });
    $locationProvider.html5Mode(true);
})