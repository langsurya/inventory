<?php

namespace app\modules\transaksi\controllers;

use Yii;
use app\modules\transaksi\models\Inbound;
use app\modules\transaksi\models\InboundSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\modules\master\models\MasterGudang;
use app\modules\master\models\Rak;

/**
 * InboundController implements the CRUD actions for Inbound model.
 */
class InboundController extends Controller
{
    /**
     * @inheritdoc
     */
    private $userId;
    private $crewId;
    private $jenis_pasangan;

    public function init()
    {
        if(Yii::$app->user->isGuest == false){
            $this->userId    = \Yii::$app->user->identity->id;
            // $this->crewId    = \Yii::$app->helpers->getCrewIdByUserId($this->userId);
        }
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Inbound models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InboundSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = Inbound::find();
        $query->select(['ref_code', 'qty','rak_id', 'item_id']);
        $query->groupBy('ref_code');


        return $this->render('index', [
            'query' => $query,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inbound model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Inbound model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inbound();


        $rak = Rak::find()
                    ->asArray()
                    ->all();

        $gudang = MasterGudang::find()
                ->orderBy('id_gudang')
                ->all();

        $data = [
            "Gudang ATK" => ["RA01","RA02","RA03", "RA04"],
            "Gudang Pusat" => ["RGP01"],
            "Gudang Mawar" => ["MR01","RGM02"]
        ];
        // dd($rak, $data, $value);

        $post  = Yii::$app->request->post('Inbound');
        // $model = $post['Inbound']['experience'];
        // dd(count($model), $post['Inbound']['ref_code'], $post['Inbound']['rak_id'], $post['Inbound']['experience']);
        if ($post) {
            $model = $post['experience'];

            for ($i=0; $i < count($model); $i++) { 
                $model[$i]['ref_code'] = $post['ref_code'];
                $model[$i]['rak_id'] = $post['rak_id'];
                $model[$i]['status'] =  0;
                $model[$i]['created_by'] =  $this->userId;
                $model[$i]['updated_by'] =  $this->userId;
                $model[$i]['created_at'] =  date('Y-m-d H:i:s');
                $model[$i]['updated_at'] =  date('Y-m-d H:i:s');
            }
            $exp = Yii::$app->db->createCommand()->batchInsert(Inbound::tableName(), ['item_id', 'qty', 'notes', 'expr_date', 'ref_code', 'rak_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], $model)->execute();
            dd($post, $model, $exp);
        }


        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_inbound]);
        // }

        return $this->render('create', [
            // 'rak' => $rak,
            // 'url' => $url,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Inbound model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $url = \yii\helpers\Url::to(['city-list']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_inbound]);
        }

        return $this->render('update', [
            'url' => $url,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Inbound model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inbound model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inbound the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inbound::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionProductList($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id_product, product_name AS text')
                    ->form('master_products')
                    ->where(['like', 'product_name', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = ['id' => $id, 'text' => app\modules\master\models\Products::find($id)->product_name];
        }
        return $out;

    }
}
