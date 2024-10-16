<?php

namespace App\Helper;

class ArrayUtils
{
    public static array $REDACTED_KEYS = [
        'password',
        'password_hash',
        'passwordhash',
        'password_hashed',
        'passwordhashed',
        'password_salt',
        'passwordsalt',
        'password_confirmation',
        'passwordconfirmation',
        'token',
        'secret',
    ];

    public static function filterRedactedKeys(array $data, array $redactedKeys = []): array
    {
        $result = [];
        $redactedKeys = array_merge(self::$REDACTED_KEYS, $redactedKeys);

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $result[$key] = self::filterRedactedKeys($value, $redactedKeys);
                continue;
            }

            if (in_array(strtolower($key), $redactedKeys)) {
                $result[$key] = '**REDACTED**';
                continue;
            }

            $result[$key] = $value;
        }

        return $result;
    }

}
