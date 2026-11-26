--TEST--
Lossy coercion from bool for userland arguments, returns, and typed properties
--FILE--
<?php

function to_int(int $v) { return $v; }
function to_float(float $v) { return $v; }
function to_string(string $v) { return $v; }
function ret_int($v): int { return $v; }
function ret_float($v): float { return $v; }
function ret_string($v): string { return $v; }
class C { public int $i; public float $f; public string $s; }

foreach ([false, true] as $value) {
    echo "\n", var_export($value, true), ":\n";
    var_dump(to_int($value));
    var_dump(to_float($value));
    var_dump(to_string($value));
    var_dump(ret_int($value));
    var_dump(ret_float($value));
    var_dump(ret_string($value));
    $c = new C;
    $c->i = $value;
    $c->f = $value;
    $c->s = $value;
    var_dump($c->i, $c->f, $c->s);
}

?>
--EXPECTF--

false:

Deprecated: Implicit conversion from false to int in %s on line %d
int(0)

Deprecated: Implicit conversion from false to float in %s on line %d
float(0)

Deprecated: Implicit conversion from false to string in %s on line %d
string(0) ""

Deprecated: Implicit conversion from false to int in %s on line %d
int(0)

Deprecated: Implicit conversion from false to float in %s on line %d
float(0)

Deprecated: Implicit conversion from false to string in %s on line %d
string(0) ""

Deprecated: Implicit conversion from false to int in %s on line %d

Deprecated: Implicit conversion from false to float in %s on line %d

Deprecated: Implicit conversion from false to string in %s on line %d
int(0)
float(0)
string(0) ""

true:

Deprecated: Implicit conversion from true to int in %s on line %d
int(1)

Deprecated: Implicit conversion from true to float in %s on line %d
float(1)

Deprecated: Implicit conversion from true to string in %s on line %d
string(1) "1"

Deprecated: Implicit conversion from true to int in %s on line %d
int(1)

Deprecated: Implicit conversion from true to float in %s on line %d
float(1)

Deprecated: Implicit conversion from true to string in %s on line %d
string(1) "1"

Deprecated: Implicit conversion from true to int in %s on line %d

Deprecated: Implicit conversion from true to float in %s on line %d

Deprecated: Implicit conversion from true to string in %s on line %d
int(1)
float(1)
string(1) "1"
