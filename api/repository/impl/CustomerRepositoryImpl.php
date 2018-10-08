<?php
/**
 * Created by IntelliJ IDEA.
 * User: ranjith-suranga
 * Date: 7/20/18
 * Time: 3:42 PM
 */

require_once __DIR__ . '/../CustomerRepository.php';

class CustomerRepositoryImpl implements CustomerRepository
{

    private $connection;

//    public function __construct()
//    {
//        $this->connection = (new DBConnection())->getConnection();
//    }

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function saveCustomer($id, $nic, $name, $telno, $address)
    {
        $result = $this->connection->query("INSERT INTO Customer VALUES ('{$id}','{$nic}','{$name}','{$telno}','{$address}')");
//        echo $this->connection->error;
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function updateCustomer($id, $nic, $name, $telno, $address)
    {
        $result = $this->connection->query("UPDATE Customer SET nIC='{$nic}',name='{$name}',telNo='{$telno}',address='{$address}' WHERE cID='{$id}' ");
        echo $this->connection->error;
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function deleteCustomer($id)
    {
        $result = $this->connection->query("DELETE FROM Customer WHERE cID='{$id}'");
        return ($result && ($this->connection->affected_rows > 0));
    }

    public function findCustomer($id)
    {
        $resultset = $this->connection->query("SELECT * FROM Customer WHERE cID='{$id}'");
        return $resultset->fetch_assoc();
    }

    public function findAllCustomers()
    {
        $resultset = $this->connection->query("SELECT * FROM Customer");
        return $resultset->fetch_all(MYSQLI_ASSOC);
    }

}