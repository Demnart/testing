<?php
/**
 * Created by PhpStorm.
 * User: Genjo
 * Date: 14.09.2017
 * Time: 21:05
 */

namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
use app\models\Product;

class CartController
extends AppController
{
    public function actionAddCart()
    {
        $id = \Yii::$app->request->get('id');
        $qty =(int)\Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if (!$product)
        {
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product,$qty);
        if (!\Yii::$app->request->isAjax)
        {
            return $this->redirect(\Yii::$app->request->referrer);
        }
        $this->layout = false;
        return $this->render('cart-modal',compact('session'));
    }

    public function actionClearCart()
    {
        $session = \Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal',compact('session'));
    }

    public function actionClearOne()
    {
        $id = \Yii::$app->request->get('id');
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->removeItem($id);
        $this->layout = false;
        return $this->render('cart-modal',compact('session'));
    }

    public function actionShowCart()
    {
        $id = \Yii::$app->request->get('id');
        $session = \Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal',compact('session'));
    }

    public function actionView()
    {
        $session = \Yii::$app->session;
        $session->open();
        $order = new Order();
        $this->setMeta('Корзина');
        if ($order->load(\Yii::$app->request->post()))
        {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save())
            {
                $this->saveOrderItems($session['cart'],$order->id);
                \Yii::$app->session->setFlash('success','Ваш заказ принят, менеджер скоро свяжется с вами');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
               return $this->refresh();
            }else
            {
                \Yii::$app->session->setFlash('error','Ошибка при заказе');

            }
        }
        return $this->render('view',compact('session','order'));
    }

    protected function saveOrderItems($items,$order_id){
        foreach ($items as $id => $item)
        {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->qty_item = $item['qty'];
            $order_items->price = $item['price'];
            $order_items->sum_item= $item['qty'] * $item['price'];
            $order_items->save();
        }
    }
}