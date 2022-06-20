<?php

namespace MercadoPago\Serialization;

use MercadoPago\Net\MPResource;

/** Serializer class, responsible for objects serialization and deserialization. */
class Serializer
{
    /**
     * Method responsible for deserialize objects.
     */
    public static function deserializeFromJson($entity, $data): MPResource
    {
        return self::_deserializeFromJson($entity, $data);
    }

    private static function _deserializeFromJson($entity, $data)
    {
        $object = new $entity();
        if ($data) {
            foreach ($data as $key => $value) {
                if (!is_null($value) && is_array($value)) {
                    $className = $entity . self::_camelize($key);
                    if (class_exists($className, true)) {
                        $object->$key = self::_deserializeFromJson($className, $value);
                    }
                } else {
                    $object->{$key} = $value;
                }
            }
            return $object;
        }
    }

    private static function _camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }
}