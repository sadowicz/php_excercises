<?php

$I = new AcceptanceTester($scenario);
$I->recreateObjectTable();

$I->wantTo('be remained about email confirmation when trying to login');

$I->amOnPage("/auth/login");

$I->seeInTitle("Login");
$I->see("Login", "h2");

$user = new Model\User(1);

$user->name = "Unconfirmed";
$user->surname = "User";
$user->email = "dummy@example.com";
$user->password = password_hash("foo", PASSWORD_DEFAULT) ?? "";
$user->confirmed = false;
$user->token = md5(uniqid(rand(), true));

$id = $I->haveInDatabase("objects", [
    "key" => $user->key(),
    "data" => serialize($user)
]);


$I->fillField("email", $user->email);
$I->fillField("password", "foo");

$I->click("Enter");

$I->seeCurrentUrlEquals("/auth/confirmation_notice");
$I->seeInTitle("Confirmation notice");
$I->see("Please confirm user registration...", "h2");