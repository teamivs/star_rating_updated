<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function send_email($to, $cc, $subject, $message, $attach = null)
{
    // Get CI instance
    $CI = &get_instance();

    // Load the email library
    $CI->load->library('email');

    // Set up email configuration
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.rediffmailpro.com';
    $config['smtp_port'] = 587;
    $config['smtp_user'] = 'info@ivssoftware.com';
    $config['smtp_pass'] = 'Ivision@101';
    $config['smtp_crypto'] = 'tls';
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['crlf'] = "\r\n";
    $config['newline'] = "\r\n";

    // Initialize email library with the config
    $CI->email->initialize($config);

    // Set email parameters
    $CI->email->from('info@ivssoftware.com', 'Your Company Name');
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($message);

    // Add CC if provided
    if ($cc) {
        $CI->email->cc($cc);
    }

    // Add attachment if provided
    if ($attach) {
        $CI->email->attach($attach);
    }

    // Send the email
    if ($CI->email->send()) {
        $CI->email->clear(true);  // Clear any data in email object
        return true;
    } else {
        // Show error if email fails
        show_error($CI->email->print_debugger());
        $CI->email->clear(true);
        return false;
    }
}
