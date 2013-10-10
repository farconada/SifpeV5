Feature: Ser capaz de gestionar la entidad Cuenta
  Crear, borrar, modificar, listar todas las entidades cuenta

  Scenario: La URL para gestionar la entidad existe
    When I go to "/cuentas/gestion"
    Then the response status code should be 200

  Scenario: se puede recuperar el listado de cuentas
    When I send a GET request on "/cuentas"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And the JSON node "root" should have 3 elements

  Scenario: se puede borrar una cuenta
    Given I am on "/cuenta"
    And the JSON node "root" should have 3 elements
    When I send a GET request on "/cuenta/1/borrar/"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And I go to "/cuentas"
    And the JSON node "root" should have 2 elements

  Scenario: se puede borrar una cuenta via HTTP DELETE
    Given I am on "/cuentas"
    And the JSON node "root" should have 3 elements
    When I send a DELETE request on "/cuenta/2"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And I go to "/cuentas"
    And the JSON node "root" should have 2 elements


  Scenario: puedo visualizar una cuenta en JSON
    When I send a GET request on "/cuenta/3"
    Then the response status code should be 200
    And the response should be in JSON

  Scenario: puedo crear una nueva cuenta
    When I add "CONTENT_TYPE" header equal to "application/json"
    And I send a POST request on "/cuenta" with body:
      """
      {"name": "mi empresa"}
      """
    Then the response status code should be 200
    And I go to "/cuentas"
    And the JSON node "root" should have 4 elements

  Scenario: puedo actualizar una cuenta
    When I add "CONTENT_TYPE" header equal to "application/json"
    And I send a POST request on "/cuentas" with body:
      """
      {"id": "3", "name": "nuevo nombre"}
      """
    Then the response status code should be 200
    And I go to "/cuenta/3"
    And the JSON node "root.name" should be equal to "nuevo nombre"

