<?php

namespace MyApp\Controller;

class Signup extends \MyApp\Controller {

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

        } catch (\MyApp\Exception\InvalidEmail $e) {
            $this->setErrors("email",$e->getMessage());

        } catch (\MyApp\Exception\InvalidPassword $e) {
            $this->setErrors("password",$e->getMessage());
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

                $userModel->create($values);

            } catch (\MyApp\Exception\DuplicateEmail $e) {
                $this->setErrors("email", $e->getMessage());
                return;
            }

            header("location: ". SITE_URL."/login.php");
        }

    }
    private function _validate() {
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            echo "Invalid Token!";
            exit;
        }
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            throw new \MyApp\Exception\InvalidEmail();
        }

        if(!preg_match("/\A[a-zA-Z0-9]+\z/", $_POST["password"])) {
            throw new \MyApp\Exception\InvalidPassword();
        }
    }
}
