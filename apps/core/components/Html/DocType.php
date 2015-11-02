<?php

namespace Phlame\Core\Components\Html;

class DocType extends Base
{

	protected $_useTag = false;

	public function setDocType($doctype)
	{
		$this->tag->setDocType($doctype);
	}

	public function getDocType()
	{
		return $this->tag->getDocType();
	}

	public function getContent()
	{
		return $this->getDocType();
	}

}
