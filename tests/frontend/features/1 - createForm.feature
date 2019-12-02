Feature: create form
  In order to create a form
  As a formbuilder user
  I want to be able add fields to the form

  Scenario:
    Given I am on the dashboard page
    When I click to insert a field
    Then I should see the field created in the navigation and an edit panel
    And I should be able to edit that field to the form
    And I should see my form on the dashboard
