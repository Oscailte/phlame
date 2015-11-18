<?php

namespace Phlame\Core\Components\Html;

class DocTag extends Tag {

	protected $_tagName = 'doc';
	protected $_tagDisplay = false;
	//protected $_tagSelfClose = false;
	//protected $_eol = true;
	//protected $_attributes = array();
	//protected $_children;
	
	public function getDefault() {
		return array(
			'children' => array(
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
