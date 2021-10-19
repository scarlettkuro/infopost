<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\NewsPost;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    { 
        $recentViewedPosts = NewsPost::find()
                ->orderBy('last_view')
                ->limit(5)
                ->all();
        
        return $this->render('index', [
            'newsPosts' => $recentViewedPosts
        ]);
    }
    
    
    public function actionPost($id)
    {
        $newsPost = NewsPost::findOne($id);
        
        if (!isset($newsPost)) 
        {
            throw new \yii\web\NotFoundHttpException();
        }
        
        $newsPost->touch('last_view');
        
        return $this->render('post', [
            'newsPost' => $newsPost
        ]);
    }
    
    public function actionAdd() 
    {
        $newsPost = new NewsPost();
        
        if ($newsPost->load(Yii::$app->request->post()) && $newsPost->save() ) 
        {
            Yii::$app->session->setFlash('newsPostAdded');
            return $this->refresh();
        }
        
        $newsPost->title = $this->generateRandomText(rand(1,4));
        $newsPost->body = $this->generateRandomText(rand(8,25));
        
        return $this->render('add', [
            'model' => $newsPost,
        ]);
        
    }
    
    private function generateRandomText($wordsCount) 
    {
        $url = "https://random-word-api.herokuapp.com//word?number=$wordsCount";
        $json = file_get_contents($url);
        
        return implode(' ', json_decode($json));
    }
}
