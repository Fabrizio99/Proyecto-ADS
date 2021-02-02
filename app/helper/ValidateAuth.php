<?php
namespace App\helper;

use Firebase\JWT\JWT;
use Exception;

class ValidateAuth
{
    private static $secret_key = "MY_SECRET_KEY";
    private static $encrypt = ['HS256'];
    private static $aud = null;

    public static function SignIn($data)
    {
        $time = time();

        $token = array(
            'exp' => $time + (60*60),
            'aud' => self::Aud(),
            'data' => $data
        );

        return JWT::encode($token, self::$secret_key);
    }

    public static function Check($token)
    {
        $time = time();

        if(empty($token))
        {
            $object = (object) [
                'status' => $_SESSION["STATUS_CONTROL"],
                'msj'    => "Acceso denegado por falta de token."
            ];   
            $error = json_encode($object);   

            throw new Exception($error);
        }

        $decode = JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        );

        if($decode->aud !== self::Aud())
        {
            $object = (object) [
                'status' => $_SESSION["STATUS_CONTROL"],
                'msj'    => "Usuario invalido al iniciar session."
            ];   
            $error = json_encode($object);   

            throw new Exception($error);
        }
    }

    public static function GetData($token)
    {
        return JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data;
    }

    private static function Aud()
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}