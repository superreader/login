<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller {

    public function run() {
        //ログインしていない時はログイン画面に飛ばす
        if (!$this->isLoggedIn()) {
            //login
            //echo "indexです";
            header("Location: ". SITE_URL . "/login.php");
            exit;
        }
        // get user info
        
   }
}
