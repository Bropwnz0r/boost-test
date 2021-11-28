<?php

namespace app\controllers;


use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\forms\NewsForm;
use app\models\search\NewsSearch;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays form.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        $model = new NewsForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if( $model->save() ) {
                Yii::$app->session->setFlash('newsFormSubmitted');

                return $this->refresh();
            }
        }

        return $this->render('news', [
            'model' => $model,
        ]);
    }

    public function actionList()
    {
        $searchModel  = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
        ]);
    }
}
