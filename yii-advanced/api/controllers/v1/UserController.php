<?php
namespace api\controllers\v1;

use api\controllers\ApiController;
use api\models\user\DeleteForm;
use api\models\user\LoginForm;
use api\models\user\PwdChangeForm;
use api\models\user\SignupForm;
use Yii;

class UserController extends ApiController
{
    public function actionCreate()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->response(self::SUCCESS, ["IsOK" => true]);
        }

        return $this->response(self::ERROR, NULL, $this->getFirstError($model->getFirstErrors()));
    }

    public function actionDelete()
    {
        $model = new DeleteForm();
        if ($model->load(Yii::$app->request->post()) && $model->delete()) {
            return $this->response(self::SUCCESS, ["IsOK" => true]);
        }

        return $this->response(self::ERROR, NULL, $this->getFirstError($model->getFirstErrors()));
    }

    public function actionPwdChange()
    {
        $model = new PwdChangeForm();
        if ($model->load(Yii::$app->request->post()) && $model->change()) {
            return $this->response(self::SUCCESS, ["IsOK" => true]);
        }

        return $this->response(self::ERROR, NULL, $this->getFirstError($model->getFirstErrors()));
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->response(self::SUCCESS);
        }

        return $this->response(self::ERROR, NULL, 'Login Failed');
    }
}
