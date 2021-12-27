<?php
session_start();
/*
if (!isset(getallheaders() ['x-api-key']) || getallheaders() ['x-api-key'] != "1234") {
    header('HTTP/1.1 403 Forbidden');
    exit;
}
*/
require_once "toolbox.php";

$httpMethod = $_SERVER['REQUEST_METHOD'];


$line = date('Y-m-d H:i:s') . "-" . $httpMethod . "-" ." - $_SERVER[REMOTE_ADDR]" . $_SERVER['REQUEST_URI'];
file_put_contents('visitors.log', $line . PHP_EOL, FILE_APPEND);


$request_body = file_get_contents('php://input'); //php raw stream from http request body

if (!isJson($request_body)) 
{
	  header('HTTP/1.1 415 Unsupported Media Type');
	  exit;
} 

$json = json_decode($request_body, true);

require_once "./Database/db_connection.php";

if (!isset($_SERVER['PATH_INFO'])) {
	header('HTTP/1.1 500 Internal Server Error');
	print "Request to api is too short";
	exit;
}

$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$request = array("dbversion" => $request[0], "resource" => $request[1]);

if ($request["dbversion"]) {
	header('Access-Control-Allow-Origin: *');
    if ($request["resource"] == "Movies") {
        require_once "./Resources/" . $request['resource'] . ".php";
    }
    else if ($request["resource"] == "Users") {
        require_once "./Resources/" . $request['resource'] . ".php";
    }
    else if (($request["resource"] == "Sessions")) {
        require_once "./Resources/" . $request['resource'] . ".php";
    }
	else if (($request["resource"] == "Comments")) {
        require_once "./Resources/" . $request['resource'] . ".php";
    }
	else if (($request["resource"] == "Genres")) {
        require_once "./Resources/" . $request['resource'] . ".php";
    }
    else {
        header('HTTP/1.1 404  Not Found');
    }
} 
?>