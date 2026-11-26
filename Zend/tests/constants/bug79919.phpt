--TEST--
Bug #79919 (Stack use-after-scope in define())
--INI--
error_log=
--EXTENSIONS--
simplexml
--FILE--
<?php
$b = error_log(0);
$b = simplexml_load_string('<xml/>', null, $b);
define(0, $b);
?>
--EXPECTF--
0

Deprecated: Implicit conversion from true to int in %s on line %d
