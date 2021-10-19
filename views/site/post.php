<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = $newsPost->title;
?>
<div class="site-about">
    <h1><?= Html::encode($newsPost->title) ?></h1>

    <p class="font-italic"><?= Html::encode($newsPost->lastView->format('Y-m-d H:i:s')) ?></p>
    <p><?= Html::encode($newsPost->body) ?></p>
    
</div>