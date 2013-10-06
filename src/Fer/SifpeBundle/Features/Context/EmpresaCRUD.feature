Feature: Ser capaz de gestionar la entidad Empresa
  Crear, borrar, modificar, listar todas las entidades empresa

  Scenario: Ser capaz de crear una empresa
    Given: I am on '/empresa'
    Then the response status code should be 200