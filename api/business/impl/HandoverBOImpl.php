<?php
/**
 * Created by IntelliJ IDEA.
 * User: ASUS
 * Date: 27/07/2018
 * Time: 12:17 AM
 */
include_once __DIR__."/../HandoverBO.php";

class HandoverBOImpl implements HandoverBO
{

    public function getdifference($fromDate, $toDate)
    {
        $date1=date_create($fromDate);
        $date2=date_create($toDate);
        $diff=date_diff($date1,$date2);
        return $diff->format('%a');

}
}