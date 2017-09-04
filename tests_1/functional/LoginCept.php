<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('Verify login page');
// Verify homepage link works
$I->amOnPage('/');
$I->click('Login');
$I->amOnPage(['site/login']);
// Verify form is present
$I->fillField('user_password_hash','Sysadmin123');
$I->click('Login');