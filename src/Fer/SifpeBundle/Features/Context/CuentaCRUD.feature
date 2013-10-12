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
    And the JSON node "root" should have 20 elements

  Scenario: se puede borrar una cuenta que no tenga elementos en cascada
    Given I am on "/cuentas"
    And the JSON node "root" should have 20 elements
    When I send a GET request on "/cuenta/20/borrar/"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And I go to "/cuentas"
    And the JSON node "root" should have 19 elements

  Scenario: se puede borrar una cuenta via HTTP DELETE que no tenga elementos en cascada
    Given I am on "/cuentas"
    And the JSON node "root" should have 20 elements
    When I send a DELETE request on "/cuenta/20"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And I go to "/cuentas"
    And the JSON node "root" should have 19 elements


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
    And the JSON node "root" should have 21 elements

  Scenario: puedo actualizar una cuenta
    When I add "CONTENT_TYPE" header equal to "application/json"
    And I send a POST request on "/cuenta" with body:
      """
      {"id": "3", "name": "nuevo nombre"}
      """
    Then the response status code should be 200
    And I go to "/cuenta/3"
    And the JSON node "name" should be equal to "nuevo nombre"

