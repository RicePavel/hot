<?php

namespace app\models\ar;

use yii\db\ActiveRecord;

class Setting extends ActiveRecord {
        
    const CELSIUS_UNIT = 1;
    const FAHRENHEIT_UNIT = 2;
    
    public static function getDefaultUnit() {
        return self::CELSIUS_UNIT;
    }
    
    public function getUser() {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
    
    public static function tableName() {
        return '{{setting}}';
    }
    
}