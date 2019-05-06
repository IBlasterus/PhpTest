<?php

require_once '../config.php';
require_once '../entities/Book.php';
require_once '../DB.php';

Book::deleteAuthorFromBookInBD($_POST['book_id'], $_POST['author_id']);
echo '<script type="text/javascript">location.replace("' . SELF_URL . '");</script>';