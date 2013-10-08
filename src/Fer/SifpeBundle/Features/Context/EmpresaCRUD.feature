Feature: Ser capaz de gestionar la entidad Empresa
  Crear, borrar, modificar, listar todas las entidades empresa

  Scenario: La URL para gestionar la entidad existe
    When I go to "/empresas/gestion"
    Then the response status code should be 200