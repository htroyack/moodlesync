<?php
 // Baseado em https://raw.githubusercontent.com/moodlehq/sample-ws-clients/master/PHP-REST/client.php
 $token = $_POST["token"];
 $domainname = 'http://35.164.172.69/moodle_hom_atual/';
 $functionname = 'core_user_create_users';
 $restformat = 'json';

 $user = new stdClass();
 $user->username = $_POST["username"];
 $user->auth = 'manual';
 // TODO: Generate password and notify user
 $user->password = $_POST["password"];
 $user->firstname = $_POST["firstname"];
 $user->lastname = $_POST["lastname"];
 $user->email = $_POST["email"];
 $user->city = $_POST["city"];
 $user->country = 'BR';
 // Use Server timezone
 $user->timezone = '99';
 $users = array($user);
 $params = array('users' => $users);

 header('Content-Type: text/plain');
 $serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
 require_once('./curl.php');
 $curl = new curl;

 //if rest format == 'xml', then we do not add the param for backward compatibility with Moodle < 2.2
$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
$resp = $curl->post($serverurl . $restformat, $params);
print_r($resp);
?>
