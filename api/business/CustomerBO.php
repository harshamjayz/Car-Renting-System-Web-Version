<?php
/**
 * Created by IntelliJ IDEA.
 * User: ranjith-suranga
 * Date: 7/20/18
 * Time: 3:58 PM
 */

interface CustomerBO
{
    public function saveCustomer($id,$nic,$name,$telno,$address);

    public function updatecustomer($id,$nic,$name,$telno,$address);

    public function getCustomersCount();

//    public function calculateID();

    public function getAllCustomers();

    public function getCustomer($id);

    public function deleteCustomer($id);

}