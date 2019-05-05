<?php

require_once '../entities/Book.php';
require_once '../DB.php';

Book::addBookToBD($_POST['name']);
echo '<script type="text/javascript">location.replace("http://phptest/");</script>';