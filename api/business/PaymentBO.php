<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 27/07/2018
 * Time: 9:19 PM
 */

interface paymentBO
{
    public function savepayment($pID, $cID, $vID, $pMethod, $paneltyFee, $totalAmount);

    public function updatePayment($pID, $cID, $vID, $pMethod, $paneltyFee, $totalAmount);
}