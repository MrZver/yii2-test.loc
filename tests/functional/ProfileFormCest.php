<?php

class ProfileFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\models\User::findByUsername('admin'));
    }

    public function openProfilePage(\FunctionalTester $I)
    {
        $I->amOnPage('/site/profile');
        $I->see('Inform settings');
    }

    public function saveSettings(\FunctionalTester $I)
    {
        $I->amOnPage('/site/profile');
        $I->submitForm('#settings_form', []);
        $I->see('Settings saved');
    }
}
