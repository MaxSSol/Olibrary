<?php

class AuthorCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function tryToTestGetAuthorFullName(UnitTester $I)
    {
        $author = new \App\Models\Author();
        $author->fill(['first_name' => 'Unit', 'last_name' => 'Test']);
        $I->assertEquals('Unit Test', $author->full_name);
    }
}
