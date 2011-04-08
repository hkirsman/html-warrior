<?php

// mysql query shortcut
function q($s_query)
{
	global $link, $config;
	if ($config["debug"])
	{
		global $dbg;
		if (stripos($s_query, "UPDATE") === false &&
			stripos($s_query, "INSERT") === false &&
			stripos($s_query, "TRUNCATE") === false &&
			stripos($s_query, "DELETE") === false
			)
		{
			$r = mysqli_query ($link, "EXPLAIN  " . $s_query);
			$row = mysqli_fetch_array($r, MYSQL_ASSOC);
			$dbg["db"][] = $row;
		}
	$i_start = microtime(1)*1000;
	}
	$return = mysqli_query ($link, $s_query);
	if ($config["debug"])
	{
		$dbg["db"][count($dbg["db"])-1]["exec_time"] = microtime(1)*1000-$i_start . " milliseconds";
		$dbg["db"][count($dbg["db"])-1]["query"] = $s_query;
	}
	return $return;
}

function add_access_log($arr=array()) { 
	$q = "
		INSERT INTO
			`access_log`
			(
				`id` ,
				`url` ,
				`date`
			)
		VALUES (
			NULL ,
			'".$arr["url"]."',
			'".datetime()."'
		);
	";
	q($q);
}

function get_access_log($arr=array()) { 
	$out = array();
	if($arr["limit"]) {
		$limit = " LIMIT 0, ".$arr["limit"]. " ";
	}
	$q = "
		SELECT 
			`url`
		FROM
			`access_log`
		ORDER BY
		`date` desc
		$limit
	";
	$r = q($q);
	while ($row = mysqli_fetch_array($r, MYSQL_ASSOC))
	{
			$out[] = $row;
			$name = explode("/", $row["url"]);
			$name = $name[1];
			$out[count($out)-1]["name"] = $name;
	} 
	return $out;
}

function datetime($timestamp=false) { 
	global $config;

	if($timestamp) {
		$date = date("Y-m-d H:M:s",  $timestamp+$config["timeoffset"]);
	} else {
		$date = date("Y-m-d H:i:s", time()+$config["timeoffset"]);
	}
	return $date;
}

?>