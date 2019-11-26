<?php if(!defined('_lib')) die("Error");



$cautruyvan = strtolower($_SERVER['QUERY_STRING']);

$tukhoa_truyvan = array('union','chr(', 'chr=', 'chr%20', '%20chr', 'wget%20', '%20wget', 'wget(',
'cmd=', '%20cmd', 'cmd%20', 'rush=', '%20rush', 'rush%20',
'union%20', '%20union', 'union(', 'union=', 'echr(', '%20echr', 'echr%20', 'echr=',
'esystem(', 'esystem%20', 'cp%20', '%20cp', 'cp(', 'mdir%20', '%20mdir', 'mdir(',
'mcd%20', 'mrd%20', 'rm%20', '%20mcd', '%20mrd', '%20rm',
'mcd(', 'mrd(', 'rm(', 'mcd=', 'mrd=', 'mv%20', 'rmdir%20', 'mv(', 'rmdir(',
'chmod(', 'chmod%20', '%20chmod', 'chmod(', 'chmod=', 'chown%20', 'chgrp%20', 'chown(', 'chgrp(',
'locate%20', 'grep%20', 'locate(', 'grep(', 'diff%20', 'kill%20', 'kill(', 'killall',
'passwd%20', '%20passwd', 'passwd(', 'telnet%20', 'vi(', 'vi%20',
'insert%20into', 'select%20', 'nigga(', '%20nigga', 'nigga%20', 'fopen', 'fwrite', '%20like', 'like%20',
'$_request', '$_get', '$request', '$get', '.system', '&aim', '%20getenv', 'getenv%20',
'new_password', '&icq','/etc/password','/etc/shadow', '/etc/groups', '/etc/gshadow',
'/bin/ps', 'wget%20', 'uname\x20-a', '/usr/bin/id','/bin/echo', '/bin/kill', '/bin/', '/chgrp', '/chown', '/usr/bin', 'g\+\+', 'bin/python',
'bin/tclsh', 'bin/nasm', 'perl%20', 'traceroute%20', 'ping%20', '.pl', '/usr/X11R6/bin/xterm', 'lsof%20',
'/bin/mail', '.conf', 'motd%20', '_config.php', 'cgi-', '.eml',
'file\://', 'window.open', '<script>', 'javascript\://','img src', 'img%20src','.jsp','ftp.exe',
'xp_enumdsn', 'xp_availablemedia', 'xp_filelist', 'xp_cmdshell', 'nc.exe', '.htpasswd',
'servlet', '/etc/passwd', '[Only registered and activated users can see links]', '~root', '~ftp', '.js', '.jsp','.history',
'bash_history', '.bash_history', '~nobody', 'server-info', 'server-status', 'reboot%20', 'halt%20',
'powerdown%20', '/home/ftp', '/home/www', 'secure_site, ok', 'chunked', 'org.apache', '/servlet/con',
'<script', '/robot.txt' ,'/perl' ,'mod_gzip_status', 'db_mysql.inc', '.inc', 'select%20from',
'select from', 'drop%20', '.system', 'getenv', '_php', 'php_', 'phpinfo()', '<?php', '?>', 'sql=');
$kiemtra = str_replace($tukhoa_truyvan, '*', $cautruyvan);
if ($cautruyvan != $kiemtra){
die( "You are hacker?<br/>
Why you hack our Websites???<br/>
We will report with PC50......thank to read!
</b><br />".$_SERVER['REMOTE_ADDR']." <br> -- Admin --" );
}

error_reporting(0);

$config_url=$_SERVER["SERVER_NAME"].'';	

$_SESSION['ck']=$config_url;
$config['database']['servername'] = 'localhost';
$config['database']['username'] = 'datkeyssol_db';
$config['database']['password'] = 'yQNx4F884c';
$config['database']['database'] = 'datkeyssol_db';
$config['database']['refix'] = 'table_';

$salt_pw = "!@#";
$config['login']['attempt'] = 5;
$config['login']['delay'] = 20;

$meta_robots = 'INDEX, FOLLOW';
// file config.php
$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
$site_key    = '6LcNGMEUAAAAAAAVrUeyGOVrxHYUzpp4FEb6MGIv';
$secret_key  = '6LcNGMEUAAAAAJH1JE_UUhFWDTduWxrLQyK5kobI';

$ip_host = '210.211.108.81';
$mail_host = 'admin@datkeyssolar.com';
$pass_mail = 'ppDLmMbzt';

$config['arrayDomainSSL']=array("yourdomainssl.com.vn");

$config['lang']=array(''=>'Tiếng Việt','en'=>'Tiếng Anh');#Danh sách ngôn ngữ hỗ trợ

$config['author']['name'] = 'MẠCH VĂN HOÀNG';
$config['author']['email'] = 'hoangmach.nina@gmail.com';
$config['author']['timefinish'] = '2018';
date_default_timezone_set('Asia/Ho_Chi_Minh');
	

?>