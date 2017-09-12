<?php
/**
 * Created by PhpStorm.
 * User: genjo
 * Date: 12.09.17
 * Time: 15:40
 */

namespace app\controllers;


use app\models\Product;

class ProductController
extends AppController
{

    public function actionView()
    {
        $id = \Yii::$app->request->get('id');
        $product = Product::findOne($id);
        $this->setMeta('E-SHOPPER | ' .$product->name,"$product->keywords","$product->description");
        $hits = Product::find()->where(['hit'=>'1'])->limit(6)->all();
        return $this->render('view',compact('product','hits'));
    }

}