<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Game';

?>

<h2 id="header_question">В каком городе теплее?</h2>
<h2 style="display: none;" id="header_win">Правильно!</h2>
<h2 style="display: none;" id="header_lose">Неправильно!</h2>

<div class="active_blocks">
    <div data-number="1" class="block_1 city_block active_block"><?= $gameRoundArray['city_1'] ?></div>
    <div data-number="2" class="block_2 city_block active_block"><?= $gameRoundArray['city_2'] ?></div>
</div>

<div class="result_blocks" style="display: none;" >
   <div data-number="1" class="block_1 city_block"><?= $gameRoundArray['city_1'] ?><br/><span class="temp"></span></div>
   <div data-number="2" class="block_2 city_block"><?= $gameRoundArray['city_2'] ?><br/><span class="temp"></span></div> 
</div>



