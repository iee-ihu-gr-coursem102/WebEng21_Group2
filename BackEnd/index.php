<?php

$httpMethod = $_SERVER['REQUEST_METHOD'];

$request_body = file_get_contents('php://input'); //php raw stream from http request body
$json = json_decode($request_body, true);

if (!isset($_SERVER['PATH_INFO'])) {
	header('HTTP/1.1 500 Internal Server Error');
	print "Request to api is too short";
	exit;
}

print "1.JSON";
print_r($json);

$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

$request = array("dbversion" => $request[0], "resource" => $request[1]);
//print "\n dbversion " . $request["dbversion"];
//print "\n resource " . $request["resource"];

if ($request["dbversion"]) {
    if ($request["resource"] == "Movies") {
        require_once "./Resources/" . $request['resource'] . ".php";
    }
    else if ($request["resource"] == "Comments") {
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