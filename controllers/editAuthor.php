<?php

require_once '../config.php';
require_once '../entities/Author.php';
require_once '../DB.php';

Author::editAuthorInBD($_POST['id'], $_POST['name']);
echo '<script type="text/javascript">location.replace("' . SELF_URL . '");</script>';