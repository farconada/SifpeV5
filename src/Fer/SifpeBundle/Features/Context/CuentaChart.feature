Feature: Puedo recuperar informacion estadistica sobre las cuentas, por ejemplo total de una cuenta por mes en un rango

  Scenario: Puedo ver el total de una cuenta en un rango de fechas agrupado por meses
    When I am on a URL like "/cuenta/1/total-por-mes/{hoy-1mes}/{hoy}"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node "root" should have 1 elements