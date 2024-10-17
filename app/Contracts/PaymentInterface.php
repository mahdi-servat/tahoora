<?php

namespace App\Contracts;

interface PaymentInterface
{
    function pay(): PaymentInterface;

    function verify(): PaymentInterface;
}
