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
		$this->storm->setMutation("en");
		
		/** @var \App\Storm\ProductRepository $products */
		$products=$this->context->getService("db.product");
		
		/** @var Product $product */
		$product=$products->many()->first();
		
		Debugger::dump(serialize($product));
		
		$users=$this->users->many();
		
		//$this->storm->createRow("products",["name_cz"=>"stul","name_en"=>"table"]);
		
		$products->createOne(["name"=>["cz"=>"stul","en"=>"table"]]);
		
		//$sub = new Literal("SELECT MAX(count) FROM users WHERE name=:name",["name"=>"Petr"]);
		
		$subselect = $this->storm->rows(['products'])->setSelect(["MAX(counter)"]);
		$this->storm->rows(['users'])->where("id", 1)->update(["counter" => $subselect]);
		
	}
}
