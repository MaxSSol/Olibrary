<?php

class HomePageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }

    // tests
    public function tryToTestViewLibrary(AcceptanceTester $I)
    {
        $I->see('Library');
    }

    public function tryToTestViewMenuButtons(AcceptanceTester $I)
    {
        $I->see('Home');
        $I->see('Categories');
        $I->see('Books');
        $I->see( 'About us');
    }

    public function tryToTestClickButtonSingIn(AcceptanceTester $I)
    {
        $I->click('Sign in');
        $I->see('Please sign in');
    }
}
