<?php
/**
 * Created by PhpStorm.
 * User: lysak
 * Date: 21.08.17
 * Time: 9:13
 */

include_once ROOT.'/models/News.php';

class NewsController
{

    public function actionIndex()
    {
        $newsList = array();
        $newsList = News::getNewsList();
//
//        echo '<pre>';
//        print_r($newsList);
//        echo '</pre>';
        require_once(ROOT.'/views/news/index.php');
        return true;
    }

    public function actionView($id)
    {
        if ($id) {
            $newsItem = News::getNewsItemById($id);
//
//            echo '<pre>';
//            print_r($newsItem);
//            echo '</pre>';
        }


        require_once(ROOT . '/views/news/view.php');
        return true;
    }
}