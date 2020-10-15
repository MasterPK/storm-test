<?php

namespace App\Storm;

use StORM\Entity;
use StORM\RelationCollection;

/**
 * @table{"name":"users"}
 */
class User extends Entity
{
	
	/**
	 * @var string
	 * @column
	 */
	public string $name;
	
	/**
	 * @var int|null
	 * @column
	 */
	public ?int $counter;
	
	/**
	 * @var int|null
	 * @column
	 */
	public ?int $counter2;
	
	/**
	 * @var int
	 * @column
	 */
	public int $id;
	
	/**
	 * @var \App\Storm\Product
	 * @relation
	 */
	public ?Product $product;
	
	/**
	 * @relationNxN
	 * @var RelationCollection<\App\Storm\Product>|\App\Storm\Product[]
	 */
	public RelationCollection $products;
	
	
	
}