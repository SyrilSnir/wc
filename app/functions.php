<?php

use yii\helpers\VarDumper;
// Набор вспомогательных функций

/**
 * Дебаг
 * @param type $args
 */
function d(...$args) {
echo '
<pre>';
 for ($i = 0; $i < count($args); $i++) {
 VarDumper::dump($args[$i], 10, true);
 }
 echo '</pre>
';
}

/**
 * Дебаг с завершением работы
 * @param type $args
 */
function dd(...$args) {
    d(...$args);
    die();
}

function is_guest() {
    return Yii::$app->user->isGuest;
}