<?php
/**
 * Created by PhpStorm.
 * User: Maria
 * Date: 25.02.2018
 * Time: 13:03
 */

namespace app\controllers;
use yii\web\Controller;

class CustomController extends Controller
{
    protected  function setMeta ($title = null, $description = null,$keywords = null)
    {
        $this->view->title = $this;
        $this->view->title =registerMetaTag(['name' =>'keywords', 'content' => $keywords]);
        $this->view->title =registerMetaTag(['name' =>'description', 'content' => $description]);
    }

    public static function printr($value)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }
}