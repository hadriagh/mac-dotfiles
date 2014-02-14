<?php
function install_dnsmasq() {
	$destinationFile = '/usr/local/etc/dnsmasq.conf';
	copy(__DIR__ . '/dnsmasq.conf', $destinationFile);
	$conf = file_get_contents($destinationFile);
	$domain = getenv('DOMAIN') ?: '.dev';
	if ($domain{0} == '.') {
		$domain  = ".$domain";
	}
	$conf = str_replace('|DOMAIN|', $domain, $conf);
	file_put_contents($destinationFile, $conf);
	
	$resolverFile = "/etc/resolver/" . trim($domain, '.');
	$resolverFileContents = "nameserver 127.0.0.1";
	$command = "sudo -s -- 'mkdir /etc/resolver && echo \"$resolverFileContents\" >> $resolverFile'";
	@shell_exec($command);
}

function install_phpfpm() {
	$destinationFile = '/usr/local/etc/php-fpm.conf';
	copy(__DIR__ . '/php-fpm.conf', $destinationFile);
	$conf = file_get_contents($destinationFile);
	$user = get_current_user();
	$conf = str_replace('|USER|', $user, $conf);
	file_put_contents($destinationFile, $conf);
}

function install_nginx() {
	$destinationFile = "/usr/local/etc/nginx/nginx.conf";
	$homePath = getenv('HOME');
	$user = get_current_user();
	$domain = getenv('DOMAIN') ?: '.dev';
	if ($domain{0} != '.') {
		$domain  = ".$domain";
	}
	copy(__DIR__ . '/nginx.conf', $destinationFile);
	$conf = file_get_contents($destinationFile);
	
	$conf = str_replace(['|USER|', '|HOME|', '|DOMAIN|'], [$user, $homePath, $domain], $conf);
	file_put_contents($destinationFile, $conf);
}


install_dnsmasq();
install_phpfpm();
install_nginx();
