<?php

require_once '../entities/Authors.php';
require_once '../DB.php';

Author::deleteAuthorInBD($_POST['id']);
echo '<script type="text/javascript">location.replace("http://phptest/");</script>';