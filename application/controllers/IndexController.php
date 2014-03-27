<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new Application_Form_MailSender();
        $request = $this->getRequest();
        $this->view->resultMessage='Please input an Email Address';
        if ($request->isPost()) {
        	if ($form->isValid($request->getPost())) {
        		if ($this->mailSender($form->getValues())) {
        			// We're authenticated! Redirect to the home page
        		    $this->view->resultMessage='Message has been sent!';
        			//$this->_helper->redirector('index', 'index');
        			
        		}else{
        			echo "wrong";
        		}
        	}
        }
        $this->view->form = $form;
    }

    public function mailSender($values){
        set_time_limit(0);
        $mailTransport = new Zend_Mail_Transport_Smtp('smtp.gmail.com',
          array('auth' => 'login',
        		'username' => 'zhangcreativeworx',
        		'password' => 'creativeworx',
        		'ssl' => 'ssl'));
        $mail = new Zend_Mail('utf-8');
        $mail->setBodyHtml('Sent via HTML form using PHP to '.$values['email_address']);
        $mail->setSubject('HTML Form Test');
        //$mail->createAttachment( file_get_contents('E:\\sina.png'), 'image/png', Zend_Mime::DISPOSITION_INLINE  , Zend_Mime::ENCODING_BASE64 , 'sina.png');
        $mail->setFrom('zhangcreativeworx@gmail.com', 'creativeworx');
        $mail->addTo($values['email_address'], 'zhang');
        $mail->send($mailTransport);
        return true;
    }

}

