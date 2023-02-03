<?php
namespace app\Controllers;

use PDO;
use database\DB;
use PDOException;
use app\Models\Machine;

class MachineController {
    private $cpt = 0;
    public $t = [];
    // private $postData ;

    // function __construct($post) {
    //     $this->postData = $post;
    // }

    public function getMachineParCategory($id) {
        $db = new DB();
        $sql = 'SELECT * FROM machines
                JOIN image_machines 
                on machines.id_image = image_machines.id
                WHERE id_category =?';

        $result = $db::connection()->prepare($sql);
        $result->execute([$id]);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    function getMachineParId($id) {
        try {
            $db = new DB();
            $sql = 'SELECT * FROM machines
                    JOIN image_machines 
                    on machines.id_image = image_machines.id
                    WHERE machines.id =?';

            $result = $db::connection()->prepare($sql);
            $result->execute([$id]);
            return current( $result->fetchAll(PDO::FETCH_OBJ));
        }catch(PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
        
    }
}