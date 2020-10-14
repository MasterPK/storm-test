<?php

namespace App\Storm;

use StORM\Entity;

/**
 * @table{"name":"products"}
 */
class Product extends Entity
{
	/**
	 * @var int
	 * @column
	 */
	public int $id;
	
	/**
	 * @var string
	 * @column{"mutations":true}
	 */
	public string $name;
	
	
}