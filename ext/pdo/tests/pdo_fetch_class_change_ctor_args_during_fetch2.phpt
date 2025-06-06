--TEST--
PDO Common: PDO::FETCH_CLASS with a constructor that changes the ctor args within PDO::fetchObject()
--EXTENSIONS--
pdo
--SKIPIF--
<?php
$dir = getenv('REDIR_TEST_DIR');
if (false == $dir) die('skip no driver');
require_once $dir . 'pdo_test.inc';
PDOTest::skip();
?>
--FILE--
<?php
if (getenv('REDIR_TEST_DIR') === false) putenv('REDIR_TEST_DIR='.__DIR__ . '/../../pdo/tests/');
require_once getenv('REDIR_TEST_DIR') . 'pdo_test.inc';
$db = PDOTest::factory();

class Test {
    public string $val1;
    public string $val2;

    public function __construct(mixed $v) {
        var_dump($v);
        if ($v instanceof PDOStatement) {
            $v->setFetchMode(PDO::FETCH_CLASS, 'Test', [$this->val2]);
        }
    }
}

// TODO Rename pdo_fetch_class_change_ctor_two table to pdo_fetch_class_change_ctor_two in PHP-8.4
$db->exec('CREATE TABLE pdo_fetch_class_change_ctor_two(id int NOT NULL PRIMARY KEY, val1 VARCHAR(10), val2 VARCHAR(10))');
$db->exec("INSERT INTO pdo_fetch_class_change_ctor_two VALUES(1, 'A', 'alpha')");
$db->exec("INSERT INTO pdo_fetch_class_change_ctor_two VALUES(2, 'B', 'beta')");
$db->exec("INSERT INTO pdo_fetch_class_change_ctor_two VALUES(3, 'C', 'gamma')");
$db->exec("INSERT INTO pdo_fetch_class_change_ctor_two VALUES(4, 'D', 'delta')");

$stmt = $db->prepare('SELECT val1, val2 FROM pdo_fetch_class_change_ctor_two');

$stmt->execute();

try {
    var_dump($stmt->fetchObject('Test', [$stmt]));
} catch (\Throwable $e) {
    echo $e::class, ': ', $e->getMessage(), \PHP_EOL;
}

?>
--CLEAN--
<?php
require_once getenv('REDIR_TEST_DIR') . 'pdo_test.inc';
$db = PDOTest::factory();
PDOTest::dropTableIfExists($db, "pdo_fetch_class_change_ctor_two");
?>
--EXPECTF--
object(PDOStatement)#%s (1) {
  ["queryString"]=>
  string(54) "SELECT val1, val2 FROM pdo_fetch_class_change_ctor_two"
}
Error: Cannot change default fetch mode while fetching
