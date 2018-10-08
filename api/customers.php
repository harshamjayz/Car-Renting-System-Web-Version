<?php
/**
 * Created by IntelliJ IDEA.
 * User: ranjith-suranga
 * Date: 7/20/18
 * Time: 3:08 PM
 */

require_once 'business/impl/CustomerBOImpl.php';

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$customerBO = new CustomerBOImpl();

switch ($method){
    case "GET":
        $action = $_GET["action"];

        switch($action){
            case "count":
                echo json_encode($customerBO->getCustomersCount());
                break;
            case "all":
                echo json_encode($customerBO->getAllCustomers());
                break;
            case "row":
                $cusID = $_GET["id"];
                echo json_encode($customerBO->getCustomer($cusID));
                break;
        }

        break;
    case "POST":
        $action = $_POST["action"];
        $id = $_POST["id"];
        $nic = $_POST["nic"];
        $name = $_POST["name"];
        $telno = $_POST["telno"];
        $address = $_POST["address"];

//        echo "WOrking";

        switch ($action){
            case"save":
                echo json_encode($customerBO->saveCustomer($id,$nic,$name,$telno,$address));

                break;
            case"update":
                echo json_encode($customerBO->updatecustomer($id,$nic,$name,$telno,$address));
                break;
        }
        break;
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $queryArray = preg_split("/=/",$queryString);
        if (count($queryArray) === 2){
            $id = $queryArray[1];
            echo json_encode($customerBO->deleteCustomer($id));
        }
        break;
}