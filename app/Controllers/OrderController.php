<?php

namespace app\Controllers;

use PDO;
use database\DB;
use PDOException;
use app\Models\Order;
use app\Controllers\WebSiteController;

class OrderController
{
    public $t = [];
    private $cpt = 0;

    function createOrder($data)
    {
        try {
            $sql = "INSERT INTO orders (id, nom_user,email_user , id_machine, number_jours, qte, prix, date_order,date_fin, delivrer, payer, machine_revenir) 
                    VALUES(NULL,?,?,?,?,?,?, now(),?, 0, 1, 0)";
            $stmt = DB::connection()->prepare($sql);
            $res = $stmt->execute([
                $data["nom_user"],
                $data["email_user"],
                $data["id_machine"],
                $data["number_jours"],
                $data["qte"],
                $data["total"],
                $data["date_fin"]
            ]);
            if ($res) {

                // ----------------------------
                // SEND EMAIL
                $this->sendEmail();
                // END EMAIL
                // ------------------------
                foreach ($_SESSION as $name => $machine) { // vider panier
                    if (substr($name, 0, 9) == "machines_") {
                        unset($_SESSION[$name]);
                        unset($_SESSION["count"]);
                        unset($_SESSION["totaux"]);
                    }
                }

                $_SESSION["commander"] = 1;
                $baseurl = BASE_URL;

                // -------------------------------------
                BaseController::set("success", "Commande effectuée avec succés<a href=\"$baseurl" . "admin/pdfinvoice\"> Pour télécharger Votre facture cliquer içi </a>");
                BaseController::redirect("cart");
            }
        } catch (PDOException $e) {
            echo "Error adding" . $e->getMessage();
        }
    }

    function sendEmail()
    {
        $email = $_SESSION['email_user'];

        $subject = "Email Verification Code";
        $sender = "From: <Engiloc@gmail.com>\r\n";
        $sender .= "MIME-Version: 1.0\r\n";
        $sender .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // create the html message
        // WEB SITE INFO
        $web = new WebSiteController($_POST);
        $infoWeb = $web->getInfoWebSiteAssoc();
        // USER INFO
        $nom_user = $_SESSION['nom_user'];
        // CREATE THE SWAP VARIABLES ARRAY
        $swap_var = array(
            "{SITE_LOGO}" => $infoWeb["logo"], //site
            "{SITE_NAME}" => $infoWeb["nom_website"],
            "{SITE_MAIL}" => $infoWeb["adresse1"],
            "{SITE_NUMERO}" => $infoWeb["tel1"],

            "{USER_NAME}" => $nom_user
        );
        // ------------
        $template_file = "./resources/views/users/sendEmailImportMachine.php";
        if (file_exists($template_file))
            $message = file_get_contents($template_file);
        else
            die("unable to load template");

        // search replace all the swap_vars
        foreach (array_keys($swap_var) as $key) {
            if (strlen($key) > 2 && trim($key) != "") {
                $message = str_replace($key, $swap_var[$key], $message);
            }
        }
        mail($email, $subject, $message, $sender);
    }

