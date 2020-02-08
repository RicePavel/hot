<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\ar;

use yii\db\ActiveRecord;
use yii\db\Query;

class User extends ActiveRecord {
        
    public static function tableName() {
        return '{{user}}';
    }
        
    public function getGameRounds() {
        return $this->hasMany(GameRound::className(), ["user_id" => "user_id"]);
    }
    
    public function getSetting() {
        return $this->hasOne(Setting::className(), ['user_id' => 'user_id']);
    }
    
    public function getScore() {
        $query = new \yii\db\Query();
        $score = $query->from("game_round")->where(['user_id' => $this->user_id])->sum('score');
        return $score;
    }
    
}