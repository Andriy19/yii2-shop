<?php

namespace app\controllers;

use app\models\Category;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\controllers\CustomController;


class SiteController extends CustomController
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

    public $Password;

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
        // вытащить все
        ///$model = Category::find()->all();

        // вытаскиваем запись с id = 6
        //$model = Category::findOne(6);
        //$model = Category::find()->where(['id' => 6])->all();

        // вытаскиваем 3 первых записи
        //$model = Category::find()->limit(3)->all();

        //вытаскиваем 3 последних записи
        //$model = Category::find()->orderBy('id DESC')->limit(3)->all();

        return $this->render('index'/*, compact('model')*/);
    }




    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegistration()
    {
        $this->setMeta('Registration');

        $registration = new User();

        $registration->scenario = 'registration';

        if($registration->load(Yii::$app->request->post()))
        {
            $this->Password = $registration->password;

            $registration->password = Yii::$app->security->generatePasswordHash($registration->password);
            $registration->code = Yii::$app->getSecurity()->generateRandomString(10);

            //CustomController::printr($registration);
            //exit;


            if($registration->save())
            {
                Yii::$app->session->setFlash('success', 'Вам  отправлена ссылка с потверждением вашего Email');
                return $this->goHome();
            }
            else
            {



                $registration->password = $this->Password;
                return $this->render('reglog', compact('registration'));
            }
        }

        return $this->render('reglog', compact('registration'));

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
