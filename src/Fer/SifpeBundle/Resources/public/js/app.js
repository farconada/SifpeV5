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

var sifpeApp = angular.module('sifpeApp', ['sifpeApp.config','options-proxy', 'highcharts-ng']).config(function($routeProvider, $interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
    $routeProvider.
        when("/list", {controller: 'ApunteCtrl', templateUrl: "/bundles/fersifpe/templates/apunte_list.html"}).
        otherwise({redirectTo: "/list"});
});

sifpeApp.controller('ApunteCtrl', ['$scope', '$rootScope', '$http', 'GENERAL_CONFIG', function($scope, $rootScope, $http, GENERAL_CONFIG){
    $scope.apunteEditar = null;
    $scope.apunteNuevo = {'cuenta': {'id': 0, 'name': ''}, 'empresa': {'id': 0, 'name': ''}};
    $scope.cuentas = [];
    $scope.empresas = [];
    $scope.mesDesde = 0;
    $scope.ultimoMes = 0;
    $scope.apuntes = [];
    var aniosAtras = 0;

    $scope.chartAnioConfig = {
        options: {
            chart: {
                type: 'area'
            },
            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#FFF'],
                            [1, '#333']
                        ]
                    },
                    borderWidth: 0,
                    outerRadius: '109%'
                }, {
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#333'],
                            [1, '#FFF']
                        ]
                    },
                    borderWidth: 1,
                    outerRadius: '107%'
                }, {
                    // default background
                }, {
                    backgroundColor: '#DDD',
                    borderWidth: 0,
                    outerRadius: '105%',
                    innerRadius: '103%'
                }]
            }
        },
        xAxis: {
            categories: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']
        },
        series: [],
        title: {
            text: 'Gastos'
        },

        loading: false
    };

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

    // actualiza el grafico del año
    $scope.chartAnio = function(aniosAtras) {
        $scope.chartAnioConfig.series = [];
        $http.get(GENERAL_CONFIG.APUNTE_TIPO + 's/pormes/' + aniosAtras).success(function(data){
            var cantidad_este_mes = [];
            var cantidad_mes_anterior = [];
            $.each(data, function(index, value) {
                cantidad_este_mes.push(value.cantidad);
                cantidad_mes_anterior.push(value.cantidad_anterior);
            });
            d = new Date();
            d.setMonth(d.getMonth() - $scope.mesDesde);
            $scope.chartAnioConfig.series.push({'name': 'Año ' + (d.getFullYear()-1) , data: cantidad_mes_anterior});
            $scope.chartAnioConfig.series.push({'name': 'Año ' + d.getFullYear(), data: cantidad_este_mes});
        });
    };

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
    };

    $scope.$watch('mesDesde', function(mesDesde) {
        var dActual = new Date();
        var dFinal = new Date();
        dFinal.setMonth(dFinal.getMonth() - mesDesde);
        aniosAtras = dActual.getFullYear() - dFinal.getFullYear();
        $scope.chartAnio(aniosAtras);
    }, true);


}]);

