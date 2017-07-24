<?php
/**
 * Created by PhpStorm.
 * User: gok11139
 * Date: 2017/7/24
 * Time: 10:38
 */

namespace app\modules\manager\controllers;

use Yii;


class DefaultController extends CController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}