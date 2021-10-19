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
            <div class="col-lg-4 mb-4">
                <div class="card h-100" >
                    <div class="card-body">
                        <h4 class="card-title"><?= Html::encode($newsPost->title) ?></h4>
                        <p class="card-text text-break">
                            <?= Html::encode($newsPost->body) ?>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a class="btn btn-outline-secondary w-100 text-left" href="<?= Url::to(['site/post', 'id' => $newsPost->id]) ?>">
                            Last viewed: 
                            <?php if (is_null($newsPost->lastView)): ?>
                                <span class="badge badge-danger">never</span>
                            <?php else: ?>
                                <span class="badge badge-primary">
                                    <?= Html::encode($newsPost->lastView->format('Y-m-d H:i:s')) ?>
                                </span>                            
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
    
    <?php endif; ?>
    
</div>
