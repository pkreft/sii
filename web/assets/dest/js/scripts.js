var app = angular.module('siiApp', [
    'ngResource',
    'ngAnimate'
]);

app.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('{[').endSymbol(']}');
}]);


app.controller('NewsListCtrl', [
    '$scope',
    '$resource',
    '$interval',
    function ($scope, $resource, $interval) {
        var NewsApi = $resource(Routing.generate('news_fetch'));
        $scope.news = [];
        $scope.importance = false;

        NewsApi.get(function (data) {
            $scope.lastUpdate = data.dateTime;
            $scope.news = data.items;
        });

        /**
         * @method checkForUpdates
         * @returns {undefined}
         */
        $scope.checkForUpdates = function() {
            NewsApi.get({ lastDateTime : $scope.lastUpdate }, function(data) {
                $scope.lastUpdate = data.dateTime;

                if (data.changed === true){
                    angular.forEach(data.items,function(val, key){
                        $scope.news.unshift(data.items[key]);
                    });
                }
            });
        };

        /**
         * @method details
         * @param {Object} news
         */
        this.details = function(news) {
            return Routing.generate('news_details',{ href: news.href });
        };

        /**
         * @method displayImportant
         * @param boolean bool
         */
        $scope.displayImportant = function(bool) {
            $scope.importance = bool;
        };

        $interval($scope.checkForUpdates, 15000);
    }]);