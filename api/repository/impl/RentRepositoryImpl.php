<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 25/07/2018
 * Time: 4:52 PM
 */

require_once __DIR__."/../RentRepository.php";

class RentRepositoryImpl implements RentRepository
{
    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function saveRent($cID, $vID, $rentalState, $rentFrom, $rentTo)
    {
        $result = $this->connection->query("INSERT INTO rentaldetail VALUES('{$cID}','{$vID}','{$rentalState}','{$rentFrom}','{$rentTo}')");
        echo $this->connection->error;
        return ($result && $this->connection->affected_rows > 0);
    }

    public function updateRent($cID, $vID, $rentalState, $rentFrom, $rentTo)
    {

        $result = $this->connection->query("UPDATE rentalDetail SET rentalState='{$rentalState}',rentFrom='{$rentFrom}',rentTo='{$rentTo}' WHERE cID='{$cID}' && vID='{$vID}' ");
        return ($result && $this->connection->affected_rows > 0);

    }

    public function updateRentState($cID,$vID,$rentalState){

        $result = $this->connection->query("UPDATE rentalDetail SET rentalState='{$rentalState}' WHERE cID='{$cID}' && vID='{$vID}' ");
        return ($result && $this->connection->affected_rows > 0);
    }

    public function deleteRent($cID, $vID)
    {

        $result = $this->connection->query("DELETE FROM rentaldetail WHERE cID='{$cID}' && vID='{$vID}'");
        echo $this->connection->error;
        return ($result && $this->connection->affected_rows > 0);

    }

    public function findRent($cID, $vID)
    {

        $rent = $this->connection->query("SELECT * FROM rentaldetail WHERE cID='{$cID}' && vID='{$vID}'");
        return $rent->fetch_assoc();

    }

    public function findAllRent()
    {
        $rents = $this->connection->query("SELECT * FROM rentaldetail");
        return $rents->fetch_all(MYSQLI_ASSOC);
    }
}