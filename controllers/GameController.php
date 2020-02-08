<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\ar\GameRound;
use app\models\ar\User;
use app\models\ar\Setting;

class GameController extends Controller
{
    
    public function actionRun() {
        $score = $this->getScore();
        $gameRoundArray = $this->getGameRoundArray();
        \Yii::$app->session->set("gameRoundArray", $gameRoundArray);
        return $this->render('run', ['score' => $score, 'gameRoundArray' => $gameRoundArray]);
    }
    
    public function actionSelect() {
        $selected = Yii::$app->request->post("selected");
        $gameRoundArray = \Yii::$app->session->get("gameRoundArray");
        $temp_1 = (float) $gameRoundArray['temp_1'];
        $temp_2 = (float) $gameRoundArray['temp_2'];
        $win = false;
        if ($temp_1 > $temp_2) {
            $win = ($selected == 1 ? true : false);
        } else if ($temp_2 > $temp_1) {
            $win = ($selected == 2 ? true : false);
        } else {
            $win = true;
        }
        $resultArray = ["selected" => $selected, "win" => $win, "score" => 0, "temp_1" => $temp_1, "temp_2" => $temp_2];
        if ($gameRoundArray) {
            $gameRound = $this->getGameRound();
            $gameRound->city_1 = $gameRoundArray['city_1'];
            $gameRound->city_2 = $gameRoundArray['city_2'];
            $gameRound->temp_1 = $temp_1;
            $gameRound->temp_2 = $temp_2;
            $gameRound->selected = $selected;
            $gameRound->score = ($win ? 1 : 0);
            $gameRound->save();
        }
        $resultArray['score'] = $this->getScore();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $resultArray;
    }
    
    
    
    public function actionNext() {
        
    }

    private function getGameRound() {
        $userId = Yii::$app->session->get("user_id");
        $user = null;
        if ($userId) {
            $user = User::findOne($userId);
        }
        if (!$user) {
            $user = new User();
            $user->save();
            Yii::$app->session->set("user_id", $user->user_id);
        }
        $gameRound = new GameRound();
        $gameRound->link("user", $user);
        return $gameRound;
    }

    private function getScore() {
        return 0;
    }
    
    /**
     * [
     *  'city_i' => "",
     * 'city_2' => "",
     * 'temp_1' => "",
     * 'temp_2' => ""
     * ]
     */
    private function getGameRoundArray() {
        $cityList = $this->getCityList();
        $count = count($cityList);
        $pos_1 = rand(0, $count - 1);
        $pos_2 = -1;
        while ($pos_2 < 0) {
            $r = rand(0, $count - 1);
            if ($r != $pos_1) {
                $pos_2 = $r;
            }
        }
        
        $cityData_1 = $cityList[$pos_1];
        $cityData_2 = $cityList[$pos_2];
        
        $fullName_1 = $this->getFullName($cityData_1);
        $fullName_2 = $this->getFullName($cityData_2);
        
        $temp_1 = $this->getTemperature($cityData_1->id);
        $temp_2 = $this->getTemperature($cityData_2->id);
                
        return ["city_1" => $fullName_1, "city_2" => $fullName_2, "temp_1" => $temp_1, "temp_2" => $temp_2];
    }
    
    
    private function getFullName($cityData) {
        return $cityData->name . ', ' . $cityData->country;
    }
    

    
    private function getTemperature($cityId) {
        $filePath = Yii::getAlias("@app") . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "appid";
        $appId = trim(file_get_contents($filePath));
        $url = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&appid=" . $appId;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($ch);
        $obj = json_decode($str);
        if (isset($obj->main) && isset($obj->main->temp)) {
            return $obj->main->temp;
        } else {
            return "";
        }
    }
    
    
    
    private function getCityList() {
        $appAlias = Yii::getAlias("@app");
        $filePath = $appAlias . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "city.list.json";
        $str = file_get_contents($filePath);
        return json_decode($str);
    }
    
    public function actionSetting() {
        
    }
    
}

