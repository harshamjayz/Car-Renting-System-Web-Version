<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 27/07/2018
 * Time: 9:37 PM
 */

require_once __DIR__ . '/../PaymentRepository.php';

class PaymentRepositoryImpl implements PaymentRepository
{

    private $connection;

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function savePayment($pID, $cID, $vID, $pMethod, $paneltyFee, $totalAmount)
    {
        $result = $this->connection->query("INSERT INTO payment (cID,vID,pMethod,paneltyFee,totalAmount)  VALUES('{$cID}','{$vID}','{$pMethod}','{$paneltyFee}','{$totalAmount}')");
        echo $this->connection->error;
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updatePayment($pID, $cID, $vID, $pMethod, $paneltyFee, $totalAmount)
    {
        $result = $this->connection->query("UPDATE payment SET pMethod='{$pMethod}',paneltyFee='{$paneltyFee}',totalAmount='{$totalAmount}' WHERE pID='{$pID}' cID='{$cID}',vID='{$vID}'  ");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deletePayment($pID, $cID, $vID)
    {
        $result = $this->connection->query("DELETE FROM payment WHERE pID='{$pID}' cID='{$cID}',vID='{$vID}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function findPayment($pID, $cID, $vID)
    {
        $resultset = $this->connection->query("SELECT * FROM payment WHERE pID='{$pID}' cID='{$cID}',vID='{$vID}'");
        return $resultset->fetch_assoc();
    }

    public function findAllPayment()
    {
        $resultset = $this->connection->query("SELECT * FROM payment");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }
}