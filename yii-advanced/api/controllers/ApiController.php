<?php
namespace api\controllers;

use yii\web\Controller;

class ApiController extends Controller
{
    CONST SUCCESS = 0;
    CONST ERROR   = 2;

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    /**
     * 回傳API統一方法
     *
     * @param $code
     * @param null $data
     * @param null $message
     *
     * @return array
     */
    public function response($code, $data = NULL, $message = NULL)
    {
        return [
            'Code' => $code,
            'Result' => $data,
            'Message' => $message ? $message : "",
        ];
    }

    /**
     * 取得model類第一個錯誤訊息
     *
     * @param $messages
     *
     * @return mixed|string
     */
    public function getFirstError($messages)
    {
        if( is_array($messages)) {
            $message = '';
            foreach( $messages as $val) {
                if( is_array($val)) {
                    $message = array_shift($val);
                    break;
                }
                $message = $val;
                break;
            }
            return $message;
        }
        return $messages;
    }
}
