<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 25/07/2018
 * Time: 4:37 PM
 */

require_once "business/impl/RentBOImpl.php";

header("content-Type:application/json");

$rentBO = new RentBOImpl();

$method = $_SERVER["REQUEST_METHOD"];

switch($method){
    case "GET":
        $action = $_GET["action"];

        switch ($action){
            case "one":
                $cID = $_GET["cID"];
                $vID = $_GET["vID"];
                echo json_encode($rentBO->findRent($cID,$vID));
                break;
            case "all":
                echo json_encode($rentBO->findAllRent());
                break;
            case "count":
                echo json_encode($rentBO->getRentCount());
            case "ava":
                echo json_encode($rentBO->findAvailable());
        }
        break;
    case "POST":
        $action = $_POST["action"];


        switch ($action){
            case "save":
                $cID = $_POST["cID"];
                $vID = $_POST["vID"];
                $rentalState = $_POST["rentalState"];
                $rentFrom = $_POST["rentFrom"];
                $rentTo = $_POST["rentTo"];
                echo json_encode($rentBO->saveRent($cID,$vID,$rentalState,$rentFrom,$rentTo));
                break;
            case "update":
                $cID = $_POST["cID"];
                $vID = $_POST["vID"];
                $rentalState = $_POST["rentalState"];
                $rentFrom = $_POST["rentFrom"];
                $rentTo = $_POST["rentTo"];
                echo json_encode($rentBO->updateRent($cID,$vID,$rentalState,$rentFrom,$rentTo));
                break;
            case "updatestatus":
                $cID = $_POST["cID"];
                $vID = $_POST["vID"];
                $rentalState = $_POST["rentalState"];
                echo json_encode($rentBO->updateRentState($cID,$vID,$rentalState));
                break;
        }
        break;
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $queryarray = preg_split("/&/",$queryString);
        if(count($queryarray) ===2){
            $cids = preg_split("/=/",$queryarray[0]);
            $cID=$cids[1];
            $vids = preg_split("/=/",$queryarray[1]);
            $vID=$vids[1];
            echo json_encode($rentBO->deleteRent($cID,$vID));
        }
        break;
}