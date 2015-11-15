<?php

namespace Phlame\Core\Components\Store;

use Phalcon\Events\EventsAwareInterface;
use Phalcon\Events\ManagerInterface;

class Store implements EventsAwareInterface
{
    protected $_eventsManager;

    public function setEventsManager(ManagerInterface $eventsManager)
    {
        $this->_eventsManager = $eventsManager;
    }

    public function getEventsManager()
    {
        return $this->_eventsManager;
    }

	public function getData()
	{
		return '1 2 3';
	}

    public function someTask()
    {
        $this->_eventsManager->fire("store:beforeSomeTask", $this);

        // Do some task
        echo "Here, someTask\n";

        $this->_eventsManager->fire("store:afterSomeTask", $this);
    }
}
