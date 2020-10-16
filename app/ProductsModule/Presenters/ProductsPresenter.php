<?php
declare(strict_types=1);

namespace App\ProductsModule\Presenters;

use App\Components\Products;
use App\Components\ProductsFactory;
use App\Storm\Product;
use App\Storm\ProductRepository;
use Grid\Datagrid;
use Grid\Datalist;
use Nette\Application\UI\Component;
use Nette\Application\UI\Presenter;
use Nette\Forms\Controls\TextInput;
use Pages\Pages;
use Tracy\Debugger;
use Nette;

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
		$this["products"] = new DataGrid($this->productRepo->many(), $onPage, "name_.$this->lang", "ASC");
		
		$this["products"]->addColumn("UUID", function (Product $product) {
			return $product->uuid;
		});
		
		$column = $this["products"]->addColumn("Name", function (Product $product) {
			return $product->name;
		}, "%s", "name_cz");
		
		$column->onRenderCell[] = function (Nette\Utils\Html $td, Product $object) {
			if ($object->name === 'stul') {
				$td->setAttribute('style', 'background-color: red')->setHtml('pes');
			}
		};
		
		$this["products"]->addColumn("Count", function (Product $product) {
			return $product->counter;
		});
		
		$this["products"]->addColumn("Hidden", function (Product $product) {
			return $product->hidden;
		});
		
		$this["products"]->addColumnAction("Zobrazit", "<a href=\"%s\">This++</a>", function (Product $object) {
			$object->update(["counter" => $object->counter + 1]);
			$this->redirect("this");
		});
		
		$this["products"]->addColumnInput("Změnit count", "counter", function ($object) {
			return new TextInput();
		});
		
		$datagrid = $this["products"];
		$datagrid->onRender[] = function (Nette\Utils\Html $tbody, $columns) {
			if (count($tbody) === 0) {
				$tbody->addHtml((Nette\Utils\Html::el('tr')->addHtml(Nette\Utils\Html::el('td', ['colspan' => count($columns)])->setText('nic'))));
			}
		};
		
		$submit = $this["products"]->getForm()->addSubmit("submit", "Uložit");
		
		
		
		$submit->onClick[] = function ($button) use ($datagrid) {
			foreach ($datagrid->getInputData(["counter"]) as $id => $data) {
				$datagrid->getSource()->where($datagrid->getSourceIdName(), $id)->update($data);
			}
			$datagrid->presenter->redirect("this");
		};
		
		$submit = $datagrid['form']->addSubmit('delete', 'Smazat');
		$submit->onClick[] = function ($button) use ($datagrid) {
			$datagrid->deletedSelected();
			$datagrid->presenter->redirect('this');
		};
		
		$datagrid->addColumnSelector();
		
		$submit = $datagrid->getForm()->addSubmit('hideSelected', 'Skrýt označene');
		$submit->onClick[] = function ($button) use ($datagrid) {
			$datagrid->getSource()->where('uuid', $datagrid->getSelectedIds())->update(['hidden' => 1]);
			$datagrid->presenter->redirect('this');
		};
		
		$this->template->itemsOnPage = $this["products"]->getItemsOnPage();
		$this->template->paginator = $this["products"]->getPaginator();
		
	}
	
	public function createComponentProductsList($name): Component
	{
		return ProductsFactory::create($this->productRepo, $this->getParameter("onPage", 2), $this->lang, $this->getSession("datalist"));
	}
	
	public function beforeRender()
	{
	}
	
	public function renderDetail(Product $product, $counter = null)
	{
		$this->template->product = $product;
	}
}