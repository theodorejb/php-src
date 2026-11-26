--TEST--
Explicit casts and conditions do not emit lossy bool coercion deprecations
--FILE--
<?php

$values = [2, 0.5, 'false', ''];
foreach ($values as $v) {
    var_dump((bool) $v, boolval($v), !$v, $v ? 'yes' : 'no');
    $copy = $v;
    settype($copy, 'bool');
    var_dump($copy);
}
var_dump((string) true, strval(false), (float) true, floatval(false), 'x' . true);
echo true, false, "\n";

function mixed_param(mixed $v) { return $v; }
var_dump(mixed_param('false'));

?>
--EXPECT--
bool(true)
bool(true)
bool(false)
string(3) "yes"
bool(true)
bool(true)
bool(true)
bool(false)
string(3) "yes"
bool(true)
bool(true)
bool(true)
bool(false)
string(3) "yes"
bool(true)
bool(false)
bool(false)
bool(true)
string(2) "no"
bool(false)
string(1) "1"
string(0) ""
float(1)
float(0)
string(2) "x1"
1
string(5) "false"
