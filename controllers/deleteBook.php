<?php

require_once '../entities/Book.php';
require_once '../DB.php';

Book::deleteBookInBD($_POST['id']);
echo '<script type="text/javascript">location.replace("http://phptest/");</script>';