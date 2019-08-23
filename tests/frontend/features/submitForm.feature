Feature: submit form
  In order to submit a form
  As a end user
  I want to be able fill out form fields and submit

  Scenario:
    Given I navigate to a published form
    When I filled out all required fields and click submit
    Then I should be redirected to a confirmation page