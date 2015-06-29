<?php

namespace Stevebauman\Wmi;

interface WmiInterface
{
    public function __construct($host, $username, $password);

    public function connect($namespace);

    public function getConnection();

    public function getHost();

    public function getUsername();

    public function setHost($host);

    public function setUsername($username);

    public function setPassword($password);
}
