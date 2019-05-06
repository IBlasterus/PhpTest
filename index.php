<?php

require_once 'config.php';
require_once 'MainContentBuilder.php';
require_once 'DB.php';

// Строим и выводим основную форму
$mainForm = new MainContentBuilder();
$mainForm->build();