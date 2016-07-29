<?php

require_once 'core/init.php';
print "<h1 style=\"text-align:center; margin-top:300px; font-family:arial; text-decoration:none;\"><a href=\"https://www.youtube.com/watch?v=RBQ-IoHfimQ\">#Hi</a></h1>";
$user = new User();
if($user->isLoggedIn()) {
	print Session::flash('home');
	print "<p>Hello</p><a href=profile.php?username=" . escape($user->data()->username) . ">" . escape($user->data()->username) . "</a><p><a href='logout.php'>Want to logout?</a></p>";
} else {
	print Session::flash('home');
	print "</br><a href='login.php'>Want to login?</a>";
}
if($user->hasPermission('admin')) {
	print 'You are an admin';
} else {
	print 'who are you';
}
print $user->data()->active;
?>
