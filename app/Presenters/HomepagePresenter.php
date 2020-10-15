<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Storm\ProductRepository;
use App\Storm\UserRepository;
use Nette;
use Pages;
use Pages\DB\IPageRepository;
use StORM\DIConnection;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	/** @var \StORM\DIConnection @inject */
	public DIConnection $storm;
	
	/** @var \App\Storm\UserRepository @inject */
	public UserRepository $users;
	
	/** @var \App\Storm\ProductRepository @inject */
	public ProductRepository $productRepo;
	
	/** @var \Pages\DB\IPageRepository @inject */
	public IPageRepository $pageRepo;
	
	/** @var \Pages\DB\ISitemapRepository @inject */
	public Pages\DB\ISitemapRepository $siteMapRepo;
	
	/** @var Pages\Pages @inject */
	public Pages\Pages $pages;
	
	public function actionDefault()
	{
		
		$this->template->page=$this->pages->getPage();
		
		
		
	}
}
