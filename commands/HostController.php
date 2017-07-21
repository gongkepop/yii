<?php

namespace app\commands;

use Yii;

use yii\console\Controller;


class HostController extends Controller
{

    private $url = 'http://www.yumingco.com/api/?domain=';
    private $characterArray = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    private $readyArray = ['dt', 'dz'];

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTest()
    {
        $this->getMyHost();
    }


    protected function getMyHost()
    {
        $a = $this->characterArray;
        $b = $this->readyArray;

        foreach ($b as $key => $value) {

            for ($i = 0; $i < count($a); $i++) {
                $yi = $a[$i];
                for ($j = 0; $j < count($a); $j++) {
                    $er = $a[$j];
                    $url = $this->url . $yi . $er . $value . '&suffix=cc';
                    $result = file_get_contents($url);
                    file_put_contents('C:\Users\gok11139\Desktop\host.txt', 'url:' . $yi . $er . $value . '.cc' . ' - ' . $result . "\n", FILE_APPEND);
                }
            }
        }
    }




}
