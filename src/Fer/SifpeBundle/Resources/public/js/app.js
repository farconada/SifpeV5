/**
 * Created with JetBrains PhpStorm.
 * User: fernando
 * Date: 5/08/13
 * Time: 8:28
 * To change this template use File | Settings | File Templates.
 */
var sifpeApp = angular.module('sifpeApp', ['options-proxy']).config(function($routeProvider, $interpolateProvider){
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

    // TODO: quitar referencia a "gasto" y parametrizar para que valga para todo tipo de apunte
    // TODO: poner mes inicial el actual, ahora esta asi para que haya datos
    // carga inicial, lista de gastos
    $http.get('gastos/1').success(function(data){
        $scope.apuntes = data['data'];
    });

    // carga inicial, lista de empresas
    $http.get('empresas').success(function(data){
        $scope.empresas = data;
    });

    // carga inicial, lista de cuentas
    $http.get('cuentas').success(function(data){
        $scope.cuentas = data;
    });

    // ventana modal para editar un apunte
    $scope.edit = function(apunteIndex) {
        $scope.apunteEditar = $scope.apuntes[apunteIndex];
        $('#modalEdit').modal();
    };

    // TODO: quitar referencia a "gasto" y parametrizar para que valga para todo tipo de apunte
    // borrar un apunte
    $scope.delete = function(apunteIndex) {
        var apunteABorrar = $scope.apuntes[apunteIndex];
        $http.get('gasto/' + apunteABorrar.id + '/borrar').success(function(data){
            $scope.apuntes.splice(apunteIndex, 1);
        });
    }

    // TODO: quitar referencia a "gasto" y parametrizar para que valga para todo tipo de apunte
    // guardar un apunte
    $scope.save = function(apunte) {
        $http.post('gasto', apunte).success(function(data){
            $scope.apuntes = data['data'];
        });
    };

}]);

