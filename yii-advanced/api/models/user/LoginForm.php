<?php
namespace api\models\user;

use Yii;
use yii\base\Model;
use common\models\User;

class LoginForm extends Model
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

    public function change()
    {
        $user = User::findByUsername($this->Account);
        if (!$user) return FALSE;

        //TODO: 通常要弄個token之類

        return TRUE;

    }
}
