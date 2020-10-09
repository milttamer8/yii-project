<?php

namespace app\controllers;

use app\forms\UserSearchForm;
use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\controllers
 */
class DirectoryController extends \app\base\Controller
{
    /**
     * Main page
     *
     * @return string
     * @throws \Exception
     */
    public function actionIndex()
    {
        if (Yii::$app->settings->get('frontend', 'siteHideDirectoryFromGuests', false) == true && Yii::$app->user->isGuest) {
            return $this->redirect(['/security/login']);
        }

        $params = [];

        $searchForm = new UserSearchForm();
        $searchForm->setProfile($this->getCurrentUserProfile());
        $searchForm->load(Yii::$app->request->get());
        $params['searchForm'] = $searchForm;
        $currentProfile = $this->getCurrentUserProfile();

        $currentCity = null;
        if (!Yii::$app->user->isGuest) {
            $params['hideCurrentUser'] = true;
            $cityId = isset($searchForm->city) || $currentProfile === null ? $searchForm->city : $currentProfile->city;
        } else {
            $cityId = $searchForm->city;
        }

        $cityName = Yii::$app->geographer->getCityName($cityId);
        $currentCity = [
            'value' => $searchForm->city,
            'title' => $cityName,
            'city' => $cityName,
            'region' => null,
            'country' => null,
            'population' => null,
        ];

        return $this->render('index', [
            'dataProvider' => Yii::$app->userManager->getUsersProvider($params),
            'user' => $this->getCurrentUser(),
            'profile' => $this->getCurrentUserProfile(),
            'searchForm' => $searchForm,
            'countries' => Yii::$app->geographer->getCountriesList(),
            'currentCity' => $currentCity,
            'alreadyBoosted' => Yii::$app->balanceManager->isAlreadyBoosted(Yii::$app->user->id),
        ]);
    }
}
