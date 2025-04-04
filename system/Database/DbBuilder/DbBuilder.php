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


    private function createTables()
    {
        $migrations = $this->getMigrations();

        

    }




}