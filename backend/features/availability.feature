Feature: Availability

  Scenario: It receives a success response
    When I add "Content-Type" header equal to "application/json"
    And I send a GET request to "/"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node success should be true
