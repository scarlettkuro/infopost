<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\NewsPost;

class NewsController extends Controller
{
    /**
     * This command shuffles body of the first news post on main page
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        $firstPost = NewsPost::find()
                ->orderBy('last_view')
                ->one();
        
        $bodyWords = explode(' ', $firstPost->body);
        shuffle($bodyWords);
        $firstPost->body = implode(' ', $bodyWords);
        $firstPost->save();
        
        echo "'{$firstPost->title}' shuffled! \n";

        return ExitCode::OK;
    }
}
