<?php

use app\Controllers\MachineController;

require_once '../../../vendor/autoload.php';


$machines = new MachineController($_POST) ;
$machine = $machines->getMachineParId(2);

echo $machine->image3;


$filename = "../../../public/images/$machine->image3";

echo $filename;
if(file_exists($filename)) {
    unlink($filename);
    echo 'File '.$filename.' has been deleted';
}