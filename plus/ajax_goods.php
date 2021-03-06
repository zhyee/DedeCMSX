<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Datetime: 2017/5/5 18:15
 * File: ajax_goods.php
 */

require_once(dirname(__FILE__).'/../include/common.inc.php');

$typeid = (int)$_REQUEST['typeid'] > 0 ? (int)$_REQUEST['typeid'] : 3;

$typeids = array();

$sql = "SELECT id FROM `#@__arctype` WHERE topid = '$typeid' OR id = '$typeid'";

$dsql->SetQuery($sql);

$dsql->Execute();

while (($row = $dsql->GetArray()) != FALSE)
{
    $typeids[] = (int)$row['id'];
}

$res = array();

if ($typeids)
{
    $typeids = implode(',', $typeids);

    $sql = "SELECT id,title FROM `#@__archives` WHERE typeid IN ($typeids) LIMIT 100";
    $dsql->SetQuery($sql);
    $dsql->Execute();

    while (($row = $dsql->GetArray()) != FALSE)
    {
        $res[] = $row;
    }
}

$res = json_encode($res);

$callback = $_GET['callback'];

if ($callback)
{
    echo $callback . '(' . $res . ');';
}
else
{
    echo $res;
}