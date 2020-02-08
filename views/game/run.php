<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Game';

?>

<h2 id="question">В каком городе теплее?</h2>
<h2 style="display: none;">Правильно!</h2>
<h2 style="display: none;">Неправильно!</h2>

<div data-number="1" id="block_1" class="city_block active_block"><?= $gameRoundArray['city_1'] ?><br/><span class="temp"></span></div>
<div data-number="2" id="block_2" class="city_block active_block"><?= $gameRoundArray['city_2'] ?><br/><span class="temp"></span></div>




