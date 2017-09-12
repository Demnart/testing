<?php
/**
 * Created by PhpStorm.
 * User: genjo
 * Date: 12.09.17
 * Time: 16:27
 */

namespace app\controllers;


class ErrorController
extends AppController
{

    public function actionError()
    {
        $this->layout=false;
        return $this->render('error');
    }
}