<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalVar extends Controller
{
    public function cammpusDescription($value)
    {
        switch ($value) {
            case 'mc':
                return 'Main Campus';
                break;
            case 'mmc':
                return 'Maasin City Campus';
                break;
            case 'bc':
                return 'Bontoc Campus';
                break;
            case 'toc':
                return 'Tommas Oppus Campus';
                break;
            case 'sjc':
                return 'San Juan Campus';
                break;
            case 'hc':
                return 'Hinunangan Campus';
                break;
            default:
                return 'No Campus';
                break;
        }
    }

    public function allcampus(){
        $campus= [
            ['mc','Main Campus'],
            ['bc','Bontoc Campus'],
            ['toc','Tomas Oppus Campus'],
            ['mcc','Maasin City Campus'],
            ['sjc','San Juan Campus'],
            ['hc','Hinunangan Campus'],
        ];

        return $campus;
    }
    public function itemName(){
        $campus= [
           'President',
           'Vice President',
           'Director',
           'Dean',
           'Department Head',
           'Instructor',
           'Clerk'
        ];

        return $campus;
    }
    public function status(){
        $campus= [
           'Job Order',
           'Permanent-Staff',
           'Permanent-Faculty',
        ];

        return $campus;
    }

    public function encrypt($string_data){
        $ciphering = "BF-CBC";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = random_bytes($iv_length);
        $encryption_key = openssl_digest(php_uname(), 'MD5', true);
        $encryption = openssl_encrypt($string_data, $ciphering, $encryption_key, $options, $encryption_iv);
        return  $encryption;

    }
    public function decrypt($string_data){
        $ciphering = "BF-CBC";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $decryption_iv = random_bytes($iv_length);
        $decryption_key = openssl_digest(php_uname(), 'MD5', true);
        $decryption = openssl_decrypt($string_data, $ciphering, $decryption_key, $options, $decryption_iv);
       return $decryption;
        
    }
}
