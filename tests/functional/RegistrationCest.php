<?php

class RegistrationCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/registration');
    }

    // tests
    public function tryToTestRegistrationWithCorrectCredentials(FunctionalTester $I)
    {
        $I->see('Please sign up');
        $I->fillField(['name' => 'email'], 'test@test.com');
        $I->fillField(['name' => 'name'], 'Testuser');
        $I->fillField(['name' => 'password'], 'TeSt1234@');
        $I->click('#sign-in');

        $I->see('Testuser');
    }

    public function tryToTestRegistrationWithIncorrectCredentials(FunctionalTester $I)
    {
        $I->see('Please sign up');
        $I->fillField(['name' => 'email'], 'test@test.com');
        $I->fillField(['name' => 'name'], 'ML:AMfam;sfc5-4v1ger93#3252365');
        $I->fillField(['name' => 'password'], 'TEST1234');
        $I->click('#sign-in');
        $I->see('The name must not be greater than 25 characters.');
        $I->see('The password must contain at least one uppercase and one lowercase letter.');
    }
}
