<?php

namespace Vitafeu\EasyMVC\Firebase;

use Kreait\Firebase\Factory;
use Vitafeu\EasyMVC\Globals;

class Firebase {
    public static function getInstance() {
        $factory = (new Factory)->withServiceAccount(Globals::getProjectRoot() . 'firebase-adminsdk.json');
        return $factory;
    }
}