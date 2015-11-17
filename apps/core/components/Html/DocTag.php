<?php

namespace Phlame\Core\Components\Html;

use \Phalcon\Mvc\User\Component;
use \Phalcon\Text;
use \Phalcon\Registry;

class DocTag extends Tag {

	protected $_tagName = '';
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
				//'doctype' => new DocTypeTag(),
				'doctype' => array(
					'tagname' => 'doctype'
				),
				'html' => array(
					'tagname' => 'html',
					'attributes' => array(
						'lang' => 'en'
					),
					'children' => array(
						'head' => array(
							'tagname' => 'head'
						),
						'body' => array(
							'tagname' => 'body'
						)
					)
				)
			)
		);
	}
	
}
