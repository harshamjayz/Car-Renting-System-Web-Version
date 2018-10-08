<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 25/07/2018
 * Time: 4:52 PM
 */

interface RentRepository
{
    public function setConnection(mysqli $connection);

    public function saveRent($cID,$vID,$rentalState,$rentFrom,$rentTo);

    public function updateRent($cID,$vID,$rentalState,$rentFrom,$rentTo);

    public function updateRentState($cID,$vID,$rentalState);

    public function deleteRent($cID,$vID);

    public function findRent($cID,$vID);

    public function findAllRent();

}