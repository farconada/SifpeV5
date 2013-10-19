Feature: Muestras los ingresos de un mes, el resumen y permite buscar

  Scenario: Puedo ver los datos de este mes
    Given I am on "/ingresos/0"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data" should have 6 elements
    And the JSON node "totalPaginas" should be equal to "1"

  Scenario: Puedo ver los datos del mes anterior
    Given I am on "/ingresos/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data" should have 4 elements

  Scenario: El total de ingresos de la cuenta es de 6000
    Given I am on a URL like "/cuentas/ingresos/{esteAnio}/{esteMes}"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data" should have 1 elements
    And the JSON node "data[0].cantidad" should be equal to "6000.00"

  Scenario: El total de gastos de este mes es 4500 y el del anterior 2000
    Given I am on a URL like "/{esteAnio}/ingresos/resumen"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data" should have 2 elements
    And the JSON node "data[0].cantidad" should be equal to "4000.00"
    And the JSON node "data[1].cantidad" should be equal to "6000.00"

#  Scenario: El buscador encuentra cosas por las notas
#    Given I am on a URL like "/gastos/buscar/{esteAnio}-{esteMes}-1/{esteAnio}-{esteMes}-30/un%20texto%20especial"
#    Then the response status code should be 200
#    And the response should be in JSON
#    And the JSON node "root" should have 3 elements