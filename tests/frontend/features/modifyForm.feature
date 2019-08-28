Feature: modify form
  In order to modify a form
  As a formbuilder user
  I want to be able modify field attributes

 Background:
    Given I am logged in as formbuilder user
    And I open dashboard page

  Scenario:
    Given I am on an existing form
    When I click on any existing fields
    Then I should see the field's attribute window
    And I should be able modify the attributes