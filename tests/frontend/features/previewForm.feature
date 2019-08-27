Feature: preview form
  In order to preview a form
  As a formbuilder user
  I want to be able preview a form

  Background:
    Given I am logged in as formbuilder user
    And I open dashboard page

  Scenario:
    Given I have an existing form
    When I click on the Preview button
    Then I should see a new window with rendered html