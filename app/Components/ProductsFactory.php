<?php
declare(strict_types=1);

namespace App\Components;

use App\Storm\ProductRepository;

abstract class ProductsFactory
{
	
	 static public function create(ProductRepository $productRepository, $onPage, $lang){
		return new Products($productRepository,(int)$onPage,$lang);
	}
}