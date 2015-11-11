<?php

namespace Phlame\Frontend\Controllers;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
		echo '<br/>index - polymer test<br/>';
		//$this->dumpInfo();
    }
    
    public function aAction()
    {
		$this->dumpInfo();
	}
	
	private function dumpInfo() {
		
		echo '<hr/>';
		echo 'Namespace: '.$this->dispatcher->getNamespaceName().'<br/>';
		echo 'Module: '.$this->dispatcher->getModuleName().'<br/>';
		echo 'Controller: '.$this->dispatcher->getControllerName().'<br/>';
		echo 'Action: '.$this->dispatcher->getActionName().'<br/>';
		echo 'Params: ';
		var_dump($this->dispatcher->getParams());
		echo '<br/>';

		echo 'Defaults: <pre>';
		var_dump($this->router->getDefaults());
		echo '</pre><br/>';

		echo 'MatchedRoute: <pre>';
		var_dump($this->router->getMatchedRoute());
		echo '</pre><br/>';
		echo 'RewriteUri: ';
		var_dump($this->router->getRewriteUri());
		echo '<br/>';
		
		echo '$_REQUEST:<br/>';
		echo '<pre>';
		print_r ($_REQUEST);
		echo '</pre>';
		
		echo '$_SERVER:<br/>';
		echo '<pre>';
		print_r ($_SERVER);
		echo '</pre>';
		
    }

}

