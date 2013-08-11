/**
 * Created with JetBrains PhpStorm.
 * User: fernando
 * Date: 5/08/13
 * Time: 8:28
 * To change this template use File | Settings | File Templates.
 */
var config_data = {
    'GENERAL_CONFIG': {
        'APUNTE_TIPO': 'gasto'
    }
};
var config_module = angular.module('sifpeApp.config', []);
angular.forEach(config_data,function(key,value) {
    config_module.constant(value,key);
});

var sifpeApp = angular.module('sifpeApp', ['sifpeApp.config','options-proxy']).config(function($routeProvider, $interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
    $routeProvider.
        when("/list", {controller: 'ApunteCtrl', templateUrl: "/bundles/fersifpe/templates/apunte_list.html"}).
        otherwise({redirectTo: "/list"});
});

sifpeApp.controller('ApunteCtrl', ['$scope', '$rootScope', '$http', 'GENERAL_CONFIG', function($scope, $rootScope, $http, GENERAL_CONFIG){
    $scope.apunteEditar = null;
    $scope.apunteNuevo = {'cuenta': {'id': 0, 'name': ''}, 'empresa': {'id': 0, 'name': ''}};
    $scope.cuentas = null;
    $scope.empresas = null;
    $scope.mesDesde = 0;
    $scope.ultimoMes = 0;

    //Carga los apuntes de un mes desde el mes actiual - mesDesde meses
    $scope.list = function(mesDesde) {
        $http.get(GENERAL_CONFIG.APUNTE_TIPO + 's/' + mesDesde).success(function(data){
            $scope.apuntes = data['data'];
            $scope.ultimoMes = data['totalPaginas'];
        });
        if (mesDesde <= 0) {
            $scope.mesDesde = 0;
        } else {
            $scope.mesDesde = mesDesde;
        }
    }

    // carga inicial, lista de gastos
    $scope.list($scope.mesDesde);


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

    // borrar un apunte
    $scope.delete = function(apunteIndex) {
        var apunteABorrar = $scope.apuntes[apunteIndex];
        $http.get(GENERAL_CONFIG.APUNTE_TIPO + '/' + apunteABorrar.id + '/borrar').success(function(data){
            $scope.apuntes.splice(apunteIndex, 1);
        });
    }

    // guardar un apunte
    $scope.save = function(apunte) {
        $http.post(GENERAL_CONFIG.APUNTE_TIPO, apunte).success(function(data){
            // recargamos desde el servidor para estar seguros de que esta bien guardado
            $scope.list($scope.mesDesde);
        });
    };

    // guarda e inicializa un apunte nuevo
    $scope.add = function(apunte) {
        $scope.save(apunte);
        if ($scope.apunte_form_new.$valid) {
            $scope.apunteNuevo = {'cuenta': {'id': 0, 'name': ''}, 'empresa': {'id': 0, 'name': ''}};
        }
    }

}]);

