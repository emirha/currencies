'use strict';

(function(angular) {
    var app = angular.module('MessageSystem', ['ngSanitize']);
    app.controller('MessageController', ['$http',function($http) {
        var ctrl = this;

        this.messages = [];
        this.topSold = [];
        this.topBought = [];
        this.topCountries = [];

        var loadMessages = function () {
            $http.get('/message/getmessages').success(function(data){
                ctrl.messages = data;
            });
        };

        var loadTopCurrencies = function () {
            $http.get('/message/gettops').success(function(data){
                ctrl.topSold = data.topSold;
                ctrl.topBought = data.topBought;
                ctrl.topCountries = data.topCountries;
            });
        };

        //First load messages than check each 2 seconds if there are new messages added
        loadMessages();
        setInterval(loadMessages, 2000);

        //First load topSold than check each 4 seconds if there are changes
        loadTopCurrencies();
        setInterval(loadTopCurrencies, 4000);

    }]);

})(window.angular);