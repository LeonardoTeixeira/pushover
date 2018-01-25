<?php

namespace LeonardoTeixeira\Pushover;

class Receipt
{
    private $receipt;

    public function __construct($receipt = null)
    {
        $this->receipt = $receipt;
    }

    public function getReceipt()
    {
        return $this->receipt;
    }

    public function setReceipt($receipt)
    {
        $this->receipt = $receipt;
    }

    public function hasReceipt()
    {
        return !is_null($this->receipt);
    }
}
