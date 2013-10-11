Feature: Ser capaz de gestionar la entidad Empresa
  Crear, borrar, modificar, listar todas las entidades empresa

  Scenario: La URL para gestionar la entidad existe
    When I go to "/empresas/gestion"
    Then the response status code should be 200

  Scenario: se puede recuperar el listado de empresas
    When I send a GET request on "/empresas"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And the JSON node "root" should have 3 elements

  Scenario: se puede borrar una empresa que no tenga elementos en cascada
    Given I am on "/empresas"
    And the JSON node "root" should have 3 elements
    When I send a GET request on "/empresa/3/borrar/"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And I go to "/empresas"
    And the JSON node "root" should have 2 elements

  Scenario: se puede borrar una empresa via HTTP DELETE que no tenga elementos en cascada
    Given I am on "/empresas"
    And the JSON node "root" should have 3 elements
    When I send a DELETE request on "/empresa/3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And I go to "/empresas"
    And the JSON node "root" should have 2 elements


  Scenario: puedo visualizar una empresa en JSON
    When I send a GET request on "/empresa/3"
    Then the response status code should be 200
    And the response should be in JSON

  Scenario: puedo crear una nueva empresa
    When I add "CONTENT_TYPE" header equal to "application/json"
    And I send a POST request on "/empresa" with body:
      """
      {"name": "mi empresa"}
      """
    Then the response status code should be 200
    And I go to "/empresas"
    And the JSON node "root" should have 4 elements

  Scenario: puedo actualizar una empresa
    When I add "CONTENT_TYPE" header equal to "application/json"
    And I send a POST request on "/empresa" with body:
      """
      {"id": "3", "name": "nuevo nombre"}
      """
    Then the response status code should be 200
    And I go to "/empresa/3"
    And the JSON node "root.name" should be equal to "nuevo nombre"

