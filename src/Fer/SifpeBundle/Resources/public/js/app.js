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
    $scope.mesDesde = 0;  // meses de el mes actual o numero página (para paginacion)
    $scope.ultimoMes = 0; //numero maximo de meses o total de paginas almacenadas (para paginacion)
    $scope.apuntes = [];
    $scope.anios = [];
    d = new Date();
    for (i=2006; i<= d.getFullYear(); i++) {
        $scope.anios.push(i);
    }

    $scope.chart_anio = {'anio1': d.getFullYear()-1, 'anio2': d.getFullYear()};

    $scope.chartAnioConfig = {
        options: {
            chart: {
                type: 'area'
            }
        },
        xAxis: {
            categories: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']
        },
        series: [
            {'data': [0,0,0,0,0,0,0,0,0,0,0,0]}
        ],
        title: {
            text: 'Apuntes'
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

    // actualiza el grafico de resumen anual
    // añade la serie de un año
    $scope.chartAnio = function(anio) {
        $http.get(anio + '/' +GENERAL_CONFIG.APUNTE_TIPO + 's/resumen').success(function(data){
            var cantidades = [];
            $.each(data['data'], function(index, value) {
                cantidades.push(parseFloat(value.cantidad));
            });
            $scope.chartAnioConfig.series.push({'name': 'Año ' + anio , data: cantidades});
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

    // mira cada vez que se cambia un año para actualizar el grafico
    $scope.$watch('chart_anio', function(chart_anio) {
        $scope.chartAnioConfig.series = [];
        $scope.chartAnioConfig.title.text = GENERAL_CONFIG.APUNTE_TIPO;
        $scope.chartAnio(chart_anio.anio1);
        $scope.chartAnio(chart_anio.anio2);
    }, true);


}]);

