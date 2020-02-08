<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Game';

?>

<a class="btn btn-primary" href="<?= Url::to(['game/settings']) ?>" role="button">Настройки</a>

<h2 id="header_question">В каком городе теплее?</h2>
<h2 style="display: none;" id="header_win">Правильно!</h2>
<h2 style="display: none;" id="header_lose">Неправильно!</h2>
<div>Сумма набранных баллов:<span class="score"><?= $score ?></span></div>
<br/>

<div class="active_blocks">
    <div data-number="1" class="block_1 city_block active_block"><?= $gameRoundArray['city_1'] ?></div>
    <div data-number="2" class="block_2 city_block active_block"><?= $gameRoundArray['city_2'] ?></div>
</div>

<div class="result_blocks" style="display: none;" >
    <div data-number="1" class="block_1 city_block"><span class="city"><?= $gameRoundArray['city_1'] ?></span><br/><span class="temp"></span></div>
   <div data-number="2" class="block_2 city_block"><span class="city"><?= $gameRoundArray['city_2'] ?></span><br/><span class="temp"></span></div> 
</div>

<div style="clear: both;"></div> <br/><br/>

<div class="spinner lds-dual-ring" style="display: none;" ></div>

<button style="display: none;" type="button" class="button_next btn btn-success">Следующий</button>




