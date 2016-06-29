<?php

namespace MyApp\Controller;

class Login extends \MyApp\Controller {

    public function run() {
        //ログインしていない時はログイン画面に飛ばす
        if ($this->isLoggedIn()) {
            header("Location: ". SITE_URL);
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->postProcess();
        }
    }

    protected function postProcess() {
        // validate
        try {
            $this->_validate();

        } catch (\MyApp\Exception\EmptyPost $e) {
            $this->setErrors("login",$e->getMessage());
        }
        $this->setValues("email", $_POST["email"]);

        if ($this->hasError()) {
            return;
        } else {
            try{
                $userModel = new \MyApp\Model\User();
                $values = array(
                        "email" => $_POST["email"],
                        "password" => $_POST["password"]
                );

                $user = $userModel->login($values);

            } catch (\MyApp\Exception\UnmatchEmailOrPassword $e) {
                $this->setErrors("login", $e->getMessage());
                return;
            }

            session_regenerate_id(true);
            $_SESSION["me"] = $user;

            header("location: ". SITE_URL);
            exit;
        }

    }
    private function _validate() {
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            echo "Invalid Token!";
            exit;
        }
        if (!isset($_POST["email"]) || !isset($_POST["password"])) {
            echo "Invalid Form!";
            exit;
        }

        if($_POST['email'] === '' || $_POST['password'] === '') {
            throw new \MyApp\Exception\EmptyPost();
        }
    }
}
