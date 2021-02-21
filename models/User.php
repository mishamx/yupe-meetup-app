<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    private $auth_key;

    public function rules()
    {
        return [
            [['login','password'],'string', 'min' => 3, 'max' => 255]
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /** @inheritdoc */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('Method "' . __CLASS__ . '::' . __METHOD__ . '" is not implemented.');
    }

    /**
     * @param $username
     * @return User|array|ActiveRecord|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['login'=>$username])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * @param string $authKey
     * @return bool|void
     */
    public function validateAuthKey($authKey)
    {
        return $authKey === $this->auth_key;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
}
