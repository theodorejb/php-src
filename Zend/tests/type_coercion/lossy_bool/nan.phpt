--TEST--
NAN coerced to bool emits both the lossy coercion deprecation and the NAN warning
--FILE--
<?php

function to_bool(bool $v) { return $v; }
var_dump(to_bool(NAN));
var_dump(in_array(1, [1], NAN));

// Unchanged: explicit casts only emit the NAN warning
var_dump((bool) NAN);

// If the deprecation is promoted to an exception, the warning is not reached
set_error_handler(function ($errno, $errstr) {
    throw new Exception($errstr);
});
try {
    to_bool(NAN);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

?>
--EXPECTF--
Deprecated: Implicit conversion from float NAN to bool in %s on line %d

Warning: unexpected NAN value was coerced to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from float NAN to bool in %s on line %d

Warning: unexpected NAN value was coerced to bool in %s on line %d
bool(true)

Warning: unexpected NAN value was coerced to bool in %s on line %d
bool(true)
Implicit conversion from float NAN to bool
