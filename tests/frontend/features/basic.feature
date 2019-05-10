Feature: Business rules
  In order to create forms
  As a formbuilder user
  I want to be able to interact with the formbuilder

  Scenario:
    Given I have a formbuilder account
    When I logged into the my account
    Then I should see all my forms
    And I should be able to create new forms
