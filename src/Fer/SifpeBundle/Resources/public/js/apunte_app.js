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
        when("/list", {controller: 'ApunteCtrl', templateUrl: "/bundles/fersifpe/templates/apunte_list.html"}).
        otherwise({redirectTo: "/list"});
});

/**
 * controlador principal
 */
sifpeApp.controller('ApunteCtrl', ['$scope', '$rootScope', '$http', 'GENERAL_CONFIG', function($scope, $rootScope, $http, GENERAL_CONFIG){
    $scope.apunteSearch = {'query': '', 'dateIni': '2006-01-01', 'dateEnd': moment().endOf('month').format('YYYY-MM-DD')};
    $scope.apunteEditar = null;
    $scope.apunteNuevo = {'cuenta': {'id': 0, 'name': ''}, 'empresa': {'id': 0, 'name': ''}};
    $scope.cuentas = [];
    $scope.empresas = [];
    $scope.mesDesde = 0;  // meses de el mes actual o numero página (para paginacion)
    $scope.ultimoMes = 0; //numero maximo de meses o total de paginas almacenadas (para paginacion)
    $scope.apuntes = [];
    $scope.anios = [];
    $scope.totalMes = 0;
    $scope.presupuestos = [];

    moment.lang('es');
    $('#searchrange').daterangepicker(
        {
            ranges: {
                'Este mes': [moment().startOf('month'), moment().endOf('month')],
                'Desde hace 3 meses': [moment().subtract('month', 3).startOf('month'), moment().endOf('month')],
                'Desde hace 6 meses': [moment().subtract('month', 6).startOf('month'), moment().endOf('month')]
            },
            startDate: moment().subtract('days', 29),
            endDate: moment()
        },
        function(start, end) {
            $('#searchrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $scope.apunteSearch.dateIni = start.format('YYYY-MM-DD');
            $scope.apunteSearch.dateEnd = end.format('YYYY-MM-DD');
        }
    );

    /**
     * listado de años posibles, para los combos
     * Empieza en 2006 que es cuando comienzan los datos
     * @type {Date}
     */
    d = new Date();
    for (i=2006; i<= d.getFullYear(); i++) {
        $scope.anios.push(i);
    }

    /**
     * Grafico del anual, por defecto este año vs año pasado
     * @type {{anio1: number, anio2: number}}
     */
    $scope.chart_anio = {'anio1': d.getFullYear()-1, 'anio2': d.getFullYear()};

    /**
     * Grafico de mes desglosado, por defecto este mes vs el mes anterior
     * @type {{anio1: number, mes1: number, anio2: number, mes2: number}}
     */
    $scope.chart_mes = {'anio1': d.getFullYear(), 'mes1': d.getMonth()+1, 'anio2': d.getFullYear()-1, 'mes2': d.getMonth()+1};

    /**
     * config del grafico anual
     * @type {{options: {chart: {type: string}}, xAxis: {categories: Array}, series: Array, title: {text: string}, loading: boolean}}
     */
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

    /**
     * config del grafico mensual
     * @type {{options: {chart: {type: string}}, xAxis: {categories: Array}, series: Array, title: {text: string}, loading: boolean}}
     */
    $scope.chartMesConfig = {
        options: {
            chart: {
                type: 'column'
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

    //Carga los apuntes de un mes desde el mes actual - mesDesde meses
    $scope.list = function(mesDesde) {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.APUNTE_TIPO + '_list', { desdeMeses: mesDesde });
        $http.get(url).success(function(data){
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
    $http.get(Routing.generate('fer_sifpe_empresa_list')).success(function(data){
        $scope.empresas = data;
    });

    // carga inicial, lista de cuentas
    $http.get(Routing.generate('fer_sifpe_cuenta_list')).success(function(data){
        $scope.cuentas = data;
    });

    // actualiza el grafico de resumen anual
    // añade la serie de un año
    $scope.chartAnio = function(anio) {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.APUNTE_TIPO + '_xanio', { anio: anio });
        $http.get(url).success(function(data){
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
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.APUNTE_TIPO + '_delete', { id: apunteABorrar.id });
        $http.get(url).success(function(data){
            $scope.apuntes.splice(apunteIndex, 1);
        });
    }

    // guardar un apunte
    $scope.save = function(apunte) {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.APUNTE_TIPO + '_save');
        $http.post(url, apunte).success(function(data){
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

    // busqueda de apuntes
    $scope.search = function(queryString) {
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.APUNTE_TIPO + '_search', { query: queryString, dateIni: $scope.apunteSearch.dateIni, dateEnd: $scope.apunteSearch.dateEnd });
        $http.get(url).success(function(data){
            $scope.apuntes = data;
            $scope.ultimoMes = 0;
        });
    }

    // mira cada vez que se cambia un año para actualizar el grafico anual
    $scope.$watch('chart_anio', function(chart_anio) {
        $scope.chartAnioConfig.series = [];
        $scope.chartAnioConfig.title.text = GENERAL_CONFIG.APUNTE_TIPO;
        $scope.chartAnio(chart_anio.anio1);
        $scope.chartAnio(chart_anio.anio2);
    }, true);

    // total de este mes
    $scope.$watch('apuntes', function(apuntes){
        $scope.totalMes = 0;
        $.each($scope.apuntes, function(index, value){
            $scope.totalMes += value.cantidad;
        });
        $scope.totalMes = parseFloat($scope.totalMes);

        // recalcular los presupuestos
        if ($scope.apuntes.length != 0) {
            var fecha = new Date($scope.apuntes[0].fecha);
            var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.APUNTE_TIPO + '_presupuesto', { anio: fecha.getFullYear(), mes: (fecha.getMonth()+1) });
            $http.get(url).success(function(data){
                $scope.presupuestos = data['data'];
            });
        }

    }, true);

    // mira cada vez que se cambia un año o un mes para actualizar el mensual desglosado
    $scope.$watch('chart_mes', function(chart_mes){
        var res = {};
        var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.APUNTE_TIPO + '_xcuenta', { anio: chart_mes.anio1, mes: chart_mes.mes1 });
        $http.get(url).success(function(data){
            $.each(data['data'], function(index, cuenta){
                if (res[cuenta['cuenta']] == undefined) {
                    res[cuenta['cuenta']] = {};
                }
                res[cuenta['cuenta']]['mes1'] = parseFloat(cuenta['cantidad']);
            });
            var url = Routing.generate('fer_sifpe_' + GENERAL_CONFIG.APUNTE_TIPO + '_xcuenta', { anio: chart_mes.anio2, mes: chart_mes.mes2 });
            $http.get(url).success(function(data){
                $.each(data['data'], function(index, cuenta){
                    if (res[cuenta['cuenta']] == undefined) {
                        res[cuenta['cuenta']] = {};
                    }
                    res[cuenta['cuenta']]['mes2'] = parseFloat(cuenta['cantidad']);
                });
                $scope.chartMesConfig.xAxis.categories = [];
                $scope.chartMesConfig.series = [];
                var valoresMes1 = [];
                var valoresMes2 = [];
                $.each(res, function(index, cuenta){
                    $scope.chartMesConfig.xAxis.categories.push(index);
                    if (cuenta['mes1'] == undefined) {
                        cuenta['mes1'] = 0;
                    }
                    if (cuenta['mes2'] == undefined) {
                        cuenta['mes2'] = 0;
                    }

                    valoresMes1.push(cuenta['mes1']);
                    valoresMes2.push(cuenta['mes2']);
                });
                $scope.chartMesConfig.series.push({'name': chart_mes.anio1 +'-'+chart_mes.mes1, 'data': valoresMes1});
                $scope.chartMesConfig.series.push({'name': chart_mes.anio2 +'-'+chart_mes.mes2, 'data': valoresMes2});
            });
        });
    }, true);

    $scope.necesitaRecortar = function(apunte, presupuestoAnual, presupuestoMensual, consumidoAnual) {
	console.log(apunte, presupuestoAnual, presupuestoMensual, consumidoAnual);
	if (!apunte)
		return false;
	var fechaDate = new Date(apunte.fecha);
	var mesesQuedan = 12 - (fechaDate.getMonth()+1);
	if ((presupuestoAnual-consumidoAnual)/mesesQuedan < presupuestoMensual) {
		return true;
	}
	if (presupuestoMensual) 
		return false;
    };

}]);

