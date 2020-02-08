<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class GameModel extends Model
{
    
    /**
     * [
     *  'city_i' => "",
     * 'city_2' => "",
     * 'temp_1' => "",
     * 'temp_2' => ""
     * ]
     */
    public function getGameRoundArray() {
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
    
}

