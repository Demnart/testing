<?php
/**
 * Created by PhpStorm.
 * User: Genjo
 * Date: 14.09.2017
 * Time: 21:05
 */

namespace app\controllers;


use app\models\Cart;
use app\models\Product;

class CartController
extends AppController
{
    public function actionAddCart()
    {
        $id = \Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (!$product)
        {
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);
        $this->layout = false;
        return $this->render('cart-modal',compact('session'));
    }

}