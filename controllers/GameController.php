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

use app\models\GameModel;

class GameController extends Controller
{
    
    public function actionRun() {
        $score = $this->getScore();
        $gameModel = new GameModel();
        $gameRoundArray = $gameModel->getGameRoundArray();
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
        $resultArray = ["selected" => $selected, "win" => $win, "score" => 0, "city_1" => $gameRoundArray->city_1, "city_2" => $gameRoundArray->city_2, "temp_1" => $temp_1, "temp_2" => $temp_2];
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
        $score = $this->getScore();
        $gameModel = new GameModel();
        $gameRoundArray = $gameModel->getGameRoundArray();
        \Yii::$app->session->set("gameRoundArray", $gameRoundArray);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['score' => $score, 'city_1' => $gameRoundArray['city_1'], 'city_2' => $gameRoundArray['city_2']];
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
        
}

