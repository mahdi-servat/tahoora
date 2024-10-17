<?php

namespace App\Contracts;


interface CustomerInterface
{
    function getWallet(): ?int;

    function deposit(int $price): CustomerInterface;

    function withdraw(int $price): CustomerInterface;

    function getId();

}
