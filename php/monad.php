<?php

class IntegerWithLogs
{
  public int $result;
  public array $logs;

  public function __construct(int $result, array $logs)
  {
    $this->result = $result;
    $this->logs = $logs;
  }

  public function __toString()
  {
    return json_encode($this->logs);
  }
}

class Calculate
{
  public static function square(int $x): IntegerWithLogs
  {
    return new IntegerWithLogs($x * $x, ["Squared $x to get " . ($x * $x)]);
  }

  public static function addOne(int $x): IntegerWithLogs
  {
    return new IntegerWithLogs($x + 1, ["Added 1 to $x to get " . ($x + 1)]);
  }

  public static function wrapWithLogs(int $x): IntegerWithLogs
  {
    return new IntegerWithLogs($x, []);
  }

  public static function runWithLogs(IntegerWithLogs $input, callable $applyFunction): IntegerWithLogs
  {
    $newNumberWithLogs = $applyFunction($input->result);
    return new IntegerWithLogs($newNumberWithLogs->result, array_merge($newNumberWithLogs->logs, $input->logs));
  }
}

$a = Calculate::wrapWithLogs(5);
$b = Calculate::runWithLogs($a, "Calculate::square");
$c = Calculate::runWithLogs($b, "Calculate::addOne");

echo ($c);
