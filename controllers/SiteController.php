<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ClickSearch;

class SiteController extends Controller
{
    /**
     * Lists all Click models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClickSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
