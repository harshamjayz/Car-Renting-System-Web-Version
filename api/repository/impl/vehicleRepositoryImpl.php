<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 24/07/2018
 * Time: 10:31 PM
 */

require_once __DIR__ ."/../vehicleRepository.php";

class vehicleRepositoryImpl implements VehicleRepository
{
    var $connection;

    public function setConnection(mysqli $connection){

        $this->connection = $connection;

    }

    public function saveVehicle($vID,$vNo,$category,$brand,$vRate,$state){
        $result = $this->connection->query("INSERT INTO vehicle VALUES ('{$vID}','{$vNo}','{$category}','{$brand}','{$vRate}','{$state}')");
        echo $this->connection->error;
        return($result && ($this->connection->affected_rows > 0));
    }

    public function updateVehicle($vID,$vNo,$category,$brand,$vRate,$state){

        $result = $this->connection->query("UPDATE vehicle SET vNo='{$vNo}',category='{$category}',brand='{$brand}',vRate='{$vRate}',state='{$state}' WHERE vID='{$vID}'");
        return($result && ($this->connection->affected_rows > 0));

    }

    public function updateVehiclestate($state,$vID){

        $result = $this->connection->query("UPDATE vehicle SET state='{$state}' WHERE vID='{$vID}'");
        echo $this->connection->error;
        return($result && ($this->connection->affected_rows > 0));

    }

    public function deleteVehicle($vID){

        $result = $this->connection->query("DELETE FROM vehicle WHERE vID='{$vID}'");
        echo $this->connection->error;
        return($result && ($this->connection->affected_rows > 0));

    }

    public function findVehicle($vID){

        $vehicle = $this->connection->query("select * from vehicle where vID='{$vID}'");
        return $vehicle->fetch_assoc();

    }

    public function getavailable()
    {
        $availables = $this->connection->query("SELECT * FROM vehicle WHERE state='free'");
        return $availables->fetch_all(MYSQLI_ASSOC);
    }

    public function findAllVehicles(){

        $vehicles = $this->connection->query("SELECT * FROM vehicle");
        return $vehicles->fetch_all(MYSQLI_ASSOC);

    }

}