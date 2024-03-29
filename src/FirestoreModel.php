<?php

namespace Vitafeu\EasyMVC\Firebase;

use Vitafeu\EasyMVC\Firebase\Firebase;

class FirestoreModel
{
    private static $db = null;

    public static function init() {
        if (self::$db === null) {
            self::$db = Firebase::getInstance()->createFirestore()->database();
        }
    }

    public static function read() {
        self::init();
        
        $calledClass = get_called_class();

        $ref = self::$db->collection($calledClass::$collection);
        $docs = $ref->documents();
        $data = [];

        foreach ($docs as $doc) {
            $data[] = array_merge($doc->data(), ['id' => $doc->id()]);
        }

        return $data;
    }
}