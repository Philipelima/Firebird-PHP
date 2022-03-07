<?php

namespace FirebdPHP\Firebird\Table;

use FirebdPHP\Firebird\Column\GenerateColumns;
use FirebdPHP\Firebird\Utils\StringUtils;

class Table
{
    /**
     * Returns a query string to create a table with the given name and columns
     */
    public static function create(string $name, array $columns)
    {
        $columns = GenerateColumns::createMultiple($columns);
        $sqlString = "CREATE TABLE $name ($columns)";

        $cleanSqlString = StringUtils::removeExtraSpaces($sqlString);

        return $cleanSqlString;
    }
}
