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

    public static function read($uid = null) {
        self::init();
        
        $calledClass = get_called_class();

        $ref = self::$db->collection($calledClass::$collection);

        if ($uid) {
            $doc = $ref->document($uid);
            $snapshot = $doc->snapshot();

            return array_merge($snapshot->data(), ['id' => $snapshot->id()]);
        }
        
        $docs = $ref->documents();

        $data = [];

        foreach ($docs as $doc) {
            $data[] = array_merge($doc->data(), ['id' => $doc->id()]);
        }

        return $data;
    }

    public static function create($data, $uid = null) {
        self::init();
        
        $calledClass = get_called_class();

        $ref = self::$db->collection($calledClass::$collection);

        if ($uid) {
            $ref->document($uid)->set($data);
        } else {
            $ref->add($data);
        }
    }

    public static function update($id, $data) {
        self::init();
        
        $calledClass = get_called_class();

        $ref = self::$db->collection($calledClass::$collection);
        $ref->document($id)->set($data);
    }

    public static function delete($id) {
        self::init();
        
        $calledClass = get_called_class();

        $ref = self::$db->collection($calledClass::$collection);
        $ref->document($id)->delete();
    }
}