<?php

namespace app\controllers;

use app\actions\ErrorAction;
use app\actions\ViewAction;
use app\components\AppState;
use app\components\ConsoleRunner;
use app\traits\IsOneCountryModeTrait;
use Yii;
use yii\captcha\CaptchaAction;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers
 */
class SiteController extends \app\base\Controller
{
    use IsOneCountryModeTrait;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'foreColor' => 0x3d74c8,
            ],
            'page' => [
                'class' => ViewAction::class,
            ]
        ];
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\ExitException
     */
    public function actionApplyUpdates()
    {
        $autoUpdate = Yii::$app->params['autoApplyUpdates'];
        $appState = new AppState();
        $appState->readState();

        if (!$appState->isMaintenance()) {
            if (Yii::$app->request->isAjax) {
                return $this->sendJson(['success' => true, 'updated' => true]);
            }
            return $this->redirect('/');
        }

        $isAdmin = !Yii::$app->user->isGuest && $this->getCurrentUser()->isAdmin;
        if ($autoUpdate || ($isAdmin && Yii::$app->request->get('runUpdate', 0) == 1)) {
            $consoleRunner = new ConsoleRunner();
            $consoleRunner->run('update/apply');
            if ($isAdmin) {
                Yii::$app->session->setFlash('updateSuccess', Yii::t('app', 'YouDate has been updated'));
                return $this->redirect('/' . env('ADMIN_PREFIX'));
            }
        }

        $this->layout = 'maintenance';
        return $this->render($isAdmin ? 'update' : 'maintenance');
    }

    /**
     * @param null $country
     * @param $query
     * @throws \Geocoder\Exception\Exception
     * @throws \yii\base\ExitException
     */
    public function actionFindCities($country = null, $query)
    {
        if ($this->isOneCountryOnly() == true ) {
            $country = $this->getDefaultCountry();
            if ($country == null) {
                Yii::warning('Default country is not set');
            }
        }

        if ($country == null) {
            $country = Yii::$app->user->isGuest ?
                Yii::$app->geographer->detectCountry(Yii::$app->request->userIP) :
                $this->getCurrentUserProfile()->country;
        }

        $this->sendJson(['cities' =>  Yii::$app->geographer->findCities($country, $query)]);
    }

    /**
     * @throws \Geocoder\Exception\Exception
     * @throws \yii\base\ExitException
     */
    public function actionDetectLocation()
    {
        $ipAddress = Yii::$app->request->userIP;
        $country = Yii::$app->geographer->detectCountry($ipAddress);
        $city = Yii::$app->geographer->detectCityByIp($ipAddress);

        return $this->sendJson([
            'success' => true,
            'country' => $country,
            'city' => $city !== null ? [
                'geonameId' => $city->geoname_id,
                'name' => $city->getName(),
            ] : null,
        ]);
    }
}
