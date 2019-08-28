Feature: create form
  In order to create a form
  As a formbuilder user
  I want to be able add fields to the form

  Scenario:
    Given I am on the dashboard page
    When I drag and drop a field onto the right panel
    Then I should see a blank form with a field created
    And I should be able add fields to the form
    And I should see my form on the dashboard