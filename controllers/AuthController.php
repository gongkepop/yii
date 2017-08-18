<?php
/**
 * Created by PhpStorm.
 * User: gok11139
 * Date: 2017/7/25
 * Time: 17:14
 */

namespace app\controllers;

use conquer\oauth2\AuthorizeFilter;
use conquer\oauth2\TokenAction;
use Yii;
use app\models\LoginForm;
use yii\web\Controller;



class AuthController extends Controller
{
    public function behaviors()
    {
//        echo AuthorizeFilter::className();die;
        return [
            /**
             * checks oauth2 credentions
             * and performs OAuth2 authorization, if user is logged on
             */
            'oauth2Auth' => [
                'class' => AuthorizeFilter::className(),
                'only' => ['index'],
            ],
        ];
    }
    public function actions()
    {
        return [
            // returns access token
            'token' => [
                'class' => TokenAction::classname(),
            ],
        ];

    }
    /**
     * Display login form to authorize user
     */
    public function actionIndex()
    {

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }


}