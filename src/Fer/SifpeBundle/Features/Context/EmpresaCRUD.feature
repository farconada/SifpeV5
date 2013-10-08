Feature: Ser capaz de gestionar la entidad Empresa
  Crear, borrar, modificar, listar todas las entidades empresa

  Scenario: La URL para gestionar la entidad existe
    When I go to "/empresas/gestion"
    Then the response status code should be 200

  Scenario: se puede recuperar el listado de empresas
    When I go to "/empresas"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And the JSON node "root" should have 3 elements
