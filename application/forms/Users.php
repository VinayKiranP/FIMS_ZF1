<?php
class Application_Form_Users extends Zend_Form
{
	public function init()
	{
		$this->setName('user');
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('Name')
				->setRequired(true);
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email')
				->setRequired(true);
				
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$this->addElements(array($id, $name, $email, $submit));
	}
}

?>