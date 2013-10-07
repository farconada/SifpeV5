Feature: Ser capaz de gestionar la entidad Empresa
  Crear, borrar, modificar, listar todas las entidades empresa

  Scenario: La URL para gestionar la entidad existe
    Given: I am on "/empresa"
    Then the response status code should be 200