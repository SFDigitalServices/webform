Feature: clone form
  In order to clone a form
  As a formbuilder user
  I want to be able clone an existing form

  Scenario:
    Given I clicked into an existing form for cloning
    When I click the clone icon
    Then I should be redirected back to the dashboard
    And I should be able to logout
    When I log back into my account
    Then I should see the cloned form