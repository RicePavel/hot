<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

use app\models\ar\Setting;

$this->title = 'Game';

?>

<a class="btn btn-primary" href="<?= Url::to(['game/run']) ?>" role="button">Играть</a>

<h2>Настройки</h2>
<h3>Единицы измерения</h3>
<form>
    <input type="radio" class="unit_radio" name="units" value="<?= Setting::CELSIUS_UNIT ?>"  <?= ($unit == Setting::CELSIUS_UNIT ? 'checked' : '') ?> id="celsius"/> <label for="celsius">градусы Цельсия - °C</label> <br/>
    <input type="radio" class="unit_radio" name="units" value="<?= Setting::FAHRENHEIT_UNIT ?>" <?= ($unit == Setting::FAHRENHEIT_UNIT ? 'checked' : '') ?> id="fahrenheit"/> <label for="fahrenheit">градусы Фаренгейта - °F</label>
</form>

<h2>История</h2>
<div>Сумма набранных баллов:<span class="score"><?= $score ?></span></div>
<br/>

<?php foreach ($rounds as $round): ?>
<?php 

    $cssClass = ($round->score == 1 ? "win_block" : "lose_block");

?>
    <div class="active_blocks">
        <div class="city_block <?= ($round->selected == 1 ? $cssClass : "") ?>"><?= $round->city_1 ?><br/><span class="temp"><?= $round->getTempText_1($setting) ?></span></div>
        <div class="city_block <?= ($round->selected == 2 ? $cssClass : "") ?>"><?= $round->city_2 ?><br/><span class="temp"><?= $round->getTempText_2($setting) ?></span></div>
    </div>
    <div style="clear: both;"></div> <br/>
<?php endforeach; ?>
