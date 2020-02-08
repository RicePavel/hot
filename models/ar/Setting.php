<?php

namespace app\models\ar;

use yii\db\ActiveRecord;

class Setting extends ActiveRecord {
        
    public static function tableName() {
        return '{{setting}}';
    }
    
}