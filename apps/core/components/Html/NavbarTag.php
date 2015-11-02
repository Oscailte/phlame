<?php

namespace Phlame\Core\Components\Html;

use \Phalcon\Mvc\User\Component;
use \Phalcon\Text;
use \Phalcon\Registry;

class NavbarTag extends Tag {

	protected $_tagName = 'div';
	//protected $_tagDisplay = true;
	//protected $_tagSelfClose = false;
	
	//protected $_eol = true;
	
	protected $_attributes = array(
		'class' => 'navbar navbar-inverse navbar-fixed-top'
	);
	//protected $_children;
	
	public function getDefault() {
		return array(
			'children' => array(
				'container' => array(
					'tagName' => 'div',
					'attributes' => array(
						'class' => 'container-fluid'
					),
					'children' => array(
						'header' => array(
							'tagName' => 'div',
							'attributes' => array(
								'class' => 'navbar-header'
							),
							'children' => array(
								'brand' => array(
									'tagName' => 'a',
									'attributes' => array(
										'class' => 'navbar-brand',
										'href' => '#'
									),
									'children' => array('Brand')
								)
							)
						),
						'collapse' => array(
							'tagName' => 'div',
							'attributes' => array(
								'class' => 'collapse navbar-collapse',
								'id' => 'navbar-collapse'
							),
							'children' => array(
								'nav' => array(
									'tagName' => 'ul',
									'attributes' => array(
										'class' => 'nav navbar-nav'
									),
									'children' => array(
										'link_li_1' => array(
											'tagName' => 'li',
											'attributes' => array(
												'class' => 'active'
											),
											'children' => array(
												'link_a_1' => array(
													'tagName' => 'a',
													'attributes' => array(
														'href' => '#'
													),
													'children' => array('Link 1')
												)
											)
										),
										'link_li_2' => array(
											'tagName' => 'li',
											'children' => array(
												'link_a_2' => array(
													'tagName' => 'a',
													'attributes' => array(
														'href' => '#'
													),
													'children' => array('Link 2')
												)
											)
										)
									)
								)
							)
						)
					)
				)
			)
		);
	}
	
}
