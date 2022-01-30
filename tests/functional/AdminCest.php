<?php

class AdminCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTestAdminDashboardAccessAsUser(FunctionalTester $I)
    {
        $I->amOnPage('/admin/dashboard');
        $I->see('THIS ACTION IS UNAUTHORIZED');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::FORBIDDEN);
    }

    public function tryToTestUpdateBookAsUser(FunctionalTester $I)
    {
        $I->amOnPage('/admin/book/update/12');
        $I->see('THIS ACTION IS UNAUTHORIZED');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::FORBIDDEN);
    }

    public function tryToTestUpdateBookAsModerator(FunctionalTester $I)
    {
        $I->seedDatabase('UserRoleSeeder');
        $user = $I->getUserByRole('moder');
        $I->login($user->email, 'secret');
        $I->amOnPage('/admin/dashboard');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }
}
