<?php
/**
 * Created by PhpStorm.
 * User: Genjo
 * Date: 16.09.2017
 * Time: 16:54
 */

namespace app\models;


use yii\db\ActiveRecord;

class Cart
extends ActiveRecord
{

    public function addToCart($product,$qty=1)
    {
        if (isset($_SESSION['cart'][$product->id]['qty']))
        {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        }
        else
        {
            $_SESSION['cart'][$product->id] =[

                'qty' => $qty,
                'img' => $product->img,
                'name' => $product->name,
                'price' => $product->price,
            ];

        }

        $_SESSION['cart.qty'] = isset(  $_SESSION['cart.qty']) ?   $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset(  $_SESSION['cart.sum']) ?   $_SESSION['cart.sum'] + $qty*$product->price : $qty*$product->price;

    }
}