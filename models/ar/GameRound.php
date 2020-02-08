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
    
    public static function getTemperatureText($setting, $temperature) {
        $unit = Setting::getDefaultUnit();
        if ($setting && $setting->unit) {
            $unit = $setting->unit;
        }
        if ($unit == Setting::CELSIUS_UNIT) {
            return GameRound::kelvinToCelsiusText($temperature);
        } else if ($unit == Setting::FAHRENHEIT_UNIT) {
            return GameRound::kelvinToFarengheitText($temperature);
        } else {
            return "";
        }
    }
    
    public function getTempText_1($setting) {
        return self::getTemperatureText($setting, $this->temp_1);
    }
    
    public function getTempText_2($setting) {
        return self::getTemperatureText($setting, $this->temp_2);
    }
    
    private static function kelvinToCelsiusText($grad) {
        return round($grad - 273.15, 2) . " °C";
    }
    
    private static function kelvinToFarengheitText($grad) {
        return round(1.8 * ($grad - 273) + 32, 2) . " °F";
    }
    
}