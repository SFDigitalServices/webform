Feature: clone form
  In order to clone a form
  As a formbuilder user
  I want to be able clone an existing form

  Scenario:
    Given I clicked into an existing form for cloning
    When I click the clone icon
    Then I should be redirected back to the dashboard
    Then I should be able to logout
    When I log into my account
    Then I should see the cloned form

    #Mostly copied from delete form (for cleanup)
    When I click the clone form
    Then I see the delete icon
    When I click the delete icon
    Then I should see confirmation popup
    When I click Ok
    Then I should be redirected back to the dashboard
    And I should not see the deleted cloned form