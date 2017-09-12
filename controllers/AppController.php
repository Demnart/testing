<?php
/**
 * Created by PhpStorm.
 * User: genjo
 * Date: 12.09.17
 * Time: 10:56
 */

namespace app\controllers;


use yii\web\Controller;

class AppController
extends Controller
{

    public function setMeta($title=null,$keywords = null, $description = null){

        $this->view->title = $title;
        $this->view->registerMetaTag(['name'=>'keywords','content'=>$keywords]);
        $this->view->registerMetaTag(['name'=>'description','content'=>$description]);
    }

}