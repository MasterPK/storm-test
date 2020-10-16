<?php
declare(strict_types=1);

namespace App\Components;

use App\Storm\ProductRepository;
use Grid\Datalist;
use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;
use Nette\Forms\Controls\TextInput;
use StORM\ICollection;
use Tracy\Debugger;

class Products extends Datalist
{
	
	private $lang;
	
	public function __construct(ProductRepository $productRepository, $onPage, $lang)
	{
		parent::__construct($productRepository->many());
		$this->getPaginator()->setItemsPerPage($onPage);
		
		$this->addFilterExpression('q', function (ICollection $source, $value) use ($lang) {
			$source->where("name_" . $lang . " LIKE :q", ['q' => "%" . $value . '%']);
		}, ''); // '' default value
		
		$this->getFilterForm()->addText('q');
		$this->getFilterForm()->addSubmit('submit');
		
		$this->lang = $lang;
	}
	
	public function render(): void
	{
		$this->template->lang = $this->lang;
		$this->template->paginator = $this->getPaginator();
		$this->template->render(__DIR__ . "/Products.latte");
	}
	
	protected function createComponentForm(): Form
	{
		$form = new Form();
		$form->addComponent(new Multiplier(function ($id){
			return new TextInput();
		}),"priority");
		$form->addSubmit("saveall");
		return $form;
	}
	
}