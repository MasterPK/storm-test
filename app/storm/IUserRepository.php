<?php

namespace App\Storm;

interface IUserRepository
{
	public function getUsersWithMoreThanCounter($counter);
	
}