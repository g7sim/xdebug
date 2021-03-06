--TEST--
Test for Xdebug's remote log (can not connect, with not-found remote callback)
--SKIPIF--
<?php
require __DIR__ . '/../utils.inc';
check_reqs('dbgp; !win');
?>
--INI--
xdebug.mode=debug
xdebug.start_with_request=yes
xdebug.remote_log=/tmp/{RUNID}remote-log2.txt
xdebug.remote_connect_back=1
xdebug.remote_host=doesnotexist2
xdebug.remote_port=9003
--FILE--
<?php
echo strlen("foo"), "\n";
echo file_get_contents(sys_get_temp_dir() . '/' . getenv('UNIQ_RUN_ID') . 'remote-log2.txt' );
unlink (sys_get_temp_dir() . '/' . getenv('UNIQ_RUN_ID') . 'remote-log2.txt' );
?>
--EXPECTF--
3
[%d] Log opened at %d-%d-%d %d:%d:%d
[%d] I: Checking remote connect back address.
[%d] I: Checking header 'HTTP_X_FORWARDED_FOR'.
[%d] I: Checking header 'REMOTE_ADDR'.
[%d] W: Remote address not found, connecting to configured address/port: doesnotexist2:9003. :-|
[%d] W: Creating socket for 'doesnotexist2:9003', getaddrinfo: %s.
[%d] E: Could not connect to client. :-(
[%d] Log closed at %d-%d-%d %d:%d:%d

[%d] Log opened at %d-%d-%d %d:%d:%d
[%d] I: Checking remote connect back address.
[%d] I: Checking header 'HTTP_X_FORWARDED_FOR'.
[%d] I: Checking header 'REMOTE_ADDR'.
[%d] W: Remote address not found, connecting to configured address/port: doesnotexist2:9003. :-|
[%d] W: Creating socket for 'doesnotexist2:9003', getaddrinfo: %s.
[%d] E: Could not connect to client. :-(
[%d] Log closed at %d-%d-%d %d:%d:%d
