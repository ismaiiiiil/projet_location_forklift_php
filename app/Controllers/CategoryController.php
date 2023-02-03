<?php

namespace app\Controllers;

use app\Models\Category;
use database\DB;

class CategoryController {
    private $cpt = 0;
    public $t = [];
    private $postData ;

    function __construct($post) {
        $this->postData = $post;
    }

    public function getAllCategories() {
        $db = new DB();
        $sql = 'SELECT * FROM categories';
        $res = $db::connection()->query($sql);

        while ( $row = $res->fetch() ) {
            $category = new Category($row[0], $row[1], $row[2]);
            $this->t[$this->cpt] = $category;
            $this->cpt++;
        }
    }

    public function getAllCategoriesSearch($search) {
        $db = new DB();
        $sql = 'SELECT * FROM categories WHERE nom LIKE ?';
        $stmt = $db::connection()->prepare($sql);
        $stmt->execute(['%' . $search . '%']);
        return $stmt->fetchAll();
    }

    public function getAllCategoriesByName($name) {
        $db = new DB();
        $sql = 'SELECT * FROM categories WHERE nom LIKE ?';
        $stmt = $db::connection()->prepare($sql);
        $stmt->execute([$name]);
        if($stmt->rowCount() > 0 ) {
            while ( $row = $stmt->fetch() ) {
                $category = new Category($row[0], $row[1], $row[2]);
                $this->t[$this->cpt] = $category;
                $this->cpt++;
            }
        }else {
            $this->getAllCategories();
        }
    }
}