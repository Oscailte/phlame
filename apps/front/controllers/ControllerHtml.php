<?php

namespace Phlame\Front\Controllers;

use Phalcon\Registry;
use Phalcon\Text;
//use Phlame\Core\Components\HtmlTag\HtmlTag;
use Phlame\Core\Components\HtmlTag\Doc;
use Phlame\Core\Components\HtmlModel\HtmlModel;

class ControllerHtml extends ControllerBase
{

	//public $htmldoc = array();

	// Set up the htmldoc
	public function initialize()
	{
		$this->view->disable();
		return;

		$this->di->setShared('htmlDoc', function() {
			return new Doc();
		});
		$this->view->disable();
		
		return;
		
		// Set up the view variables
		$this->htmldoc['title'] = 'Phlame Framework';
		$this->htmldoc['meta'] = new Registry();
		$this->htmldoc['css'] = new Registry();
		$this->htmldoc['js'] = new Registry();
		$this->htmldoc['import'] = new Registry();
		$this->htmldoc['jsfooter'] = new Registry();
		$this->htmldoc['menu'] = new Registry();
		

		// Add assets
		$this->htmldoc['meta']->charset = array('charset' => 'utf-8');
		$this->htmldoc['meta']->content_type = array('http-equiv' => 'Content-Type', 'content' => 'text/html');
		$this->htmldoc['meta']->x_ua_compatible = array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge');
		$this->htmldoc['meta']->viewport = array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1');
		
		//$this->htmldoc['css']->bootstrap = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css';
		$this->htmldoc['css']->googleiconfont = 'http://fonts.googleapis.com/icon?family=Material+Icons';
		$this->htmldoc['css']->materialize = 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css';
		
		$this->htmldoc['js']->polymer = 'files/polymer/bower_components/webcomponentsjs/webcomponents-lite.min.js';
		$this->htmldoc['js']->jquery = 'https://code.jquery.com/jquery-2.1.1.min.js';
		$this->htmldoc['js']->materialize = 'https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js';
		
		$this->htmldoc['import']->polymer_paper_button = 'files/polymer/bower_components/paper-button/paper-button.html';
		$this->htmldoc['import']->polymer_paper_input = 'files/polymer/bower_components/paper-input/paper-input.html';
		$this->htmldoc['import']->polymer_iron_ajax = 'files/polymer/bower_components/iron-ajax/iron-ajax.html';
		
		$this->htmldoc['js']->web_components_ready = "
      // To ensure that elements are ready on polyfilled browsers, 
      // wait for WebComponentsReady. 
      document.addEventListener('WebComponentsReady', function() {
        var input = document.querySelector('paper-input');
        var button = document.querySelector('paper-button');
        var greeting = document.getElementById('greeting');
        button.addEventListener('click', function() {
          greeting.textContent = 'Hello, ' + input.value;
        });
      });
		";
		$this->htmldoc['js']->sidenav = "
		$(document).ready(function() {
			$('.button-collapse').sideNav();
		})
		";
		$this->htmldoc['css']->map = "
		google-map {
			height: 500px;
			width: 500px;
		}
		";

		$this->htmldoc['menu']->one = array(
			'href' => 'front/index/index/one',
			'title' => 'Menu One',
			'active' => true
		);
		$this->htmldoc['menu']->two = array(
			'href' => 'front/index/index/two',
			'title' => 'Menu Two',
			'icon' => 'view_module',
			'iconleft' => true
		);
		$this->htmldoc['menu']->three = array(
			'href' => 'front/index/index/three',
			'icon' => 'search'
		);
		$this->htmldoc['menu']->four = array(
			'title' => 'Menu Four',
			'icon' => 'arrow_drop_down',
			'dropdown' => true
		);

		//var_dump ($this->menu);
		//var_dump($this->view->getPartial("shared/menu"));
	}

