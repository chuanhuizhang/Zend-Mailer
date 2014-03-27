<?php

class Application_Form_MailSender extends Zend_Form
{

    public function init()
    {
        $this->setName("mail_sender");
        $this->setMethod('post');
        $this->addElement('text', 'email_address', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', false, array(0, 50)),
                array('EmailAddress',TRUE)
            ),
            'required'   => true,
            'label'      => 'Eamil Address:',
        ));

        $this->addElement('submit', 'login', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Send',
        )); 
    }


}

