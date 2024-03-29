<?php

namespace Vitafeu\EasyMVC\Firebase;

use Kreait\Firebase\Factory;

class Firebase {
    public static function getInstance() {
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/../firebase-adminsdk.json');
        return $factory;
    }
}