<?php
ini_set('max_execution_time', 0);
require_once "Ping.php";

// // Create connection
// $conn = new mysqli('localhost','root','','igib');
$conn = new mysqli('localhost','amargar_alexa','a85208520','amargar_alexa');

// // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("select * from xxsite");

while($row = $result->fetch_assoc()) {
	$url = str_replace(["http://","/","https://"], ['','',''], $row['xsite_url']);

	$ping = Net_Ping::factory();
	if (PEAR::isError($ping)) {
	    echo $ping->getMessage();
	} else {
	    $ping->setArgs(array('count' => 2));
	    $res = $ping->ping($url);
	}



	if (@$res->_received)
	{
		$header_info = get_headers("http://".$url);
		$str = implode($header_info, '');

		if (preg_match("/HTTP\/... 200 OK/i", $str)) {
			$data['status'] = "up";
		} else {
			$data['status'] = "block";
		}
	}
	else
	{
		if(strpos($res->_target_ip, "10.10") === 0)
		{
			$data['status'] = "filter";	
		}
		else
		{
			$data['status'] = "down";
		}
	}

	$conn->query("UPDATE xxsite SET xsite_status='".$data['status']."' WHERE xsite_url='http://".$url."/'");

}


?>