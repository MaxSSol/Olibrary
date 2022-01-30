<?php

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/login');
    }

    // tests
    public function tryToTestLoginWithCorrectCredentials(FunctionalTester $I)
    {
        $user = $I->have('App\Models\User');
        $I->seeRecord('App\Models\User', ['name' => $user->name]);
        $I->fillField(['name' => 'email'], $user->email);
        $I->fillField(['name' => 'password'], 'secret');
        $I->click('Sign in');
        $I->SeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->see($user->name);
    }

    public function tryToTestLoginWithIncorrectCredentials(FunctionalTester $I)
    {
        $I->see('Please sign in');
        $I->fillField(['name' => 'email'], 'testfake@test.com');
        $I->fillField(['name' => 'password'], 'secret');
        $I->click('Sign in');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->see('Check your data');
    }
}
