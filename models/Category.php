<?php
/**
 * Created by PhpStorm.
 * User: Maria
 * Date: 25.02.2018
 * Time: 12:16
 */

namespace app\models;
use yii\db\ActiveRecord;


class Category extends  ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['title', 'description', 'keywords'], 'required'],
            [['title', 'description', 'keywords'], 'string'],
        ];
    }
    public function attributeLabels()
    {
        return [
           'title' => 'Заголовок',
           'description' => 'Опис',
           'keywords' => 'Ключовві слова',
        ];
    }
}