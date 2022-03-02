<?php


require __DIR__ . "/../vendor/autoload.php";

use FirebdPHP\Firebird\QueryRunner;
use FirebdPHP\Firebird\Table;

// Create new Table
// (new TablesFirebird)->createTable('TESTE4', [

//     'name:varchar:255:notNull',
//     'age:integer:notNull',
//     'city:varchar:255:notNull',
//     'state:varchar:255'

// ]);

QueryRunner::run(
    Table::create(
        name: "users",
        columns: [
            "id" => [
                "type" => "int",
                "increment",
                "primary"

            ],
            "name" => [
                "type" => "varchar",
                "limit" => 255
            ],
            "age" => [
                "type" => "int",
            ],
            "city" => [
                "type" => "varchar?",
                "limit" => 255
            ]
        ]
    )
);


//Show All Tables
// (new TablesFirebird)->getTablesInDatabase();
