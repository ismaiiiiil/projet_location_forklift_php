<?php

use app\Controllers\CalendrierController;

$calendrie = new CalendrierController($_GET);

$calendrie->deleteDate($id);