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
        when("/list", {controller: 'EmpresaCtrl', templateUrl: "/bundles/fersifpe/templates/empresa_list.html"}).
        otherwise({redirectTo: "/list"});
});

/**
 * controlador principal
 */
sifpeApp.controller('EmpresaCtrl', ['$scope', '$rootScope', '$http', 'GENERAL_CONFIG', function($scope, $rootScope, $http, GENERAL_CONFIG){
    $scope.empresaEditar = null;
    $scope.empresaNueva = {};
    $scope.empresas = [];


    //funcion para cargar las empresas de un mes desde el mes actual - mesDesde meses
    $scope.list = function() {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.ENTITY_TIPO + '_list');
        $http.get(url).success(function(data){
            $scope.empresas = data;
        });
    }

    // carga inicial, lista de gastos
    $scope.list();


    // ventana modal para editar una empresa
    $scope.edit = function(empresaIndex) {
        $scope.empresaEditar = $scope.empresas[empresaIndex];
        $('#modalEdit').modal();
    };

    // borrar una empresa
    $scope.delete = function(empresaIndex) {
        var empresaABorrar = $scope.empresas[empresaIndex];
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.ENTITY_TIPO + '_delete', { id: empresaABorrar.id });
        $http.get(url).success(function(data){
            $scope.empresas.splice(empresaIndex, 1);
        });
    }

    // guardar una empresa
    $scope.save = function(empresa) {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.ENTITY_TIPO + '_save');
        $http.post(url, empresa).success(function(data){
            // recargamos desde el servidor para estar seguros de que esta bien guardado
            $scope.list();
        });
    };

    // guarda e inicializa un apunte nuevo
    $scope.add = function(empresa) {
        $scope.save(empresa);
        if ($scope.empresa_form_new.$valid) {
            $scope.empresaNueva = {};
        }
    };

}]);

