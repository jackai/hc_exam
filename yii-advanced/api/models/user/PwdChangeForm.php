<?php
namespace api\models\user;

use api\models\ApiForm;
use Yii;
use yii\base\Model;
use common\models\User;

class PwdChangeForm extends ApiForm
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

        $user->setPassword($this->Password);
        return $user->save();
    }
}
