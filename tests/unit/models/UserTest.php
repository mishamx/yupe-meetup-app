<?php

namespace tests\unit\models;

use app\models\User;
use fixtures\UserFixture;

class UserTest extends \Codeception\Test\Unit
{
    public function _fixtures()
    {
        return [
            'user'=>[
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
        ];
    }
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->login)->equals('admin');

        expect_not(User::findIdentity(999));
    }


    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('admin'));
        expect_not(User::findByUsername('user'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('admin');
        expect_that($user->validatePassword('xgdfgsdf'));
        expect_not($user->validatePassword('123456'));
    }

}
