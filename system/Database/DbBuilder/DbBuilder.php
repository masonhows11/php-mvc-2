<?php

namespace System\Database\DbBuilder;

use JetBrains\PhpStorm\NoReturn;
use System\Database\DBConnection\DBConnection;


class DbBuilder
{


    #[NoReturn] public function __construct()
    {

        $this->createTables();
        die("migrations run successfully");

    }



    private function getMigrations(): array
    {

        return [];
    }

    private function getFromOldMigration(): array
    {
        $data = file_get_contents(__DIR__.'/oldTables.db');
        return empty($data) ? [] : unserialize($data);
    }

    private function putToOldMigration(): array
    {
        return [];
    }

    private function createTables(): bool
    {
        $migrations = $this->getMigrations();

        $pdoInstance = DBConnection::getDbConnectionInstance();

        try {
            foreach ($migrations as $migration) {

                $statement = $pdoInstance->prepare($migration);
                $statement->execute();
            }
            return true;
        } catch (\PDOException $exception) {
            echo "Migrate has failed" . $exception;
        }
        return false;


    }




}