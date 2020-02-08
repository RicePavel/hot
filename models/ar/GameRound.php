<?php

namespace app\models\ar;

use yii\db\ActiveRecord;

class GameRound extends ActiveRecord {
        
    public static function tableName() {
        return '{{game_round}}';
    }
    
    public function getUser() {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
    
}