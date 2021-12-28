<?php 

function isJson($data) 
{
    return ((is_string($data) &&
            (is_object(json_decode($data)) ||
            is_array(json_decode($data))))) ? true : false;

}

function isURL ($data) {
	if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
		die('Not a valid URL');
	}
}

 function isValidUrl($url) {
    $url = parse_url($url);
    if (!isset($url["host"])) return false;
    return !(gethostbyname($url["host"]) == $url["host"]);
}


?>