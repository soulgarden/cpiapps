Feature: Availability

  Scenario: It receives a success response
    When I am on "/"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node success should be true
