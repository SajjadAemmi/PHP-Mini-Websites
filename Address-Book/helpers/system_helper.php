<?php
	function formatdate($date)
	{
		return date('j F Y, g:i a', strtotime($date));
	}	
	
	function shortentext($text, $chars = 450)
	{
		$text = $text." ";
		$text = substr($text, 0, $chars);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text."...";
		return $text;	
	}
	function is_active($category)
	{
		if(isset($_GET['category']))
		{
			if($_GET['category'] == $category)
			{
				return 'active';	
			}
			else
			{
				return '';
			}
		}
		else
		{
			if($category == null)
			{
				return 'active';
			}
		}
	}
	
	function redirect($page = FALSE, $message = NULL, $message_type = NULL)
	{
		if(is_string($page))
		{
			$location = $page;
		}
		else
		{
			$location = $_SERVER['SCRIPT_NAME'];
		}
		
		if($message != NULL)
		{
			$_SESSION['message'] = $message;
		}
		
		if($message_type != NULL)
		{
			$_SESSION['message_type'] = $message_type;
		}
		
		header('Location: '.$location);
		exit;
	}	
	
?>