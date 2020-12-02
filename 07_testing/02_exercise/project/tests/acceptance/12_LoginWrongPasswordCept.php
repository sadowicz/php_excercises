<?php

$I = new AcceptanceTester($scenario);
$I->recreateObjectTable();

$I->wantTo('see error when wrong password is entered');


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
$I->fillField("password", "wrong");

$I->click("Enter");

$I->seeCurrentUrlEquals("/auth/login");
$I->see("Password is invalid!", "li.error");
$I->seeInField("email", $user->email);

/**
 * Important - there is no rate-limiting for the login attempts!
 * Usually there will be only few requests allowed in e.g. five minutes to avoid brute-force attacks.
 */