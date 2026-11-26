--TEST--
Lossy coercion to bool for userland arguments, returns, and typed properties
--FILE--
<?php

function arg(bool $b) { return $b; }
function ret($v): bool { return $v; }
class C { public bool $b; }

$values = [0, 1, '0', '1', 2, -1, 0.0, -0.0, 1.0, 0.5, INF, -INF, '', ' ', '0 ', ' 1', '00', '0.0', '1.0', 'false', 'off'];

foreach ($values as $value) {
    echo "\n", var_export($value, true), ":\n";
    var_dump(arg($value));
    var_dump(ret($value));
    $c = new C;
    $c->b = $value;
    var_dump($c->b);
}

?>
--EXPECTF--

0:
bool(false)
bool(false)
bool(false)

1:
bool(true)
bool(true)
bool(true)

'0':
bool(false)
bool(false)
bool(false)

'1':
bool(true)
bool(true)
bool(true)

2:

Deprecated: Implicit conversion from int 2 to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from int 2 to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from int 2 to bool in %s on line %d
bool(true)

-1:

Deprecated: Implicit conversion from int -1 to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from int -1 to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from int -1 to bool in %s on line %d
bool(true)

0.0:

Deprecated: Implicit conversion from float 0 to bool in %s on line %d
bool(false)

Deprecated: Implicit conversion from float 0 to bool in %s on line %d
bool(false)

Deprecated: Implicit conversion from float 0 to bool in %s on line %d
bool(false)

-0.0:

Deprecated: Implicit conversion from float -0 to bool in %s on line %d
bool(false)

Deprecated: Implicit conversion from float -0 to bool in %s on line %d
bool(false)

Deprecated: Implicit conversion from float -0 to bool in %s on line %d
bool(false)

1.0:

Deprecated: Implicit conversion from float 1 to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from float 1 to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from float 1 to bool in %s on line %d
bool(true)

0.5:

Deprecated: Implicit conversion from float 0.5 to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from float 0.5 to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from float 0.5 to bool in %s on line %d
bool(true)

INF:

Deprecated: Implicit conversion from float INF to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from float INF to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from float INF to bool in %s on line %d
bool(true)

-INF:

Deprecated: Implicit conversion from float -INF to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from float -INF to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from float -INF to bool in %s on line %d
bool(true)

'':

Deprecated: Implicit conversion from string "" to bool in %s on line %d
bool(false)

Deprecated: Implicit conversion from string "" to bool in %s on line %d
bool(false)

Deprecated: Implicit conversion from string "" to bool in %s on line %d
bool(false)

' ':

Deprecated: Implicit conversion from string " " to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string " " to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string " " to bool in %s on line %d
bool(true)

'0 ':

Deprecated: Implicit conversion from string "0 " to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "0 " to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "0 " to bool in %s on line %d
bool(true)

' 1':

Deprecated: Implicit conversion from string " 1" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string " 1" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string " 1" to bool in %s on line %d
bool(true)

'00':

Deprecated: Implicit conversion from string "00" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "00" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "00" to bool in %s on line %d
bool(true)

'0.0':

Deprecated: Implicit conversion from string "0.0" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "0.0" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "0.0" to bool in %s on line %d
bool(true)

'1.0':

Deprecated: Implicit conversion from string "1.0" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "1.0" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "1.0" to bool in %s on line %d
bool(true)

'false':

Deprecated: Implicit conversion from string "false" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "false" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "false" to bool in %s on line %d
bool(true)

'off':

Deprecated: Implicit conversion from string "off" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "off" to bool in %s on line %d
bool(true)

Deprecated: Implicit conversion from string "off" to bool in %s on line %d
bool(true)
