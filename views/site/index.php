<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Infopost: news feed';
?>
<div class="site-index">
    
    <?php if (empty($newsPosts)): ?>
    
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Empty :(</h1>

        <p class="lead">There are no news in the feed.</p>
    </div>

    <?php else: ?>
    
    <div class="body-content">

        <div class="row">
            <?php foreach($newsPosts as $newsPost): ?> 
            <div class="col-lg-4">
                <h2><?= Html::encode($newsPost->title) ?></h2>

                <p classs="text-break"><?= Html::encode($newsPost->body) ?></p>

                <p><a class="btn btn-outline-secondary" href="<?= Url::to(['site/post', 'id' => $newsPost->id]) ?>"><?= Html::encode($newsPost->lastView->format('Y-m-d H:i:s')) ?></a></p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
    
    <?php endif; ?>
    
</div>
