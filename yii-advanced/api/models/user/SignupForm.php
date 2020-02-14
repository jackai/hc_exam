<?php
namespace api\models\user;

use api\models\ApiForm;
use Yii;
use yii\base\Model;
use common\models\User;

class SignupForm extends ApiForm
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
            ['Account', 'unique', 'targetAttribute' => 'username', 'targetClass' => '\common\models\User', 'message' => '用戶名稱已存在'],
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
        $user->status = User::STATUS_ACTIVE;
        return $user->save();

    }
}
