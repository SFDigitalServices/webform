Feature: create form
  In order to create a form
  As a formbuilder user
  I want to be able add fields to the form

 Background:
    Given I am logged in as formbuilder user
    And I open dashboard page

  Scenario:
    Given I clicked on the link to create new form
    When I drag and drop a field onto the right panel
    Then I should see a blank form with a field created
    And I should be able add fields to the form