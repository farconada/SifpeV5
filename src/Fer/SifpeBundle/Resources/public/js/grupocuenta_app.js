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
        when("/list", {controller: 'GrupoCuentaCtrl', templateUrl: "/bundles/fersifpe/templates/grupocuenta_list.html"}).
        otherwise({redirectTo: "/list"});
});

/**
 * controlador principal
 */
sifpeApp.controller('GrupoCuentaCtrl', ['$scope', '$rootScope', '$http', 'GENERAL_CONFIG', function($scope, $rootScope, $http, GENERAL_CONFIG){
    $scope.grupocuentaEditar = null;
    $scope.grupocuentaNueva = {'grupo': {'id': 0, 'name': ''}};
    $scope.grupocuentas = [];


    //funcion para cargar las grupocuentas de un mes desde el mes actual - mesDesde meses
    $scope.list = function() {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.ENTITY_TIPO + '_list');
        $http.get(url).success(function(data){
            $scope.grupocuentas = data;
        });
    }

    // carga inicial, lista de gastos
    $scope.list();



    // ventana modal para editar una grupocuenta
    $scope.edit = function(grupocuentaIndex) {
        $scope.grupocuentaEditar = $scope.grupocuentas[grupocuentaIndex];
        $('#modalEdit').modal();
    };

    // borrar una grupocuenta
    $scope.delete = function(grupocuentaIndex) {
        var grupocuentaABorrar = $scope.grupocuentas[grupocuentaIndex];
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.ENTITY_TIPO + '_delete', { id: grupocuentaABorrar.id });
        $http.get(url).success(function(data){
            $scope.grupocuentas.splice(grupocuentaIndex, 1);
        });
    }

    // guardar una grupocuenta
    $scope.save = function(grupocuenta) {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.ENTITY_TIPO + '_save');
        $http.post(url, grupocuenta).success(function(data){
            // recargamos desde el servidor para estar seguros de que esta bien guardado
            $scope.list();
        });
    };

    // guarda e inicializa un apunte nuevo
    $scope.add = function(grupocuenta) {
        $scope.save(grupocuenta);
        if ($scope.grupocuenta_form_new.$valid) {
            $scope.grupocuentaNueva = {'grupo': {'id': 0, 'name': ''}};
        }
    };

}]);

