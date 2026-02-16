<?php

namespace App\Utils\Auth;
class JwtService
{

    private static $key = "ygE1zo0GTZDa7JGtzstqmF2LxivGcgho3CzLSPY0GHI";

    public static function decode(string $token)
    {
        if (preg_match("/^(?<header>.+)\.(?<payload>.+)\.(?<signature>.+)$/", $token, $matches) !== 1) {
            throw new InvalidArgumentException("invalid token format");
        }

        $signature = hash_hmac(
            "sha256",
            $matches["header"] . "." . $matches["payload"],
            static::$key,
            true
        );

        $signature_from_token = static::base64URLDecode($matches["signature"]);

        if (!hash_equals($signature, $signature_from_token)) {

            // throw new Exception("signature doesn't match");
        }

        $payload = json_decode(static::base64URLDecode($matches["payload"]), true);

        return $payload;
    }

    private static function base64URLEncode(string $text)
    {

        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($text));
    }


    private static function base64URLDecode(string $text)
    {

        return base64_decode(
            str_replace(
                ["-", "_"],
                ["+", "/"],
                $text
            )
        );
    }

}