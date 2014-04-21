Feature: Ser capaz de gestionar la entidad ingreso
  Crear, borrar, modificar, listar todas las entidades ingreso

  Scenario: La URL para gestionar la entidad existe
    When I go to "/ingresos/gestion"
    Then the response status code should be 200

  Scenario: se puede recuperar el listado de ingresos
    When I send a GET request on "/ingresos"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And the JSON node "root" should have 10 elements

  Scenario: se puede borrar una entidad que no tenga elementos en cascada
    Given I am on "/ingresos"
    And the JSON node "root" should have 10 elements
    When I send a GET request on "/ingreso/10/borrar/"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And I go to "/ingresos"
    And the JSON node "root" should have 9 elements

  Scenario: se puede borrar una entidad via HTTP DELETE que no tenga elementos en cascada
    Given I am on "/ingresos"
    And the JSON node "root" should have 10 elements
    When I send a DELETE request on "/ingreso/10"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
    And I go to "/ingresos"
    And the JSON node "root" should have 9 elements


  Scenario: puedo visualizar una entidad en JSON
    When I send a GET request on "/ingreso/3"
    Then the response status code should be 200
    And the response should be in JSON

  Scenario: puedo crear una nueva entidad
    When I add "CONTENT_TYPE" header equal to "application/json"
    And I send a POST request on "/ingreso" with body:
    """
      {
        "fecha": "2013-10-09",
        "notas": "Velit excepturi et necessitatibus tenetur doloremque iusto quibusdam fuga beatae voluptas iure.",
        "cantidad": 666.99,
        "empresa": {
          "id": 1
        },
        "cuenta": {
          "id": 1,
          "grupo": {
            "id": 1
          }
        }
      }
      """
    Then the response status code should be 200
    And I go to "/ingresos"
    And the JSON node "root" should have 11 elements

  Scenario: puedo actualizar una entidad
    When I add "CONTENT_TYPE" header equal to "application/json"
    And I send a POST request on "/ingreso" with body:
    """
      {
        "id": 10,
        "fecha": "2013-10-09",
        "notas": "bla bla bla",
        "cantidad": 888.99,
        "empresa": {
          "id": 1
        },
        "cuenta": {
          "id": 1,
          "grupo": {
            "id": 1
          }
        }
      }
    """
    Then the response status code should be 200
    And I go to "/ingreso/10"
    And the JSON node "notas" should be equal to "bla bla bla"

