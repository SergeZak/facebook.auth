<?php

class Configs{

	public $configs;

	function __construct()
	{
		$this->configs = parse_ini_file('config.ini');
	}

}