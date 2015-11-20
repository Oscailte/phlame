<?php

namespace Phlame\Core\Components\HtmlTag;

class Doc extends HtmlTag {

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
							'tagname' => 'head',
							'children' => array(
								'meta' => array(),
								'title' => array(
									'tagname' => 'title'
								),
								'headitems' => array(),
							),
						),
						'body' => array(
							'tagname' => 'body',
							'children' => array(
								'content' => array(),
								'footeritems' => array()
							)
						)
					)
				)
			)
		);
	}
	
}