	// Executed after every found action
	public function afterExecuteRoute($dispatcher)
	{

		return;
		
		//$this->response->setContent($this->htmlDoc);
		//$this->htmlDoc->getBody()->setContent($this->response->getContent());
		
		//$this->response->setContent($this->htmlDoc);
		//return $this->response->send();

		//$item = new Doc();
		$item = new HtmlModel(array(
			'tag' => new Doc()
		));
		
		//var_dump ($doctag->getChild('html')->setAttribute('lang', 'gb'));
		echo '<pre><code>'.htmlentities($item).'</code></pre>';
		
		return;
		
		$test = HtmlTag::factory(array(
			'tagname' => 'doc',
			'children' => array(
				'doctype' => array(
					'tagname' => 'doctype'
				)
			)
		));
		echo '<pre><code>';
		var_dump ($test);
		echo '</code></pre>';
		
		
		return;

		// Set up the assets manager to not output directly
		$this->assets->useImplicitOutput(false);

		// Compile everything into the assets manager
		foreach ($this->htmldoc['css'] as $css) {
			if (Text::startsWith($css, 'http')) {
				$this->assets->addCss($css, false);
			} elseif (Text::startsWith($css, 'files/')) {
				$this->assets->addCss($css);
			} else {
				$this->assets->addInlineCss($css);
			}
		}
		foreach ($this->htmldoc['js'] as $js) {
			if (Text::startsWith($js, 'http')) {
				$this->assets->addJs($js, false);
			} elseif (Text::startsWith($js, 'files/')) {
				$this->assets->addJs($js);
			} else {
				$this->assets->addInlineJs($js);
			}
		}
		$this->assets->collection('jsfooter');
		foreach ($this->htmldoc['jsfooter'] as $js) {
			if (Text::startsWith($js, 'http')) {
				$this->assets->collection('jsfooter')->addJs($js, false);
			} elseif (Text::startsWith($js, 'files/')) {
				$this->assets->collection('jsfooter')->addJs($js);
			} else {
				$this->assets->addInlineJs($js);
			}
		}

		$this->htmldoc['meta-src'] = '';
		foreach ($this->htmldoc['meta'] as $meta) {
			$this->htmldoc['meta-src'] .= $this->tag->tagHtml( 'meta', $meta, true, true, true);
		}

		// Create the css view variable
		$this->htmldoc['css-src'] = $this->assets->outputCss();
		$this->htmldoc['css-inline-src'] = $this->assets->outputInlineCss();

		// Create the javascript view variables
		// Inline scripts are separated
		$this->htmldoc['js-src'] = $this->assets->outputJs();
		$this->htmldoc['js-inline-src'] = $this->assets->outputInlineJs();

		// Create the footer javascript view variable
		$this->htmldoc['jsfooter-src'] = $this->assets->outputJs('jsfooter');

		// Create the import view variable
		$this->htmldoc['import-src'] = '';
		foreach ($this->htmldoc['import'] as $import) {
			$this->htmldoc['import-src'] .= $this->tag->tagHtml('link', array('rel' => 'import', 'href' => $this->url->get($import)), true, true, true);
		}
		
		// Create the menu items
		$this->htmldoc['menu-items'] = $this->_parse_menu_items($this->htmldoc['menu']);

		// Add the variables to the view
		$this->view->setVar('htmldoc', $this->htmldoc);
		$this->view->setVar('menu', $this->view->getPartial('shared/menu'));

	}

	private function _parse_menu_items($menus) {
		$result = '';
		foreach ($menus as $menu) {
			
			$title = '';
			if (!empty($menu['title'])) {
				$title = $menu['title'];
			}
			
			$i = '';
			$i_class = array();
			if (!empty($menu['icon'])) {
				$i_class[] = 'material-icons';
				if (!empty($menu['iconleft'])) {
					$i_class[] = 'left';
				}
				else {
					$i_class[] = 'right';
				}
				$i = $this->tag->tagHtml('i', array('class' => implode(' ', $i_class)))
					.$menu['icon']
					.$this->tag->tagHtmlClose('i');
			}
			
			$href = '#!';
			if (!empty($menu['href'])) {
				$href = $this->url->get($menu['href']);
			}
			
			$a = '';
			$a_attributes = array();
			$a_class = array();
			$a_attributes['href'] = $href;
			if (!empty($a_class)) {
				$a_attributes['class'] = implode(' ', $a_class);
			}
			$a = $this->tag->tagHtml('a', $a_attributes)
				.$title
				.$i
				.$this->tag->tagHtmlClose('a');
			
			$li = '';
			$li_class = array();
			if (!empty($menu['active'])) {
				$li_class[] = 'active';
			}
			$li_attributes = array();
			if (!empty($li_class)) {
				$li_attributes['class'] = implode(' ', $li_class);
			}
			$li = $this->tag->tagHtml('li', $li_attributes)
				.$a
				.$this->tag->tagHtmlClose('li');
				
			$result .= $li;
		}
		
		return $result;

	}

}
