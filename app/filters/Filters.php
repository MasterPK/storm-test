<?php

namespace App\Filters;

use Tracy\Debugger;

class Filters
{
	
	public function filterIn(string $url): ?string
	{
		return $url."A";
	}
	
	public function filterOut(string $url): ?string
	{
		return $url.".html";
	}
}