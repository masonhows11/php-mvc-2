<?php

namespace System\Database\DbBuilder;

use System\Database\DBConnection\DBConnection;


class DbBuilder
{


    public function __construct()
    {

        $this->createTables();
        die("migrations run successfully");

    }


    private function createTables(): void
    {
        $migrations = $this->getMigrations();

        $pdoInstance = DBConnection::getDbConnectionInstance();

        foreach ($migrations as $migration){

            $statement = $pdoInstance->prepare($migration);
            $statement->execute();
        }

    }




}