<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

    /**
     * Define custom actions here
     */

    public function login(string $email, string $password)
    {
        $I = $this;
        $I->amOnPage('/login');
        $I->fillField(['name' => 'email'], $email);
        $I->fillField(['name' => 'password'], $password);
        $I->click('#submit-sign');
    }

    public function getUserByRole(string $slugRole)
    {
        $I = $this;
        $role = $I->grabRecord('App\Models\Role', ['slug' => $slugRole]);
        $userRole = $I->grabRecord('users_roles', ['role_id' => $role->id]);
        return $I->grabRecord('App\Models\User', ['id' => $userRole['user_id']]);
    }
}
