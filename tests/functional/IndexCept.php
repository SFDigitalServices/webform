<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('open index page of site');
$I->amOnPage('/');
$I->seeElement('input', ['name' => 'email']);
$I->seeElement('input', ['name' => 'password']);
