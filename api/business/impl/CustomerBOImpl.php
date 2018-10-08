<?php
/**
 * Created by IntelliJ IDEA.
 * User: ranjith-suranga
 * Date: 7/20/18
 * Time: 3:58 PM
 */

require_once __DIR__ . '/../CustomerBO.php';
require_once __DIR__ . '/../../repository/impl/CustomerRepositoryImpl.php';
require_once __DIR__ . '/../../db/DBConnection.php';

class CustomerBOImpl implements CustomerBO
{

    private $customerRepository;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepositoryImpl();
    }

    public function getCustomersCount()
    {
        $connection = (new DBConnection())->getConnection();
        $this->customerRepository->setConnection($connection);

        $count =  count($this->customerRepository->findAllCustomers());

        mysqli_close($connection);

        return $count;
    }

//    public function calculateID(){
//        $firstID = "c001";
//        $connection = (new DBConnection())->getConnection();
//        $this->customerRepository->setConnection($connection);
//
//        $customers = $this->customerRepository->findAllCustomers();
//        if($customers == null){
//            $id = $firstID;
//        }else{
//            $size =sizeof($customers);
//            $lastid = $customers[$size-1];
//        }
//
//
//    }

    public function getAllCustomers()
    {

        $connection = (new DBConnection())->getConnection();
        $this->customerRepository->setConnection($connection);

        $customers = $this->customerRepository->findAllCustomers();

        mysqli_close($connection);

        return $customers;
    }

    public function getCustomer($id){

        $connection = (new DBConnection())->getConnection();
        $this->customerRepository->setConnection($connection);

        $customer = $this->customerRepository->findCustomer($id);

        mysqli_close($connection);

        return $customer;

    }

    public function deleteCustomer($id)
    {

        $connection = (new DBConnection())->getConnection();
        $this->customerRepository->setConnection($connection);

        $result = $this->customerRepository->deleteCustomer($id);

        mysqli_close($connection);

        return $result;
    }

    public function saveCustomer($id,$nic,$name,$telno,$address)
    {
        $connection = (new DBConnection())->getConnection();
        $this->customerRepository->setConnection($connection);

        $result = $this->customerRepository->saveCustomer($id,$nic,$name,$telno,$address);

        mysqli_close($connection);

        return $result;
    }

    public function updatecustomer($id,$nic,$name,$telno,$address)
    {
        $connection = (new DBConnection())->getConnection();
        $this->customerRepository->setConnection($connection);

        $result = $this->customerRepository->updateCustomer($id,$nic,$name,$telno,$address);

        mysqli_close($connection);

        return $result;
    }


}