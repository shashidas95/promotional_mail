<?php

namespace App\Traits;

trait Verifiable
{
public function generateVerificationCode($email)
{
return md5($email . microtime());
}
}
