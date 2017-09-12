<?php
/**
 * Created by PhpStorm.
 * User: genjo
 * Date: 12.09.17
 * Time: 15:40
 */

namespace app\controllers;


use app\models\Product;
use yii\web\HttpException;

class ProductController
extends AppController
{

    public function actionView()
    {
        $id = \Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (!$product)
        {
            throw new HttpException(404, 'The requested Item could not be found.');
        }
        $this->setMeta('E-SHOPPER | ' .$product->name,"$product->keywords","$product->description");
        $hits = Product::find()->where(['hit'=>'1'])->limit(6)->all();
        return $this->render('view',compact('product','hits'));
    }

}