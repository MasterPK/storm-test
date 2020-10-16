<?php

declare(strict_types=1);

namespace App\WebModule\Presenters;

use App\Storm\Product;
use App\Storm\ProductRepository;
use App\Storm\UserRepository;
use Nette\Application\UI\Presenter;
use Pages\DB\IPageRepository;
use StORM\DIConnection;
use Pages\Pages;
use Pages\DB;
use Pages\Helpers;
use Pages\DB\PageRepository;
use Tracy\Debugger;

final class IndexPresenter extends Presenter
{
	/** @var \StORM\DIConnection @inject */
	public DIConnection $storm;
	
	/** @var \App\Storm\UserRepository @inject */
	public UserRepository $users;
	
	/** @var \App\Storm\ProductRepository @inject */
	public ProductRepository $productRepo;
	
	/** @var PageRepository @inject */
	public PageRepository $pageRepo;
	
	/** @var DB\SitemapRepository @inject */
	public DB\SitemapRepository $siteMapRepo;
	
	/** @var Pages @inject */
	public Pages $pages;
	
	public function actionDefault()
	{
		/*$sitemap = $this->siteMapRepo->createOne([
			"lastmod" => "2020-10-15",
			"changefreq" => "monthly",
			"priority" => 0.5,
		]);*/
		
		/*$sitemap = $this->siteMapRepo->many()->setTake(1)->fetch();
		
		$this->pageRepo->createOne([
			"url" => ["en" => "products-3", "cz" => "produkty-3"],
			"type" => "productsList",
			"params" => Helpers::serializeParameters(["onePage"=>3]),
			"sitemap" => $sitemap->getPK()
		]);*/
		
		/*$this->productRepo->createMany(
			[
				[
					"name" => [
						"en" => "chair",
						"cz" => "židle",
					],
					"counter" => 10,
				],
				[
					"name" => [
						"en" => "charger",
						"cz" => "nabijecka",
					],
					"counter" => 2,
				],
			]
		);*/
		
		/*foreach ($this->pageRepo->many() as $row){
			Debugger::dump($row->sitemap);
		}*/
		
		//$this->productRepo->createOne(["name"=>["cz"=>"dvere","en"=>"doors"]]);
		
	}
}