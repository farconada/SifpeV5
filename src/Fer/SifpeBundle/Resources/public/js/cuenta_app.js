/**
 * Created with JetBrains PhpStorm.
 * User: fernando
 * Date: 5/08/13
 * Time: 8:28
 * To change this template use File | Settings | File Templates.
 */
var config_module = angular.module('sifpeApp.config', []);
angular.forEach(config_data,function(key,value) {
    config_module.constant(value,key);
});

/**
 * Modulo de AngularJS
 * Se define la ruts /list por defecto
 * @type {*}
 */
var sifpeApp = angular.module('sifpeApp', ['sifpeApp.config','options-proxy', 'highcharts-ng']).config(function($routeProvider, $interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
    $routeProvider.
        when("/list", {controller: 'CuentaCtrl', templateUrl: "/bundles/fersifpe/templates/cuenta_list.html"}).
        otherwise({redirectTo: "/list"});
});

/**
 * controlador principal
 */
sifpeApp.controller('CuentaCtrl', ['$scope', '$rootScope', '$http', 'GENERAL_CONFIG', function($scope, $rootScope, $http, GENERAL_CONFIG){
    $scope.cuentaEditar = null;
    $scope.cuentaNueva = {'grupo': {'id': 0, 'name': ''}};
    $scope.grupos = [];
    $scope.cuentas = [];


    //funcion para cargar las cuentas de un mes desde el mes actual - mesDesde meses
    $scope.list = function() {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.ENTITY_TIPO + '_list');
        $http.get(url).success(function(data){
            $scope.cuentas = data;
        });
    }

    // carga inicial, lista de gastos
    $scope.list();

    // carga inicial, lista de grupos
    $http.get(Routing.generate('fer_sifpe_grupocuenta_list')).success(function(data){
        $scope.grupos = data;
    });


    // ventana modal para editar una cuenta
    $scope.edit = function(cuentaIndex) {
        $scope.cuentaEditar = $scope.cuentas[cuentaIndex];
        $('#modalEdit').modal();
    };

    // borrar una cuenta
    $scope.delete = function(cuentaIndex) {
        var cuentaABorrar = $scope.cuentas[cuentaIndex];
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.ENTITY_TIPO + '_delete', { id: cuentaABorrar.id });
        $http.get(url).success(function(data){
            $scope.cuentas.splice(cuentaIndex, 1);
        });
    }

    // guardar una cuenta
    $scope.save = function(cuenta) {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.ENTITY_TIPO + '_save');
        $http.post(url, cuenta).success(function(data){
            // recargamos desde el servidor para estar seguros de que esta bien guardado
            $scope.list();
        });
    };

    // guarda e inicializa un apunte nuevo
    $scope.add = function(cuenta) {
        $scope.save(cuenta);
        if ($scope.cuenta_form_new.$valid) {
            $scope.cuentaNueva = {'grupo': {'id': 0, 'name': ''}};
        }
    };

}]);

