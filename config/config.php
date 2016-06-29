<?php

ini_set("display_errors",1);

define("DSN", "mysql:dbhost=localhost;dbname=dotinstall_sns_php");
define("DB_USERNAME", "dbuser");
define("DB_PASSWORD", "mu4uJsif");
//define("DB_PASSWORD", "4AEBD76103C186D452FC2708123FD0975C536116");
define("SITE_URL", "http://".$_SERVER["HTTP_HOST"]);

require_once(__DIR__ . "/../lib/functions.php");
require_once(__DIR__ . "/autoload.php");

session_start();

