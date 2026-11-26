--TEST--
Lossy bool coercion for internal function parameters
--FILE--
<?php

// bool parameters
var_dump(in_array(1, ['1'], 0));
var_dump(in_array(1, ['1'], 1));
var_dump(in_array(1, ['1'], 2));
var_dump(in_array(1, ['1'], 'yes'));
$strict = 'yes';
var_dump(in_array(1, ['1'], $strict));
var_dump(array_keys(['a' => 1], 1, 0.0));

// string parameters
var_dump(strlen(false));
var_dump(str_repeat(true, 2));

// float parameters
var_dump(sqrt(true));
var_dump(fdiv(1, false));

// int parameters
var_dump(str_repeat('a', true));
var_dump(substr('abc', 0, false));

// int|float parameters
var_dump(round(true));

// int|string parameters
var_dump(array_column([['a', 'b']], true));

// int|float|string parameters
var_dump(range(false, 1));

// mixed parameters are unaffected
var_dump(max(false, 0));

?>
--EXPECTF--
bool(true)
bool(false)

Deprecated: Implicit conversion from int 2 to bool in %s on line %d
bool(false)

Deprecated: Implicit conversion from string "yes" to bool in %s on line %d
bool(false)

Deprecated: Implicit conversion from string "yes" to bool in %s on line %d
bool(false)

Deprecated: Implicit conversion from float 0 to bool in %s on line %d
array(1) {
  [0]=>
  string(1) "a"
}

Deprecated: Implicit conversion from false to string in %s on line %d
int(0)

Deprecated: Implicit conversion from true to string in %s on line %d
string(2) "11"

Deprecated: Implicit conversion from true to float in %s on line %d
float(1)

Deprecated: Implicit conversion from false to float in %s on line %d
float(INF)

Deprecated: Implicit conversion from true to int in %s on line %d
string(1) "a"

Deprecated: Implicit conversion from false to int in %s on line %d
string(0) ""

Deprecated: Implicit conversion from true to int in %s on line %d
float(1)

Deprecated: Implicit conversion from true to int in %s on line %d
array(1) {
  [0]=>
  string(1) "b"
}

Deprecated: Implicit conversion from false to int in %s on line %d
array(2) {
  [0]=>
  int(0)
  [1]=>
  int(1)
}
bool(false)
