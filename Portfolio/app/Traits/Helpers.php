<?php

namespace App\Traits;

trait Helpers {
    public static function message($string)
    {   try {
        $json = json_decode(file_get_contents(public_path() . '/message.json'));
        return $json->{$string};
        }
        catch (\Exception $e) {
            return $string;
        }
    }

    public function syncRelationship($object, $sync, array $list)
    {
        $object->$sync()->sync($list);
    }
}
