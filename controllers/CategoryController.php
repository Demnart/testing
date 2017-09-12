<?php
/**
 * Created by PhpStorm.
 * User: genjo
 * Date: 12.09.17
 * Time: 11:00
 */

namespace app\controllers;


use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController
extends AppController
{

    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->all();
        $this->setMeta('E-SHOPPER');
        return $this->render('index',compact('hits'));
    }

    public function actionView()
    {
        $id = \Yii::$app->request->get('id');
        $category = Category::findOne($id);
        if (!$category)
        {
         throw new HttpException(404, 'Страница не найдена');
        }


        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'pageSizeParam' => false, 'forcePageParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('E-SHOPPER | ' . $category->name,"$category->keywords","$category->description");
        return $this->render('view',compact('pages','products','category'));

    }
}