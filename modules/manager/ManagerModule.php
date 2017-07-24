<?php
/**
 * Created by PhpStorm.
 * User: gok11139
 * Date: 2017/7/24
 * Time: 10:38
 */

namespace app\modules\manager;

use Yii;
use yii\base\Module;

class ManagerModule extends Module
{
    public function init()
    {
        parent::init();
        // 从config.php加载配置来初始化模块
        Yii::configure($this, require(__DIR__ . '/config/config.php'));
    }
}
