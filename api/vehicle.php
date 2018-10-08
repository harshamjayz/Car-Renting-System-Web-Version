<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 24/07/2018
 * Time: 10:07 PM
 */


require_once 'business/impl/vehicleBOImpl.php';

header("content-type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$vehicleBO = new vehicleBOImpl();

switch ($method){
        case "GET":
            $action = $_GET["action"];
            switch ($action){
                case "all":
                    echo json_encode($vehicleBO->getAllVehicles());
                    break;
            case "count":
                echo json_encode($vehicleBO->getVehicleCount());
                break;
            case "one":
                $vID = $_GET["ID"];
                echo json_encode($vehicleBO->getVehicle($vID));
                break;
            case "ava":
                echo json_encode($vehicleBO->getavailable());
                break;
        }
        break;
    case "POST":
        $action = $_POST["action"];


        switch ($action){
            case "save":
                $vID = $_POST["vID"];
                $vNo = $_POST["vNo"];
                $category = $_POST["category"];
                $brand = $_POST["brand"];
                $vRate = $_POST["vRate"];
                $state = $_POST["state"];
                echo json_encode($vehicleBO->saveVehicle($vID,$vNo,$category,$brand,$vRate,$state));
                break;
            case "update":
                $vID = $_POST["vID"];
                $vNo = $_POST["vNo"];
                $category = $_POST["category"];
                $brand = $_POST["brand"];
                $vRate = $_POST["vRate"];
                $state = $_POST["state"];
                echo json_encode($vehicleBO->updateVehicle($vID,$vNo,$category,$brand,$vRate,$state));
                break;
            case "updateState":
                $vID = $_POST["vID"];
                $state= $_POST["state"];
                echo json_encode($vehicleBO->updateVehiclestate($state,$vID));
        }
        break;
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $queryArray = preg_split("/=/",$queryString);
        if (count($queryArray) === 2) {
            $vID = $queryArray[1];
            echo json_encode($vehicleBO->deleteVehicle($vID));
        }
        break;
}