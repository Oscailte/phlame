<?php

namespace Phlame\Frontend\Controllers;

use Phalcon\Events\Manager as EventsManager;
use Phlame\Core\Components\Store\Store;
use Phlame\Core\Components\Store\StoreListener;

class RestController extends ControllerBase
{

    public function indexAction()
    {
		//application/json; charset=UTF-8
		$this->view->disable();
		//echo 'REST INDEX';
		$this->response->setContentType('application/json', 'UTF-8');
		$this->response->setJsonContent(array(
			'status' => 'OK',
			'data' => array(
				'public_description' => 'testing 1 2 3'
			)
		));
		return $this->response;
	}
	
}
