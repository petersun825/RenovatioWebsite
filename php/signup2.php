<?php

if (isset($_POST['submit'])) {
        
        $from = $_POST['email'];
        $to = 'peter@renovatiotech.mx';
        $subject = 'Email signup';
        $body = 'Please sign me up to the mailing list';
        
        if (!$_POST['email']) {
            $emailError = '<div class="text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;Please enter a valid email address</div>';
        }
        
        if (!$emailError) {
            if (mail ($to, $subject, $body, $from)) {
                $result = '<div class="text-success"><i class="fa fa-check" aria-hidden="true"></i> &nbsp;thank you we\'ll keep you updated</div>';
            } else {
                $result = '<div class="text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;sorry there has been an error, please try again</div>';
            }
        }
        
    }
          
    ?>