<?php
ob_start("ob_gzhandler");
@session_start();
$APP_PATH=dirname(__FILE__);
require_once $APP_PATH.'/lib/App.php';
$app=new App();
?>
