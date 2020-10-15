<?php
declare(strict_types=1);

namespace App\ProductsModule\Presenters;

use App\Storm\Product;
use App\Storm\ProductRepository;
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
	
	public function actionDefault($counter)
	{
		$this->template->products = $this->productRepo->many();
		Debugger::dump($this->getHttpRequest()->getUrl());
		Debugger::dump($this->pages->getPage());
	}
	
	public function beforeRender()
	{
		Debugger::barDump($this->lang);
	}
	
	public function renderDetail(Product $product, $counter = null)
	{
		$this->template->product = $product;
		Debugger::barDump($counter);
	}
}