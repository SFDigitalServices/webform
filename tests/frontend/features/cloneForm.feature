Feature: clone form
  In order to clone a form
  As a formbuilder user
  I want to be able clone an existing form

 Background:
    Given I am logged in as formbuilder user
    And I open dashboard page

  Scenario:
    Given I clicked into an existing form
    When I click the clone icon
    Then I should be redirected back to the dashboard
    And I should see the cloned form