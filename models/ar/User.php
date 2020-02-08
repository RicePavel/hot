<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\ar;

use yii\db\ActiveRecord;

class User extends ActiveRecord {
        
    public static function tableName() {
        return '{{user}}';
    }
    
    public function getGame() {
        return $this->hasOne(Game::className(), ['user_id' => 'user_id']);
    }
    
    public function getGameItems() {
        return $this->hasMany(GameItem::className(), ["user_id" => "user_id"]);
    }
    
    public function getSetting() {
        return $this->hasOne(Setting::className(), ['user_id' => 'user_id']);
    }
    
}