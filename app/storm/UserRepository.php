<?php

namespace App\Storm;

use StORM\Repository;

class UserRepository extends Repository implements IUserRepository
{
	
	public function getUsersWithMoreThanCounter($counter)
	{
		return $this->many()->where("counter>:counter",["counter"=>$counter]);
	}
}