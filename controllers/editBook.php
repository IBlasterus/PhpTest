<?php

require_once '../config.php';
require_once '../entities/Book.php';
require_once '../DB.php';

Book::editBookInBD($_POST['id'], $_POST['name']);
echo '<script type="text/javascript">location.replace("' . SELF_URL . '");</script>';