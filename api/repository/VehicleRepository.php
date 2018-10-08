<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 24/07/2018
 * Time: 10:15 PM
 */

interface VehicleRepository
{
    public function setConnection(mysqli $connection);

    public function saveVehicle($vID,$vNo,$category,$brand,$vRate,$state);

    public function updateVehicle($vID,$vNo,$category,$brand,$vRate,$state);

    public function updateVehiclestate($state,$vID);

    public function getavailable();

    public function deleteVehicle($vID);

    public function findVehicle($vID);

    public function findAllVehicles();


}