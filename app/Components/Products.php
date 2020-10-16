<?php
declare(strict_types=1);

namespace App\Components;

use App\Storm\ProductRepository;
use Grid\Datalist;
use Grid\OnPageForm;
use Grid\OrderForm;
use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;
use Nette\Forms\Controls\TextInput;
use StORM\ICollection;
use Tracy\Debugger;

class Products extends Datalist
{
	
	private $lang;
	
	public function __construct(ProductRepository $productRepository, $onPage, $lang, $session)
	{
		parent::__construct($productRepository->many());
		$this->getPaginator()->setItemsPerPage($onPage);
		//$this->setDefaultOnPage(2);

		$this->addFilterExpression('q', function (ICollection $source, $value) use ($lang) {
			$source->where("name_" . $lang . " LIKE :q", ['q' => "%" . $value . '%']);
		}, ''); // '' default value
		
		$this->getFilterForm()->addText('q');
		$this->getFilterForm()->addSubmit('submit');
		
		$this->lang = $lang;
		
		//$this->onLoadState[] = Datalist::loadSession($session);
		//$this->onSaveState[] = Datalist::saveSession($session);
		
		$this->setOrder("name_cz","ASC");
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
		
		$form->setMethod('get');
		$form->addSelect('onpage', null, ['2' => '2', '3' => '3', '5' => '5'])
			->setHtmlAttribute('name', 'productsList-onpage')
			->setDefaultValue($this->getOnPage());
		
		$form->onValidate[] = function ($form) {
			if ($form['onpage']->getValue() === null) {
				$form['onpage']->setValue($this->getOnPage());
				$form['onpage']->cleanErrors();
			}
		};
		
		$form->addSubmit('submit');
		$form->onAnchor[] = function ($form) {
			$form->getAction()->setParameter('datalist-onpage', null);
		};
		
		return $form;
	}
	
	protected function createComponentOnPageForm(): OnPageForm
	{
		$form = new OnPageForm([2 => 2, 3 => 3, 5 => 5]);
		$form->addSubmit('submit')->setHtmlAttribute('name', '');
		
		return $form;
	}
	
	
	protected function createComponentOrderForm(): OrderForm
	{
		$form =  new OrderForm(['name-ASC' => 'vzestupne', 'name-DESC' => 'sestupne']);
		$form->addSubmit('submit')->setHtmlAttribute('name', '');
		
		return $form;
	}
}