    function getAllOrders()
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM orders";
            $stmt = $db::connection()->query($sql);
            while ($row = $stmt->fetch()) {
                $order = new Order($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11]);
                $this->t[$this->cpt] = $order;
                $this->cpt++;
            }
        } catch (PDOException $e) {
            echo "Error getting all" . $e->getMessage();
        }
    }

    function getAllOrdersNotification()
    {
        try {
            $db = new DB();
            $sql = "SELECT *,orders.id id_order, machines.nom nom_machine FROM orders 
                    JOIN users ON orders.email_user = users.email
                    JOIN machines on orders.id_machine = machines.id
                    ORDER BY orders.date_order DESC";
            $stmt = $db::connection()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error getting all" . $e->getMessage();
        }
    }
    function getOrdersNotificationById($id)
    {
        try {
            $db = new DB();
            $sql = "SELECT *,orders.id id_order, machines.nom nom_machine FROM orders 
                    JOIN users ON orders.email_user = users.email
                    JOIN machines on orders.id_machine = machines.id
                    WHERE orders.id = ?
                    ORDER BY orders.date_order DESC";
            $res = $db::connection()->prepare($sql);
            $res->execute([$id]);
            return current($res->fetchAll(PDO::FETCH_OBJ));
        } catch (PDOException $e) {
            echo "Error getting all" . $e->getMessage();
        }
    }

    function getOrderById($id)
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM orders WHERE id = ?";
            $res = $db::connection()->prepare($sql);
            $res->execute([$id]);
            return current($res->fetchAll(PDO::FETCH_OBJ));
        } catch (PDOException $e) {
            echo "Error fetching" . $e->getMessage();
        }
    }

    function getOrderNomEmail($nom, $email)
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM orders WHERE 
                                nom_user = ? AND 
                                email_user = ? AND 
                                date_order = CURRENT_DATE()";
            $res = $db::connection()->prepare($sql);
            $res->execute([$nom, $email]);
            return $res->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    function getOrderByDateEmail($date, $email)
    {
        try {
            $db = new DB();
            $sql = "SELECT * FROM orders WHERE 
                                email_user = ? AND 
                                date_order = ?";
            $res = $db::connection()->prepare($sql);
            $res->execute([$email, $date]);
            return $res->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getAllOrdersSearch()
    {
        try {
            $db =  new DB();
            $sql = "SELECT * FROM orders JOIN users on orders.email_user = users.email
            WHERE orders.id <> 0";
            $res = $db::connection()->query($sql);
            return $res->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function getAllOrdersByNameAndEntreprise($nomUser, $isEntreprise)
    {
        try {
            $db = new DB();
            if (!empty($nomUser)) {
                if ($isEntreprise == 1) {
                    $sql = "SELECT * FROM orders 
                            JOIN users on orders.email_user = users.email
                            WHERE orders.email_user LIKE ? AND users.is_entreprise = 1";
                } elseif ($isEntreprise == 0) {
                    $sql = "SELECT * FROM orders 
                            JOIN users on orders.email_user = users.email
                            WHERE orders.email_user LIKE ? AND users.is_entreprise = 0";
                } else {
                    $sql = "SELECT * FROM orders 
                            JOIN users on orders.email_user = users.email
                            WHERE orders.email_user LIKE ?  ";
                }
                $res = $db::connection()->prepare($sql);
                $res->execute(["%" . $nomUser . "%"]);
            } elseif (empty($nomUser)) {
                if ($isEntreprise == 1) {
                    $sql = "SELECT * FROM orders 
                            JOIN users on orders.email_user = users.email
                            WHERE users.is_entreprise = 1";
                } elseif ($isEntreprise == 0) {
                    $sql = "SELECT * FROM orders 
                            JOIN users on orders.email_user = users.email
                            WHERE users.is_entreprise = 0";
                } else {
                    $sql = "SELECT * FROM orders JOIN users on orders.email_user = users.email
                            WHERE orders.id <> 0";
                }
                $res = $db::connection()->query($sql);
                $res->execute();
            }

            while ($row = $res->fetch()) {
                $order = new Order($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11]);
                $this->t[$this->cpt] = $order;
                $this->cpt++;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteOrder($id)
    {
        try {
            $db = new DB();
            $sql = "DELETE FROM orders WHERE id = ?";
            $res = $db::connection()->prepare($sql);
            $res->execute([$id]);
            BaseController::set('success', "Order successfully deleted");
            BaseController::redirect("orders");
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }


    function delivredOrder($id)
    {
        try {
            $db = new DB();
            $sql = "UPDATE orders SET delivrer = 1 WHERE id = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            if ($stmt) {
                BaseController::set('success', "Order été livré avec succès");
                BaseController::redirect("orders");
            }
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

    function notDelivredOrder($id)
    {
        try {
            $db = new DB();
            $sql = "UPDATE orders SET delivrer = 0 WHERE id = ?";
            $stmt = $db::connection()->prepare($sql);
            $stmt->execute([$id]);
            if ($stmt) {
                BaseController::set('success', "Order n'a pas été livré avec succès");
                BaseController::redirect("orders");
            }
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }


    // 
    function gettDateOrder()
    {
        try {
            $db = new DB();
            $sql = "SELECT DISTINCT date_order FROM orders WHERE nom_user = ? AND email_user = ?";
            $nom_user = $_SESSION['nom_user'];
            $email_user = $_SESSION['email_user'];
            $res = $db::connection()->prepare($sql);
            $res->execute([$nom_user, $email_user]);
            return $res->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
}
