<?php
/**
 * Created by PhpStorm.
 * User: gamalan
 * Date: 5/10/14
 * Time: 5:15 PM
 */

namespace Ipaymu;


class Resource {
    static public $BALANCE      = "https://my.ipaymu.com/api/CekSaldo.php?";
    static public $TRANSACTION  = "https://my.ipaymu.com/api/CekTransaksi.php?";
    static public $STATUS       = "https://my.ipaymu.com/api/CekStatus.php?";
    static public $PAYMENT      = "https://my.ipaymu.com/payment.htm?";
} 