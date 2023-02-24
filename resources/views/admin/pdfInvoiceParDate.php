<?php



use Dompdf\Dompdf;
use Dompdf\Options;
use app\Controllers\BaseController;
use app\Controllers\OrderController;
use app\Controllers\MachineController;
use app\Controllers\WebSiteController;

$web = new WebSiteController($_POST);
$website = $web->getInfoWebSite();


$machine = new MachineController($_POST);
$machines = $machine->getAllMachinObj();

$order = new OrderController;

$nom = $_SESSION['nom_user'];
$email = $_SESSION['email_user'];

if (isset($_POST)) {
  $date_order = $_POST['date_order'];
  $email = $_POST['email_user'];
} else {
  BaseController::redirect("../profil-user");
}



$orderuser = $order->getOrderByDateEmail($date_order, $email);

// var_dump($orderuser);

if (count($orderuser) < 1) {
  BaseController::redirect("../profil-user");
}
$Total = 0;
foreach ($orderuser as $order) {
  $Total += (float)$order->prix;
}
// echo $date_order;

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    * {
      box-sizing: border-box;
      padding: 0px;
      margin: 0px;
    }

    body,
    html {
      font-family: "Roboto", serif;
      font-size: 16px;
      background: #F4F4F4;
      line-height: 1.5;
    }

    .header {
      display: flex;
      background: #fff;
      padding: 15px 20px;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 2rem;
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
    }

    .header .logo {
      font-size: 32px;
      font-weight: bold;
      color:#0034BB;
    }

    .header .search {
      position: relative;
    }

    .header .search .icon {
      position: absolute;
      top: 5px;
      left: 5px;
    }

    .header .search .icon img {
      width: 24px;
      height: 24px;
      object-fit: cover;
    }

    .header .search .form-control {
      padding: 8px 10px;
      border-radius: 8px;
      font-size: 1rem;
      width: 100%;
      background: #0034BB;
      border: 1px solid transparent;
      color: #2B2B2B;
      padding-left: 40px;
      outline: 0px;
    }

    .header .search .form-control:focus {
      background: #fff;
      border-color: #0034BB;
    }

    .header .search .form-control::placeholder {
      color:#0034BB;
    }

    .main-content {
      padding: 0px 20px;
    }

    .invoice-container {
      max-width: 800px;
      margin: auto;
      padding: 3rem;
      background: #fff;
    }

    .invoice-container .top {
      margin-bottom: 4rem;
      display: flex;
      justify-content: space-between;
    }

    .invoice-container .top .top-left {
      color: #0034BB;
    }

    .invoice-container .top .main {
      font-size: 40px;
      text-transform: uppercase;
      font-weight: 500;
      display: block;
      margin-bottom: 0.5rem;
    }

    .invoice-container .top .code {
      font-size: 24px;
    }

    .invoice-container .top .date {
      font-size: 18px;
      color: #ADADAD;
      margin-bottom: 10px;
    }

    .bill-box {
      display: flex;
      justify-content: space-between;
      margin-bottom: 4rem;
      color: #ADADAD;
    }

    .bill-box .left,
    .bill-box .right {
      max-width: 240px;
    }

    .bill-box .text-m {
      font-size: 18px;
      margin-bottom: 1rem;
      text-transform: uppercase;
    }

    .bill-box .title {
      font-size: 2rem;
      margin-bottom: 1rem;
      font-weight: 500;
      color: #2B2B2B;
    }

    .table-bill table {
      width: 100%;
      border-collapse: 0px;
      border-spacing: 0px;
      font-size: 1rem;
    }

    .table-bill th,
    .table-bill td {
      text-align: left;
      padding: 10px 10px;
      font-weight: 500;
    }

    .table-bill td {
      padding: 15px 10px;
    }

    .table-bill th {
      text-transform: uppercase;
      color: #0034BB;
      font-weight: 500;
    }

    .table-bill .quantity {
      width: 100px;
    }

    .table-bill .cost {
      text-align: right;
      white-space: nowrap;
    }

    .table-bill .total {
      font-size: 24px;
      color: #0034BB;
    }

    .table-bill .total td {
      font-weight: normal;
      border-top: 1px solid #ececec;
    }

    .table-bill .total .number {
      text-align: right;
      font-weight: 600;
    }

    .actions {
      text-align: center;
      margin-top: 4rem;
    }

    .actions .btn {
      margin: 3px;
      padding: 8px 10px;
      font-size: 1rem;
      text-transform: uppercase;
      font-weight: bold;
      border: 0px;
      min-width: 130px;
      color: #0034BB;
      border-radius: 8px;
      background: rgba(0, 52, 187, 0.06);
      cursor: pointer;
    }

    .actions .btn:hover {
      background: rgba(0, 52, 187, 0.1);
    }

    .note {
      text-align: center;
      margin-top: 1rem;
      font-size: 12px;
      color: #ADADAD;
    }

    @media (max-width: 1320px) {

      body,
      html {
        font-size: 14px;
      }

      .invoice-container .top .date {
        font-size: 14px;
      }

      .invoice-container .top .main {
        font-size: 32px;
      }

      .invoice-container .top .code {
        font-size: 18px;
      }

      .bill-box .text-m {
        font-size: 14px;
      }

      .bill-box .title {
        font-size: 1.5rem;
      }

      .table-bill .total {
        font-size: 16px;
      }
    }

    @media (max-width: 768px) {
      .invoice-container .top {
        display: block;
      }

      .invoice-container .top .top-left {
        margin-bottom: 1rem;
      }

      .bill-box {
        display: block;
      }

      .bill-box .left,
      .bill-box .right {
        max-width: 100%;
      }

      .table-bill table,
      .table-bill tbody,
      .table-bill tfoot,
      .table-bill td,
      .table-bill th,
      .table-bill tr {
        display: block;
      }

      .table-bill th {
        display: none;
      }

      .table-bill tbody tr {
        padding: 10px 0px;
        border-bottom: 1px solid #e5e5e5;
      }

      .table-bill tbody tr td:first-child {
        display: none;
      }

      .table-bill td {
        padding: 5px 0px;
      }

      .table-bill .cost {
        text-align: left;
      }

      .table-bill .total {
        margin-top: 20px;
      }

      .table-bill .total td {
        border-top: 0px;
      }

      .table-bill .total .number {
        text-align: left;
      }
    }

    @media (max-width: 420px) {
      .actions .btn {
        width: 100%;
        margin: 5px 0px;
      }

      .header {
        display: block;
      }
    }
  </style>
