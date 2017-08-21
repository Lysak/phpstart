<?php
/**
 * Created by PhpStorm.
 * User: lysak
 * Date: 21.08.17
 * Time: 9:13
 */
class NewsController
{

    public function actionIndex()
    {
        echo 'Список новостей';
        return true;
    }

    public function actionView()
    {
        echo '<br><br>Просмотр одной новости';
        return true;
    }
}