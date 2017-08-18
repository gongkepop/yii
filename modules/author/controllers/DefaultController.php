<?php

namespace app\modules\author\controllers;

use Yii;

/**
 * DefaultController
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class DefaultController extends CController
{

    /**
     * Action index
     */
    public function actionIndex()
    {

        return $this->render('index');
    }
}
