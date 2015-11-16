<?php

namespace Phlame\Front\Controllers;

use Phalcon\Events\Manager as EventsManager;
use Phlame\Core\Components\Store\Store;
use Phlame\Core\Components\Store\StoreListener;
use Phlame\Core\Components\Html\Tag;

class IndexController extends ControllerHtml
{

	public function indexAction()
	{

		echo 'front index index';

		// Create the store instance
		$store   = new Store();

		// Bind the eventsManager to the instance
		$store->setEventsManager($this->eventsManager);

		// Attach the listener to the EventsManager
		$this->eventsManager->attach('store', new StoreListener());

		// Execute methods in the component
		$store->someTask();

	}

}
