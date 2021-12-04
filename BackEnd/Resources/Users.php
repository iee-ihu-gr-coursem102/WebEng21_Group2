<?php

if ( $httpMethod == "POST") {
	if (isset($json["username"]) && isset($json["password"])) {
    //INSERT TO DB
    header('HTTP/1.1 201 Created');
    echo json_encode(array( 'submittedName' => $json["username"],
                            'submittedPassword' => $json["password"]
                            )
                    );
	} else {
		header('HTTP/1.1 400 Bad Request');
	}
} else {
	header('HTTP/1.1 405 Method Not Allowed');
}







?>