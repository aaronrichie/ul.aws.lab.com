<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('verify Homepage loads');
$I->amOnPage('/');
$I->amOnPage('site/index');
