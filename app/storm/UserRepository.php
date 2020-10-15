<?php

namespace App\Storm;

use StORM\Collection;
use StORM\Repository;

class UserRepository extends Repository implements IUserRepository
{
	
	public function getUsersWithMoreThanCounter($counter)
	{
		return $this->many()->where("counter>:counter",["counter"=>$counter]);
	}
	
	
	public function filterFullname(string $q, Collection $collection)
	{
		return $collection->where('name LIKE :q', ["q"=>"%$q%"])->toArray();
	}
}