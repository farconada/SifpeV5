/**
 * Created with JetBrains PhpStorm.
 * User: fernando
 * Date: 20/10/13
 * Time: 12:12
 * To change this template use File | Settings | File Templates.
 */
describe('sifpeApp', function(){
    var controller, scope, rootScope, http, GENERAL_CONFIG;//we'll use this scope in our tests
    var module;
    beforeEach(function() {
        module = angular.module("sifpeApp");
        inject(function($rootScope, $controller, $http){
            scope = $rootScope.$new();
            controller = $controller;
            http = $http;
            $controller('ApunteCtrl', {
                $scope: scope,
                $http: $http
            });
        });
    });

    it("should be registered", function() {
        expect(module).not.toBeNull();
    });

});
