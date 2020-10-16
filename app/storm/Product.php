<?php

namespace App\Storm;

use StORM\Entity;

/**
 * @table{"name":"products"}
 */
class Product extends Entity
{
	
	/**
	 * @var string
	 * @column{"mutations":true}
	 */
	public string $name;
	
	/**
	 * @var int|null
	 * @column
	 */
	public ?int $counter;
	
	
}