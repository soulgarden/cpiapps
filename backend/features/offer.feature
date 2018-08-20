Feature: Offer

  Scenario: Create new offer
    When I add "Content-Type" header equal to "application/json"
    And I send a POST request to "/api/v1/offers"
    Then the response status code should be 201
    And the response should be in JSON
    And the JSON node success should be true

  Scenario: Update offer
    When I add "Content-Type" header equal to "application/json"
    And I send a PUT request to "/api/v1/offers/1"
    Then the response status code should be 204
    And the response should be in JSON
    And the JSON node success should be true

  Scenario: Get all offers
    When I add "Content-Type" header equal to "application/json"
    And I send a GET request to "/api/v1/offers/"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node offers should exist

  Scenario: Get one offer
    When I add "Content-Type" header equal to "application/json"
    And I send a GET request to "/api/v1/offers/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node offer should exist

  Scenario: Delete offer
    When I add "Content-Type" header equal to "application/json"
    And I send a DELETE request to "/api/v1/offers/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the JSON node success should be true