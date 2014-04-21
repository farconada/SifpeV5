Feature: Muestras los gastos de un mes, el resumen y permite buscar

  Scenario: Puedo ver los datos de este mes
    Given I am on "/gastos/0"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data" should have 6 elements
    And the JSON node "totalPaginas" should be equal to "1"

  Scenario: Puedo ver los gastos del mes anterior
    Given I am on "/gastos/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data" should have 4 elements
    And the JSON node "totalPaginas" should be equal to "1"

  Scenario: El total de gastos de la cuenta 1 de este es de 3000 y de la cuenta2 1500
    Given I am on a URL like "/cuentas/gastos/{esteAnio}/{esteMes}"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data" should have 2 elements
    And the JSON node "data[0].cantidad" should be equal to "3000.00"
    And the JSON node "data[1].cantidad" should be equal to "1500.00"

  Scenario: El total de gastos de este mes es 4500 y el del anterior 2000
    Given I am on a URL like "/{esteAnio}/gastos/resumen"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "data" should have 2 elements
    And the JSON node "data[0].cantidad" should be equal to "2000.00"
    And the JSON node "data[1].cantidad" should be equal to "4500.00"

  Scenario: El buscador encuentra cosas por las notas
    Given I am on a URL like "/gastos/buscar/{esteAnio}-{esteMes}-1/{esteAnio}-{esteMes}-30/un%20texto%20especial"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "root" should have 3 elements