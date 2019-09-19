Feature: delete form
  In order to delete a form
  As a formbuilder user
  I need an existing form

  Scenario:
    Given I clicked into an existing form for deletion
    When I click the delete icon
    Then I should see confirmation popup
    When I click Do It
    Then I should be redirected back to the dashboard
    And I should not see the deleted form