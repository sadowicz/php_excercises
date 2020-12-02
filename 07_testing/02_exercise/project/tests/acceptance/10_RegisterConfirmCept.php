<?php

$I = new AcceptanceTester($scenario);
$I->recreateObjectTable();

$I->wantTo('confirm user using link');


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

$I->wantTo("see an error when token is invalid");

$I->amOnPage("/auth/confirm/ThisIsAnInvalidEmailConfirmationToken");

$I->seeCurrentUrlEquals("/");
$I->see("Provided token is invalid!", "li.error");

$I->wantTo("check that error disappears after page refresh");
$I->amOnPage("/");
$I->dontSee("Provided token is invalid!");

$I->amGoingTo("confirm user using valid token");
$I->amOnPage("/auth/confirm/$user->token");
$I->seeCurrentUrlEquals("/");
$I->dontSee("Provided token is invalid!");
$I->see("Email successfully confirmed!", "li.info");

$I->wantTo("check that user was updated in database");
$updated_user = unserialize($I->grabFromDatabase("objects", "data", ["key" => $user->key()]));

$I->assertEquals($user->name, $updated_user->name);
$I->assertEquals($user->surname, $updated_user->surname);
$I->assertEquals($user->email, $updated_user->email);
$I->assertEquals($user->password, $updated_user->password);
$I->assertTrue($updated_user->confirmed);
$I->assertNull($updated_user->token);

$I->wantTo("check that info disappears after page refresh");
$I->amOnPage("/");
$I->dontSee("Email successfully confirmed!");
