<?php 

$suspect = false;

// pattern to locate suspect phrases

$pattern = '/Content-Type: |Bcc: |Cc:/i';

// fuction to check for suspect phrases

function isSuspect($val, $pattern, &$suspect) {
    if (is_array($val)) {
        foreach ($val as $item) {
            isSuspect($item, $pattern, $suspect);
        }
    } else {
        if (preg_match($pattern, $val)) {
            $suspect = true;
        }
    }
}

isSuspect($_POST, $pattern, $suspect);

if (!$suspect) {
    foreach ($_POST as $key => $value) {
        // assign to temp variable and strip whitespace if not an array
        $temp = is_array($value) ? $value : trim($value);
        
        // if empty and require, add to $missing variable 
        if (empty($temp) && in_array($key, $required)) {
            $missing[] = $key;
        } elseif (in_array($key, $expected)) {
            // otherwhite, assign to a variable of the same name as the key
            ${$key} = $temp;      
        }
    }
}

// validate user's email address 
if (!$suspect && !empty($email)) {
    $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($validemail) {
        $headers .= "\r\nReply-To: $validemail";
    } else {
        $errors['email'] = true;
    }
}

$mailsent = false;

if (!$suspect && !$missing && !$errors) {
    $message = '';
    foreach ($expected as $item) {
        
        // assing the value of the current item to val
        if (isset(${$item}) && !empty(${$item})) {
            $val = ${$item} ;
        } else {
            $val = 'Not Selected';
        }
        
        // if an array, expand as comma-separated string
        if (is_array($val)) {
            $val = implode(', ', $val);
        }
        
        //replace underscores and hyphens in the labels with spaces
        $item = str_replace(array('_', '-'),  ' ', $item);
        
        //add label and value to the message body
        $message .= ucfirst($item) . ": $val\r\n\r\n";
    }
    
    //limit the line length to 70 characters
    $message = wordwrap($message, 70);
    
    $mailsent = mail($to, $subject, $message, $headers);
    if (!$mailsent) {
        $errors['mailfail'] = true;
    }
}