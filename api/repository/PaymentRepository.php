<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 27/07/2018
 * Time: 9:32 PM
 */

interface PaymentRepository
{
    public function setConnection(mysqli $connection);

    public function savePayment($pID, $cID, $vID, $pMethod, $paneltyFee, $totalAmount);

    public function updatePayment($pID, $cID, $vID, $pMethod, $paneltyFee, $totalAmount);

    public function deletePayment($pID,$cID, $vID);

    public function findPayment($pID,$cID, $vID);

    public function findAllPayment();

}