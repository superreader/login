<?php

namespace MyApp\Exception;

class UnmatchEmailOrPassword extends \Exception {
    protected $message = "IDかパスワードが一致いたしません";

}
