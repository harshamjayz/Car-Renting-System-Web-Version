<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 27/07/2018
 * Time: 9:21 PM
 */

include_once __DIR__."/../PaymentBO.php";
require_once __DIR__ . '/../../repository/impl/PaymentRepositoryImpl.php';
require_once __DIR__ . '/../../db/DBConnection.php';

class PaymentBOImpl implements paymentBO
{
    private $paymentRepository;

    public function __construct()
    {
        $this->paymentRepository = new PaymentRepositoryImpl();
    }

    public function savepayment($pID, $cID, $vID, $pMethod, $paneltyFee, $totalAmount)
    {
        $connection = (new DBConnection())->getConnection();
        $this->paymentRepository->setConnection($connection);

        $result = $this->paymentRepository->savepayment($pID, $cID, $vID, $pMethod, $paneltyFee, $totalAmount);

        mysqli_close($connection);

        return $result;
    }

    public function updatePayment($pID, $cID, $vID, $pMethod, $paneltyFee, $totalAmount)
    {
        // TODO: Implement updatePayment() method.
    }
}