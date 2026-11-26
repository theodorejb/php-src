--TEST--
Lossy bool coercion with union types
--FILE--
<?php

function int_bool(int|bool $v) { return $v; }
function float_bool(float|bool $v) { return $v; }
function string_bool(string|bool $v) { return $v; }
function float_string(float|string $v) { return $v; }
function int_string(int|string $v) { return $v; }
function int_float(int|float $v) { return $v; }

var_dump(int_bool('yes'));
var_dump(int_bool('2'));
var_dump(int_bool(1.5));
var_dump(float_bool('yes'));
var_dump(float_bool('1'));
var_dump(string_bool(2));
var_dump(string_bool(true));
var_dump(float_string(false));
var_dump(int_string(true));
var_dump(int_float(true));

?>
--EXPECTF--

Deprecated: Implicit conversion from string "yes" to bool in %s on line %d
bool(true)
int(2)

Deprecated: Implicit conversion from float 1.5 to int loses precision in %s on line %d
int(1)

Deprecated: Implicit conversion from string "yes" to bool in %s on line %d
bool(true)
float(1)
string(1) "2"
bool(true)

Deprecated: Implicit conversion from false to float in %s on line %d
float(0)

Deprecated: Implicit conversion from true to int in %s on line %d
int(1)

Deprecated: Implicit conversion from true to int in %s on line %d
int(1)
