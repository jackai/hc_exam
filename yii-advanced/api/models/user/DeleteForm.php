<?php
namespace api\models\user;

use api\models\ApiForm;
use Yii;
use yii\base\Model;
use common\models\User;

class DeleteForm extends ApiForm
{
    public $Account;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Account',], 'trim'],
            [['Account',], 'required'],
            ['Account', 'string', 'min' => 2, 'max' => 50],
        ];
    }

    public function delete()
    {
        $user = User::findByUsername($this->Account);
        if (!$user) return FALSE;

        return $user->delete();
    }
}
