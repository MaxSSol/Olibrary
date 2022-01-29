<?php

class SignUpPageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/registration');
    }

    public function tryToClickButtonHaveAccount(AcceptanceTester $I)
    {
        $I->see('Have account? Sign in');
        $I->click('Have account? Sign in');
        $I->see('Please sign in');
    }

    public function tryToSignUp(AcceptanceTester $I)
    {
        $I->see('Please sign up');
        $I->fillField(['name' => 'email'], $I->getFacker()->email);
        $I->fillField(['name' => 'name'], $I->getFacker()->name);
        $I->fillField(['name' => 'password'], 'SuPeRsEcReT12@');
        $I->click('Sign in');

        $I->seeInCurrentUrl('/account');
    }
}
