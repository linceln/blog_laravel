<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{

	public function __construct()
	{
		parent::__construct();
	}

} 