<?php

function auth($login, $passwd) {
	if (!$login || !$passwd)
		return false;
	$account = unserialize(file_get_contents("../private/passwd"));
	if ($account) {
		foreach($account as $key=>$val) {
			if ($login === $val['login'] && hash('whirlpool', $passwd = $val['passwd']))
				return true;
		}
	}
	return false;
}

?>
