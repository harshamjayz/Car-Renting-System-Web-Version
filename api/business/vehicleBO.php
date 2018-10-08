<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 24/07/2018
 * Time: 11:33 PM
 */

interface vehicleBO
{
    public function saveVehicle($vID,$vNo,$category,$brand,$vRate,$state);

    public function updateVehicle($vID,$vNo,$category,$brand,$vRate,$state);

    public function updateVehiclestate($state,$vID);

    public function getVehicleCount();

    public function getavailable();

    public function getAllVehicles();

    public function getVehicle($vID);

    public function deleteVehicle($vID);
}