<?php

/* @var $this yii\web\View */

use yii\web\View;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = $newsPost->title;
?>
<div class="site-about">
    <h1><?= Html::encode($newsPost->title) ?></h1>
    <p><?= Html::encode($newsPost->body) ?></p>    
</div>

<?php 
//when the page is loaded, post must marked as viewed
if (\Yii::$app->params['ajaxLastView']) {
    
    $js =
<<<JS
    $.ajax({
        url: '$ajaxUrl',
        type: 'post',
        data: { $csrfTokenName: "$csrfToken"}
    })

JS;

    $this->registerJs($js, View::POS_READY, 'my-button-handler');
    
}