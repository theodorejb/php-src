--TEST--
Lossy bool coercions are TypeErrors with strict_types
--FILE--
<?php
declare(strict_types=1);

function to_bool(bool $v) { return $v; }
function to_string(string $v) { return $v; }

foreach ([fn() => to_bool(2), fn() => to_bool('1'), fn() => to_string(true), fn() => in_array(1, [1], 1)] as $fn) {
    try {
        $fn();
    } catch (TypeError $e) {
        echo $e->getMessage(), "\n";
    }
}

?>
--EXPECTF--
to_bool(): Argument #1 ($v) must be of type bool, int given, called in %s on line %d
to_bool(): Argument #1 ($v) must be of type bool, string given, called in %s on line %d
to_string(): Argument #1 ($v) must be of type string, true given, called in %s on line %d
in_array(): Argument #3 ($strict) must be of type bool, int given
