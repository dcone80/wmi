<?php

namespace Stevebauman\Wmi;

interface ConnectionInterface
{
    public function get();

    public function newQuery();

    public function query($query);
}