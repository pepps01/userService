<?php

namespace Netsells\GeoScope;

use Netsells\GeoScope\Exceptions\ScopeDriverNotFoundException;
use Netsells\GeoScope\Interfaces\ScopeDriverInterface;
use Netsells\GeoScope\ScopeDrivers\MySQLScopeDriver;
use Netsells\GeoScope\ScopeDrivers\PostgreSQLScopeDriver;
use Netsells\GeoScope\ScopeDrivers\SQLServerScopeDriver;
use Netsells\GeoScope\ScopeDrivers\MariaDbScopeDriver;

class ScopeDriverFactory
{
    /**
     * @var array
     */
    protected $registeredStrategies = [
        'mysql' => MySQLScopeDriver::class,
        'pgsql' => PostgreSQLScopeDriver::class,
        'sqlsrv' => SQLServerScopeDriver::class,
        'mariadb' => MariaDbScopeDriver::class,
    ];

    /**
     * @param $key
     * @return ScopeDriverInterface
     * @throws ScopeDriverNotFoundException
     */
    public function getStrategyInstance($key): ScopeDriverInterface
    {
        if (array_key_exists($key, $this->registeredStrategies)) {
            $strategy = new $this->registeredStrategies[$key]();
            return $strategy;
        }

        throw new ScopeDriverNotFoundException("No registered scope driver for {$key} connection");
    }

    /**
     * @param string $key
     * @param ScopeDriverInterface $strategy
     */
    public function registerDriverStrategy(string $key, string $strategy): void
    {
        $this->registeredStrategies[$key] = $strategy;
    }

    /**
     * @return array
     */
    public function getRegisteredScopeDrivers(): array
    {
        return $this->registeredStrategies;
    }
}
