Feature: modify form
  In order to modify a form
  As a formbuilder user
  I want to be able modify field attributes

  Scenario:
    Given I am on an existing form for modification
    And I should be able to insert another field
    When I click on any existing fields
    Then I should see the field attribute window
    And I should be able modify the attributes