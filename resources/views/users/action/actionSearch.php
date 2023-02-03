<?php
use app\Controllers\CategoryController;
require_once '../../../../vendor/autoload.php';

// use app\Controllers\CategoryController;


$category = new CategoryController($_POST) ;


if(isset($_POST['query'])) {
    $res =  $category->getAllCategoriesSearch($_POST['query']);
    if ($res) {
        foreach ($res as $row) {
            echo '<a onclick="hideLink()" class="link">'. $row['nom'] . '</a>';
        }
    } else {
        echo '<p class="link-notfound">No Record</p>';
    }
}