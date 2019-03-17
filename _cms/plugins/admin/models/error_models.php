<?php 

class ErrorSession 
{
	var $status, $code, $message;
	
	function __construct($params = null)
	{
		foreach($params as $k=>$v)
		{
			if($k == 0)
				{
					$this->status = $v[0];
					$this->code = $v[1];
					$this->message = $v[2];
				}
		}
	}
	
	function get_error()
	{
		return $this;
	}
}