<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 25/07/2018
 * Time: 4:51 PM
 */

require_once __DIR__."/../RentBo.php";
require_once __DIR__."/../../db/DBConnection.php";
require_once __DIR__."/../../repository/impl/RentRepositoryImpl.php";
require_once __DIR__."/../../repository/impl/vehicleRepositoryImpl.php";

class RentBOImpl implements RentBO
{
    private $rentRepository;
    private $vehicleRepository;
    public function __construct()
    {
        $this->rentRepository = new RentRepositoryImpl();
        $this->vehicleRepository = new vehicleRepositoryImpl();
    }

    public function saveRent($cID, $vID, $rentalState, $rentFrom, $rentTo)
    {
        $connection = (new DBConnection())->getConnection();
        $this->rentRepository->setConnection($connection);

        $result = $this->rentRepository->saveRent($cID, $vID, $rentalState, $rentFrom, $rentTo);

        mysqli_close($connection);

        return $result;

    }

    public function updateRent($cID, $vID, $rentalState, $rentFrom, $rentTo)
    {
        $connection = (new DBConnection())->getConnection();
        $this->rentRepository->setConnection($connection);

        $result = $this->rentRepository->updateRent($cID, $vID, $rentalState, $rentFrom, $rentTo);

        mysqli_close($connection);

        return $result;
    }

    public function updateRentState($cID,$vID,$rentalState){
        $connection = (new DBConnection())->getConnection();
        $this->rentRepository->setConnection($connection);

        $result = $this->rentRepository->updateRentState($cID,$vID,$rentalState);
        mysqli_close($connection);

        return $result;

    }

    public function deleteRent($cID, $vID)
    {
        $connection = (new DBConnection())->getConnection();
        $this->rentRepository->setConnection($connection);

        $result = $this->rentRepository->deleteRent($cID, $vID);

        mysqli_close($connection);

        return $result;
    }

    public function findRent($cID, $vID)
    {
        $connection = (new DBConnection())->getConnection();
        $this->rentRepository->setConnection($connection);

        $rent = $this->rentRepository->findRent($cID, $vID);

        mysqli_close($connection);

        return $rent;
    }

    public function getRentCount(){
        $connection = (new DBConnection())->getConnection();
        $this->rentRepository->setConnection($connection);

        $count = count($this->rentRepository->findAllRent());

        mysqli_close($connection);

        return $count;
    }

    public function findAllRent()
    {
        $connection = (new DBConnection())->getConnection();
        $this->rentRepository->setConnection($connection);

        $rents = $this->rentRepository->findAllRent();

        mysqli_close($connection);

        return $rents;
    }

    public function findAvailable()
    {
        $text = "finished";
        $avavehicles = array();
        $results = Array();

        $connection = (new DBConnection())->getConnection();
        $this->rentRepository->setConnection($connection);
        $this->vehicleRepository->setConnection($connection);

        $rents = $this->rentRepository->findAllRent();
        for($i=0 ; $i < count($rents); $i++){
            if($rents[$i] === $text){
                array_push($avavehicles,$row['vID']);
            }
        }
        for($i = 0; $i < count($avavehicles);$i++){
            $vehicle = $this->vehicleRepository->findVehicle($avavehicles[$i]);
            array_push($results,$vehicle);
        }

        mysqli_close($connection);

        return $results;

    }
}