<?php
/**
 * Created by PhpStorm.
 * User: Genjo
 * Date: 14.09.2017
 * Time: 21:05
 */

namespace app\controllers;


class CartController
extends AppController
{
    public function actionAddCart()
    {
        $id = \Yii::$app->request->get('id');
        if (!$id)
        {
            return false;
        }
        debug($id);
    }

}