<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
$config = [
	'db_host' => 'mysql5.gear.host',
	'db_user' => 'thathinh',
	'db_name' => 'thathinh',
	'db_pass' => 'Ca0r5?P_5qH0'
];
$accessToken = 'EAALWPdZBmXv0BAGZBTlZAW0LLxK930WHKO8fPmt5bfgs0OJ6QmlZB3eODfXhYND8mXJP7627X4UKMZA0dZB3zxJiazSBwkYWFHQlPhJ67rJM28dBPMwSu01LHZAuUHwNNvKKEiZBJ8qZB3HhIZBuN9pPKK8gXvONd2FyGI72xZAmg3jWL9xip1ep1sB';
$verifyToken = 'manhnghiane';
$conn = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
mysqli_set_charset($conn,"utf8");
?>