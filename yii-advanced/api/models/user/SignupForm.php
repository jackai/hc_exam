<?php
namespace api\models\user;

use Yii;
use yii\base\Model;
use common\models\User;

class SignupForm extends Model
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
            ['Account', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['Account', 'string', 'min' => 2, 'max' => 50],
            ['Password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        $user = new User();
        $user->username = $this->Account;
        $user->setPassword($this->Password);
        return $user->save();

    }
}
