<?php

namespace Phlame\Frontend\Controllers;

//use Phalcon\Mvc\Controller;
use Phlame\Core\Components\Html\Doc;

class ControllerHtml extends ControllerBase
{

	// Set up the htmldoc
	public function initialize()
	{
		$this->di->setShared('htmlDoc', function() {
			return new Doc();
		});
		$this->view->disable();
	}

	// Executed after every found action
	public function afterExecuteRoute($dispatcher)
	{
		$this->response->setContent($this->htmlDoc);
		return $this->response;
	}

}
