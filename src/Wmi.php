<?php

namespace Stevebauman\Wmi;

use COM;

class Wmi implements WmiInterface
{
    /**
     * The host of the current WMI connection.
     *
     * @var string
     */
    private $host;

    /**
     * The username of the user connecting to the host.
     *
     * @var string
     */
    private $username;

    /**
     * The password of the user connecting to the host.
     *
     * @var string
     */
    private $password;

    /**
     * The current COM instance.
     *
     * @var COM
     */
    private $com;

    /**
     * The current COM connection to the host.
     *
     * @var Connection
     */
    private $connection;

    /**
     * The WMI COM script.
     *
     * @var string
     */
    private $script = 'WbemScripting.SWbemLocator';

    /**
     * Constructor.
     *
     * @param string $host
     * @param string $username
     * @param string $password
     */
    public function __construct($host = 'localhost', $username = null, $password = null)
    {
        $this->com = new COM($this->script);
        
        $this->setHost($host);
        $this->setUsername($username);
        $this->setPassword($password);
    }

    /**
     * Returns a new connection to the
     * server using the current COM instance.
     *
     * @param string $namespace
     * @param int    $level
     *
     * @return bool|Connection
     */
    public function connect($namespace = '', $level = 3)
    {
        // Connect to the host using the specified namespace
        $connection = $this->com->ConnectServer($this->getHost(), $namespace, $this->getUsername(), $this->password);

        if ($connection) {
            // Set the impersonation level
            $connection->Security_->ImpersonationLevel = (int) $level;

            // Set the connection
            $this->setConnection(new Connection($connection));

            return $this->connection;
        }

        return false;
    }

    /**
     * Returns the current connection to the host.
     *
     * @return bool|Connection
     */
    public function getConnection()
    {
        if ($this->connection instanceof ConnectionInterface) {
            return $this->connection;
        }

        return false;
    }

    /**
     * Returns the current host to connect to.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Returns the current username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the current connection.
     *
     * @param ConnectionInterface $connection
     *
     * @return $this
     */
    public function setConnection(ConnectionInterface $connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Sets the host to connect to.
     *
     * @param string $host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = (string) $host;

        return $this;
    }

    /**
     * Sets the current username.
     *
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = (string) $username;

        return $this;
    }

    /**
     * Sets the current password.
     *
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = (string) $password;

        return $this;
    }
}
