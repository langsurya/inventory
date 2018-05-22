<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\profile\models\Pegawai;

use mdm\admin\models\form\ResetPassword;
use mdm\admin\models\form\Signup;
use mdm\admin\models\form\ChangePassword;

use app\modules\master\models\MasterGudang;
use app\modules\master\models\Suppliers;
use app\modules\master\models\Products;
use app\modules\master\models\Categories;
use app\modules\master\models\Rak;
use app\modules\master\models\Unit;
use app\modules\master\models\Customer;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }

        $gudang = MasterGudang::find()->count();
        $Suppliers = Suppliers::find()->count();
        $product = Products::find()->count();
        $categories = Categories::find()->count();
        $rak = Rak::find()->count();
        $unit = Unit::find()->count();
        $customer = Customer::find()->count();

        return $this->render('index', [
            'gudang' => $gudang,
            'Suppliers' => $Suppliers,
            'categories' => $categories,
            'product' => $product,
            'rak' => $rak,
            'unit' => $unit,
            'customer' => $customer,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin($key = null)
    {
        $this->layout = '/backend/main_login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->setSessionPegawai();
            if($key === null)
                return $this->goHome();
            else
                return $this->redirect(['first-login']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    protected function setSessionPegawai()
    {
        if (Yii::$app->user->can('karyawan-role')) {
            $model = Pegawai::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
            if (!empty($model)) {
                \Yii::$app->session['namaPegawai'] = $model->nama_pegawai;
                \Yii::$app->session['fotoPegawai'] = $model->foto;
                \Yii::$app->session['IDPegawai'] = $model->id_pegawai;
            } else {
                \Yii::$app->session['namaPegawai'] = Yii::$app->user->identity->username;
                \Yii::$app->session['fotoPegawai'] = "/images/default-photo.jpg";
            }
        }

        else {
            \Yii::$app->session['namaPegawai'] = Yii::$app->user->identity->username;
            \Yii::$app->session['fotoPegawai'] = "/images/default-photo.jpg";
        }
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
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
