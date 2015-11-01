<?php

namespace app\controllers;

use Yii;
use app\models\plrs\Report;
use app\models\plrs\ReportSearch;
use app\models\AuthForm;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerReportController implements the CRUD actions for Report model.
 */
class CustomerReportController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Report models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Report::find()->where([
                'patient_id' => Yii::$app->session->get('patient_id')
            ]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Report model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerReportTest = new \yii\data\ArrayDataProvider([
            'allModels' => $model->reportTests,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerReportTest' => $providerReportTest,
        ]);
    }

    /**
     *
     * for export pdf at actionView
     *
     * @param type $id
     * @return type
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerReportTest = new \yii\data\ArrayDataProvider([
            'allModels' => $model->reportTests,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerReportTest' => $providerReportTest,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = Report::find()->where([
            'id' => $id,
            'patient_id' => Yii::$app->session->get('patient_id')
        ])->one();
        if ($model) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
    * Action to load a tabular form grid
    * for ReportTest
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddReportTest()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ReportTest');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formReportTest', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    public function actionAuth()
    {
        $model = new AuthForm();
        if ($model->load(Yii::$app->request->post())) {
            $id = $model->auth();
            if ($id) {
                Yii::$app->session->set('patient_id', $id);
                return $this->redirect('index');
            }
        }
        return $this->redirect('/customer/index');
    }
}
