--TEST--
bool socket_shutdown ( resource $socket [, int $how = 2 ] ) ;
--CREDITS--
marcosptf - <marcosptf@yahoo.com.br> - #phparty7 - @phpsp - novatec/2015 - sao paulo - br
--EXTENSIONS--
sockets
--SKIPIF--
<?php
if (getenv("SKIP_ONLINE_TESTS")) die("skip online test");

if(substr(PHP_OS, 0, 3) == 'WIN' ) {
    die('skip not for windows');
}
?>
--FILE--
<?php
$host = "yahoo.com";
$port = 80;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$socketConn = socket_connect($socket, $host, $port);
var_dump(socket_shutdown($socket,SHUT_RD));
socket_close($socket);

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$socketConn = socket_connect($socket, $host, $port);
var_dump(socket_shutdown($socket,SHUT_WR));
socket_close($socket);

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$socketConn = socket_connect($socket, $host, $port);
var_dump(socket_shutdown($socket,SHUT_RDWR));
socket_close($socket);

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
var_dump(socket_shutdown($socket,SHUT_RD));

$socketConn = socket_connect($socket, $host, $port);

try {
	socket_shutdown($socket,-1);
} catch (\ValueError $e) {
	echo $e->getMessage(), PHP_EOL;
}
socket_close($socket);
?>
--CLEAN--
<?php
unset($host);
unset($port);
unset($socket);
unset($socketConn);
?>
--EXPECTF--
bool(true)
bool(true)
bool(true)

Warning: socket_shutdown(): Unable to shutdown socket [%d]: %s in %s on line %d
bool(false)

must be one of SHUT_RD, SHUT_WR or SHUT_RDWR
