<?php
/**
 * 栏目小助手
 * Created by PhpStorm.
 * User: zy
 * Datetime: 2017/3/31 17:22
 * File: arctype.helper.php
 */

if (!function_exists("getTopTypeid"))
{
    function getTopTypeid($tid = NULL)
    {
        global $dsql;
        if ($tid === NULL)
        {
            $tid = $_REQUEST['tid'];
        }

        $tid = (int)$tid;

        if ($tid <= 0)
        {
            return false;
        }
        else
        {
            $row = $dsql->GetOne("SELECT topid FROM `#@__arctype` WHERE id = $tid");
            if ($row && $row['topid'])
            {
                return $row['topid'];
            }
        }
        return $tid;
    }
}