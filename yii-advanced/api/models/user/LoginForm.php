<?php
namespace api\models\user;

use api\models\ApiForm;
use Yii;
use yii\base\Model;
use common\models\User;

class LoginForm extends ApiForm
{
    public $Account;
    public $Password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Account', 'Password',], 'trim'],
            [['Account', 'Password',], 'required'],
            ['Account', 'string', 'min' => 2, 'max' => 50],
            ['Password', 'string', 'min' => 6],
        ];
    }

    public function login()
    {
        $user = User::findByUsername($this->Account);
        if (!$user) return FALSE;

        if (!$user->validatePassword($this->Password)) return FALSE;

        //TODO: 通常要弄個token之類

        return TRUE;

    }
}
