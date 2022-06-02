<?php


require __DIR__ . "/../vendor/autoload.php";

use FirebdPHP\Firebird\QueryRunner;
use FirebdPHP\Firebird\Table\Table;


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
            "email" => [
                "type" => "varchar",
                "limit" => 255,
                "unique"
            ],
            "age" => [
                "type" => "int",
            ],
            "city" => [
                "type" => "varchar?",
                "limit" => 255
            ],
            "state" => [
                "type" => "varchar",
                "limit" => 50,
                "reference" => [
                    "table" => "states",
                    "field" => "acronym",
                    "onDelete" => "cascade"
                ]
            ],
            "createdAt" => [
                "type" => "timestamp",
                "default" => "now"
            ],
            "theme" => [
                "type" => "varchar",
                "limit" => 15,
                "default" => "dark"
            ],
        ]
    )
);


