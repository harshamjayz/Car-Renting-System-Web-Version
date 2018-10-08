<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 24/07/2018
 * Time: 11:34 PM
 */

require_once __DIR__ ."/../VehicleBO.php";
require_once __DIR__ ."/../../db/DBConnection.php";
require_once __DIR__ ."/../../repository/impl/vehicleRepositoryImpl.php";

class vehicleBOImpl implements vehicleBO
{
    private $vehicleRepository;

    public function __construct()
    {
        $this->vehicleRepository= new vehicleRepositoryImpl();
    }

    public function getVehicleCount(){

        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $count  = count($this->vehicleRepository->findAllVehicles());

        mysqli_close($connection);

        return $count;

    }

    public function getavailable(){

        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $availables = $this->vehicleRepository->getavailable();

        mysqli_close($connection);

        return $availables;

    }

    public function saveVehicle($vID,$vNo,$category,$brand,$vRate,$state){

        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $result = $this->vehicleRepository->saveVehicle($vID,$vNo,$category,$brand,$vRate,$state);

        mysqli_close($connection);

        return $result;

    }

    public function updateVehicle($vID,$vNo,$category,$brand,$vRate,$state){

        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $result = $this->vehicleRepository->updateVehicle($vID,$vNo,$category,$brand,$vRate,$state);

        mysqli_close($connection);

        return $result;

    }

    public function updateVehiclestate($state,$vID){

        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $result = $this->vehicleRepository->updateVehiclestate($state,$vID);

        mysqli_close($connection);

        return $result;

    }


    public function getAllVehicles(){

        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $vehicles = $this->vehicleRepository->findAllVehicles();

        mysqli_close($connection);

        return $vehicles;

    }

    public function getVehicle($vID){

        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $vehicle = $this->vehicleRepository->findVehicle($vID);

        mysqli_close($connection);

        return $vehicle;

    }

    public function deleteVehicle($vID){

        $connection = (new DBConnection())->getConnection();
        $this->vehicleRepository->setConnection($connection);

        $result = $this->vehicleRepository->deleteVehicle($vID);

        mysqli_close($connection);

        return $result;
    }
}