<?php
require_once('config.php');
require_once('myfunc.php');

if ($_GET['type'] === 'delete') {
	$json = '
	{
	  "fields":[
	    "greeting"
	  ]
	}';
	requestDelete($json);
} elseif ($_GET['type'] === 'insert') {
	$json = '
	{
	  "greeting":[
	    {
			"locale":"default",
			"text":"Xin Chào {{user_full_name}}. Xem hướng dẫn để biết cách sử dụng nhé^^"
	    },
	    {
			"locale":"en_US",
			"text":"Xin Chào {{user_full_name}}. Xem hướng dẫn để biết cách sử dụng nhé^^"
	    },
	    {
	    	"locale":"vi_VN",
	    	"text":"Xin Chào {{user_full_name}}. Xem hướng dẫn để biết cách sử dụng nhé^^"
	    }
	  ]
	}';
	requestInsert($json);
}
?>