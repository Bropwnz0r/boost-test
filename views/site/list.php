<?php
/**
 * @var yii\web\View $this
 * @var app\models\search\NewsSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'List';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">
        <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => "{summary}\n{items}\n{pager}",
            ]);
        ?>
    </div>
</div>