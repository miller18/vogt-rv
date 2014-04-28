

<?php
function dbConnect($usertype, $connectionType = 'mysqli') {
    global $connection;
    //$host = 'vrvTest.db.11732073.hostedresource.com';
    $host = 'vrvprod.vogtrv.com';
    $db = 'vrvprod';
    
    if ($usertype  == 'read') {
        $user = 'miller18';
        $pwd = '!2Rbaayyeg318';
    } elseif ($usertype == 'write') {
        $user = 'miller18';
        $pwd = '!2Rbaayyeg318';
    } else {
        exit('Unrecognized connection type');
    }
    
    if ($connectionType == 'mysqli') {
        $connection = new mysqli($host, $user, $pwd, $db) or die ('Cannot open database');
        return $connection;
    } else {
        try {
            return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        } catch (PDOException $e) {
            echo 'Cannot connect to database';
            exit;
        }
    }
}