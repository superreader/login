<?php

namespace MyApp\Exception;

class EmptyPost extends \Exception {
    protected $message = "IDとパスワードを入力してください";

}
