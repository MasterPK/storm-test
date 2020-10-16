<?php
declare(strict_types=1);

namespace App\ProductsModule\Presenters;

use App\Components\Products;
use App\Components\ProductsFactory;
use App\Storm\Product;
use App\Storm\ProductRepository;
use Grid\Datalist;
use Nette\Application\UI\Component;
use Nette\Application\UI\Presenter;
use Pages\Pages;
use Tracy\Debugger;

final class ProductsPresenter extends Presenter
{
	/** @persistent */
	public $lang;
	
	/** @var \App\Storm\ProductRepository @inject */
	public ProductRepository $productRepo;
	
	/** @var \Pages\Pages @inject */
	public Pages $pages;
	
	public function actionDefault($onPage = 2)
	{
		$this["products"] = new Datalist($this->productRepo->many(), $onPage, "name_.$this->lang", "ASC");
		
		$this->template->itemsOnPage = $this["products"]->getItemsOnPage();
		$this->template->paginator = $this["products"]->getPaginator();
		
	}
	
	public function createComponentProductsList($name):Component
	{
		return ProductsFactory::create($this->productRepo,$this->getParameter("onPage",2),$this->lang);
	}
	
	public function beforeRender()
	{
	}
	
	public function renderDetail(Product $product, $counter = null)
	{
		$this->template->product = $product;
	}
}