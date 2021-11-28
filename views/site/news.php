<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\forms\NewsForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('newsFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for added news.
        </div>

    <?php else: ?>
        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'news-form', 'options'=> ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'description') ?>

                    <?= $form->field($model, 'author') ?>

                    <?= $form->field($model, 'fileImport')->fileInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'news-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
