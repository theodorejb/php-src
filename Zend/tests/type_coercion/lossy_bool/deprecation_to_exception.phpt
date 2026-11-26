--TEST--
Lossy bool coercion deprecations promoted to exceptions
--FILE--
<?php

set_error_handler(function ($errno, $errstr) {
    throw new Exception($errstr);
});

function to_bool(bool $v) { return $v; }
function float_string(float|string $v) { return $v; }
function int_string(int|string $v) { return $v; }
function ret(): bool { return 2; }
class C { public bool $b = false; public string $s = ''; public int $i = 0; }

$tests = [
    fn() => to_bool('yes'),
    fn() => float_string(true),
    fn() => int_string(true),
    fn() => ret(),
    fn() => str_repeat(false, 1),
    fn() => str_repeat('a', true),
    fn() => array_column([['a', 'b']], true),
    fn() => range(false, 1),
    fn() => in_array(1, [1], 2),
    function () { $c = new C; $c->b = 2; return $c; },
    function () { $c = new C; $c->s = true; return $c; },
    function () { $c = new C; $c->i = false; return $c; },
];

foreach ($tests as $test) {
    try {
        var_dump($test());
    } catch (Throwable $e) {
        do {
            echo get_class($e), ': ', $e->getMessage(), "\n";
        } while ($e = $e->getPrevious());
    }
}

?>
--EXPECT--
Exception: Implicit conversion from string "yes" to bool
Exception: Implicit conversion from true to float
Exception: Implicit conversion from true to int
TypeError: ret(): Return value must be of type bool, int returned
Exception: Implicit conversion from int 2 to bool
Exception: Implicit conversion from false to string
Exception: Implicit conversion from true to int
Exception: Implicit conversion from true to int
Exception: Implicit conversion from false to int
Exception: Implicit conversion from int 2 to bool
Exception: Implicit conversion from int 2 to bool
Exception: Implicit conversion from true to string
Exception: Implicit conversion from false to int
