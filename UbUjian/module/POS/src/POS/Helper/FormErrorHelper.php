<?php
namespace POS\Helper;

use Zend\Form\View\Helper\FormElementErrors as OriginalFormElementErrors;

class FormErrorHelper extends OriginalFormElementErrors  
{
    protected $messageCloseString     = '</span>';
    protected $messageOpenFormat      = '<span class="errorText">';
    protected $messageSeparatorString = '</span><span class="errorText">';
}
?>