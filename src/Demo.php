<?php

namespace App;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class Demo {
    public function __construct(private validatorInterface $validator ,private string $key) {
    }
}