Feature: delete form
  In order to delete a form
  As a formbuilder user
  I need an existing form

 Background:
    Given I am logged in as formbuilder user
    And I open dashboard page

  Scenario:
    Given I clicked into an existing form
    When I click the delete icon
    Then I should be redirected back to the dashboard
    And I should not see the deleted form