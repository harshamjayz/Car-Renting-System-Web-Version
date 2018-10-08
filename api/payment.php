<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 27/07/2018
 * Time: 9:00 PM
 */
require_once 'business/impl/PaymentBOImpl.php';

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$paymentBO = new PaymentBOImpl();

switch ($method) {
//    case "GET":
//        $action = $_GET["action"];
//
//        switch($action){
//            case "count":
//                echo json_encode($customerBO->getCustomersCount());
//                break;
//            case "all":
//                echo json_encode($customerBO->getAllCustomers());
//                break;
//            case "row":
//                $cusID = $_GET["id"];
//                echo json_encode($customerBO->getCustomer($cusID));
//                break;
//        }
//
//        break;
    case "POST":
        $action = $_POST["action"];
        $pID = 0;
        $cID = $_POST["cID"];
        $vID = $_POST["vID"];
        $pMethod = $_POST["pMethod"];
        $paneltyFee = $_POST["paneltyFee"];
        $totalAmount = $_POST["totalAmount"];

        switch ($action) {
            case"save":
                echo json_encode($paymentBO->savepayment($pID,$cID, $vID, $pMethod, $paneltyFee, $totalAmount));
                break;
            case"update":
                echo json_encode($paymentBO->updatePayment($pID,$cID, $vID, $pMethod, $paneltyFee, $totalAmount));
                break;
        }
        break;

}