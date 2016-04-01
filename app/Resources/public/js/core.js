var app = angular.module('siiApp', [
    'ngResource',
    'ngAnimate'
]);

app.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('{[').endSymbol(']}');
}]);

