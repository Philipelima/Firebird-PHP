<?php

namespace FirebdPHP\Firebird\Column;

use Exception;
use FirebdPHP\Firebird\Column\Column;

class GenerateColumns
{
    /**
     * Generate a sql string of columns from an array of columns
     */
    public static function createMultiple(array $columns)
    {
        $columnNames = array_keys($columns);
        $columnAttributes = array_values($columns);
        $treatedColumns = array_map("self::columnAsSQL", $columnNames, $columnAttributes);

        // Reduces the array of columns in a string
        $columnsAsString = implode(", ", $treatedColumns);

        // Remove last comma and space -> ", "
        $columnsAsString = preg_replace("/, $/", "", $columnsAsString);
        return $columnsAsString;
    }


    // Used to transform the column from array item to string
    private static function columnAsSQL(string $columnName, array $columnAttributes)
    {
        if (!$columnAttributes["type"]) throw new Exception("Column without type. You need to specify a type for each column created.");

        $isUnique = in_array("unique", $columnAttributes);
        $isGenerated = in_array("increment", $columnAttributes);
        $isPrimary = in_array("primary", $columnAttributes);
        $limit = $columnAttributes["limit"] ?? 0;
        $reference = $columnAttributes["reference"] ?? [];
        $defaultValue = $columnAttributes["default"] ?? null;

        $column = new Column(
            name: $columnName,
            type: $columnAttributes["type"],
            defaultValue: $defaultValue,
            limit: $limit,
            generated: $isGenerated,
            primary: $isPrimary,
            reference: $reference,
            unique: $isUnique
        );

        return $column->asString();
    }
}
