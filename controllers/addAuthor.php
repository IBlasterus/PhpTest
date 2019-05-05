<?php

require_once '../entities/Authors.php';
require_once '../DB.php';

Author::addAuthorToBD($_POST['name']);
echo '<script type="text/javascript">location.replace("http://phptest/");</script>';