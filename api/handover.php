<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 27/07/2018
 * Time: 12:13 AM
 */

require_once 'business/impl/handoverBOImpl.php';

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

$HandoverBO = new HandoverBOImpl();

switch ($method) {
    case "GET":
        $action = $_GET["action"];

        switch ($action) {
            case "difference":
                $fromDate = $_GET["fromDate"];
                $toDate = $_GET["toDate"];
                echo json_encode($HandoverBO->getdifference($fromDate, $toDate));
                break;
        }
        break;
}