</head>
<body>
<div class="main-content">
<div class="invoice-container">
    <div class="top">
        <div class="top-left">
          <div style="display: flex;">
          <img src="../public/images/website/'. $website->logo .'" width="70" height="60" />
          <h1 class="main" style="margin: 3px 25px;">'. $website->nom_website .'</h1>
        </div>
            <span class="code">
            # Facture nom: ' . $nom . ', Email: ' . $email . '
            </span>
        </div>
        <div class="top-right">
            <div class="date">Tel: '. $website->tel1 .'</div>
            <div class="date">Tel: '. $website->tel1 .'</div>
        </div>
    </div>
    <div class="bill-box">
        <div class="left">
            <div class="text-m">Location :</div>
            <div class="title">'. $website->nom_website .' Service</div>
            <div class="addr">Address : '. $website->localisation .'</div>
        </div>
        
    </div>
    <div class="table-bill">
        <table class="table-service">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nom de machine</th>
                <th>Quantité</th>
                <th>Nombre de jours</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Prix</th>
                </tr>
            </thead>
            <tbody>';
$i = 1;
$nameMachine = "";


foreach ($orderuser as $order) {
  foreach ($machines as $m) :
    if ($order->id_machine == $m->id) :
      $nameMachine = $m->nom;
    endif;
  endforeach;
  $datetime1 = strtotime($order->date_order);
  $datetime2 = strtotime($order->date_fin);

  $secs = $datetime2 - $datetime1;// == <seconds between the two times>
  $days = $secs / 86400;
  $html .= '<tr>
                <td>' . $i . '</td>
                <td>' . $nameMachine . '</td>
                <td>' . $order->qte . '</td>
                <td>' . $days . '</td>
                <td>' . $order->date_order . '</td>
                <td>' . $order->date_fin . '</td>
                <td>' . $order->prix . ' Dh</td> </tr>';
  $i++;
}

$html .= '
            </tbody>
            <tfoot>
                <tr class="total">
                    <td class="name" colspan="4">Total</td>
                    <td colspan="2" class="number">' . $Total . ' Dh</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="note">
        <p>Merci de travailler avec nous!</p>
        <p>'. $website->nom_website .' </p>
    </div>
</div>
</div>
</body>
</html>';




// use Dompdf\Dompdf;
$options = new Options();
$options->set('defaultFont', 'Courier');
// $options->set('chroot', realpath(''));
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream("playerofcode", array("Attachment" => 0));
