<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\NewsPost;
use yii\helpers\Url;

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
        
        $params = [
            'newsPost' => $newsPost
        ];
        
        if (!\Yii::$app->params['ajaxLastView']) {
            //set as viewed before page is fully loaded
            $newsPost->wasSeen();
        } else {
            //set as viewed only after pafe is fully loaded
            $csrfTokenName = \Yii::$app->getRequest()->csrfParam;
            $csrfToken = \Yii::$app->getRequest()->getCsrfToken();
            $params = array_merge($params, [
                'csrfTokenName' => $csrfTokenName,
                'csrfToken' => $csrfToken,
                'ajaxUrl' => Url::to(['site/post', 'id' => $newsPost->id])
            ]);
        }
        
        return $this->render('post', $params);
    }
    
    public function actionSeen($id)
    {
        $newsPost = NewsPost::findOne($id);
        
        if (!isset($newsPost)) 
        {
            return false;
        }
        
        if (\Yii::$app->params['ajaxLastView']) {
            $newsPost->wasSeen();
            return true;
        } 
        
        return false;
        
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
