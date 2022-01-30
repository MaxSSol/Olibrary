<?php

class SignInPageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
    }

    // tests
    public function tryToTestSignInAccount(AcceptanceTester $I)
    {
        $user = $I->have('App\Models\User');
        $I->seeCookie('XSRF-TOKEN');
        $I->fillField(['name' => 'email'], $user->email);
        $I->fillField(['name' => 'password'], 'secret');
        $I->click('Sign in');

        $I->see($user->name);
    }

    public function tryToTestGoToSignUp(AcceptanceTester $I)
    {
        $I->click('Don`t have account? Sign up');
        $I->see('Please sign up');
    }

    public function tryToTestGoToResetPassword(AcceptanceTester $I)
    {
        $I->click('Forgot password?');
        $I->see('Reset password');
    }
}
