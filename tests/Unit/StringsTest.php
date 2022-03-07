<?php

use FirebdPHP\Firebird\Utils\StringUtils;

it("expects to have spaces only in the middle of string", function () {
    expect(StringUtils::removeInlineSpaces("   test it  "))->toBe("test it");
});

it("expects to not see any repeated white space", function () {
    expect(StringUtils::removeExtraSpaces("s  t   r    i    n     g"))->toBe("s t r i n g");
});
