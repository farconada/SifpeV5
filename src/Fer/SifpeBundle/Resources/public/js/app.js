/**
 * Created with JetBrains PhpStorm.
 * User: fernando
 * Date: 5/08/13
 * Time: 8:28
 * To change this template use File | Settings | File Templates.
 */
var sifpeApp = angular.module('sifpeApp', []).config(function($routeProvider, $interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
    $routeProvider.
        when("/list", {controller: 'GastoCtrl', templateUrl: "/bundles/fersifpe/templates/apunte_list.html"}).
        otherwise({redirectTo: "/list"});
});

sifpeApp.controller('GastoCtrl', ['$scope', '$rootScope', '$http', function($scope, $rootScope, $http){
    $scope.apunteEditar = null;
    $scope.apunteNuevo = null;
    $scope.cuentas = null;
    $scope.empresas = null;

    $http.get('app_dev.php/gastos/1').success(function(data){
        $scope.apuntes = data['data'];
    });

    $http.get('app_dev.php/empresas').success(function(data){
        $scope.empresas = data;
    });

    $http.get('app_dev.php/cuentas').success(function(data){
        $scope.cuentas = data;
    });

    $scope.edit = function(apunteIndex) {
        var apunteEditar = $scope.apuntes[apunteIndex];
        $scope.apunteEditar = apunteEditar;
        $('#modalEdit').modal();
    };

    $scope.delete = function(apunteIndex) {
        var apunteABorrar = $scope.apuntes[apunteIndex];
        $http.get('gasto/' + apunteABorrar.id + '/borrar').success(function(data){
            $scope.apuntes.splice(apunteIndex, 1);
        });
    }

    $scope.add = function() {

    };

}]);

