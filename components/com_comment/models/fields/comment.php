<?php

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');


class JFormFieldComment extends JFormField
{

	protected $type = 'comment';

	protected function getInput()
	{
		$html = '<input type="file" name="' . $this->name . '[]" multiple>';

		return $html;
	}
}