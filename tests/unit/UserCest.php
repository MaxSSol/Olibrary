<?php

class UserCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function tryToTestGetUserName(UnitTester $I)
    {
        $user = new \App\Models\User();
        $user->fill(['name' => 'test']);

        $I->assertEquals('test', $user->name);
    }
}
