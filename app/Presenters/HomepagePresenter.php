<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Storm\Product;
use App\Storm\UserRepository;
use App\Storm\User;
use Nette;
use StORM\DIConnection;
use StORM\Literal;
use Tracy\Debugger;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	/** @var \StORM\DIConnection @inject */
	public DIConnection $storm;
	
	/** @var \App\Storm\UserRepository @inject */
	public UserRepository $users;
	
	public function actionDefault()
	{
		$this->storm->setMutation("cz");
		
		/** @var \App\Storm\ProductRepository $products */
		$products=$this->context->getService("db.product");
		
		/** @var Product $product */
		$product=$products->many()->first();
		
		//Debugger::dump($product->getValue("name","cz"));
		//Debugger::dump($product->getValue("name","en"));
		
		Debugger::dump($product->name);
		
		
		
		/** @var User[] $users */
		$users=$this->users->many();
		
		
		//$sub = new Literal("SELECT MAX(count) FROM users WHERE name=:name",["name"=>"Petr"]);
		
		Debugger::dump($this->users->getUsersWithMoreThanCounter(15)->toArray());
		
		$subselect = $this->storm->rows(['products'])->setSelect(["MAX(counter)"]);
		$this->storm->rows(['users'])->where("id", 1)->update(["counter" => $subselect]);
		
	}
}
