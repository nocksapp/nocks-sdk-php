<?php

namespace Nocks\SDK\Addon;

//this is a hex byte (changed from 00 to 38 to validate NLG, see base58.h:275 in the guldencoin source)
define("ADDRESSVERSION", dechex("38"));

/**
 * Class ValidateAddress
 * @package Nocks\SDK\Addon
 */
class ValidateAddress
{
    public function validate($currencyCode, $address)
    {
        if(strtoupper($currencyCode) == 'BTC')
        {
            return $this->validateBtc($address);
        }
        elseif(strtoupper($currencyCode) == 'NLG')
        {
            return $this->validateNlg($address);
        }

        return false;
    }

    private function validateNlg($address)
    {
        return GuldencoinAddressValidator::checkAddress($address);
    }

    private function validateBtc($address)
    {
        $origbase58 = $address;
        $dec = "0";

        for ($i = 0; $i < strlen($address); $i++)
        {
            $dec = bcadd(bcmul($dec,"58",0),strpos("123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz",substr($address,$i,1)),0);
        }

        $address = "";

        while (bccomp($dec,0) == 1)
        {
            $dv = bcdiv($dec,"16",0);
            $rem = (integer)bcmod($dec,"16");
            $dec = $dv;
            $address = $address.substr("0123456789ABCDEF",$rem,1);
        }

        $address = strrev($address);

        for ($i = 0; $i < strlen($origbase58) && substr($origbase58,$i,1) == "1"; $i++)
        {
            $address = "00".$address;
        }

        if (strlen($address)%2 != 0)
        {
            $address = "0".$address;
        }

        if (strlen($address) != 50)
        {
            return false;
        }

        if (hexdec(substr($address,0,2)) > 0)
        {
            return false;
        }

        return substr(strtoupper(hash("sha256",hash("sha256",pack("H*",substr($address,0,strlen($address)-8)),true))),0,8) == substr($address,strlen($address)-8);
    }
}

class GuldencoinAddressValidator
{
    protected function decodeHex($hex)
    {
        $hex=strtoupper($hex);
        $chars="0123456789ABCDEF";
        $return="0";
        for($i=0;$i<strlen($hex);$i++)
        {
            $current=(string)strpos($chars,$hex[$i]);
            $return=(string)bcmul($return,"16",0);
            $return=(string)bcadd($return,$current,0);
        }
        return $return;
    }

    protected static function encodeHex($dec)
    {
        $chars="0123456789ABCDEF";
        $return="";
        while (bccomp($dec,0)==1)
        {
            $dv=(string)bcdiv($dec,"16",0);
            $rem=(integer)bcmod($dec,"16");
            $dec=$dv;
            $return=$return.$chars[$rem];
        }
        return strrev($return);
    }

    protected static function decodeBase58($base58)
    {
        $origbase58=$base58;

        $chars="123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
        $return="0";
        for($i=0;$i<strlen($base58);$i++)
        {
            $current=(string)strpos($chars,$base58[$i]);
            $return=(string)bcmul($return,"58",0);
            $return=(string)bcadd($return,$current,0);
        }

        $return=self::encodeHex($return);

        //leading zeros
        for($i=0;$i<strlen($origbase58)&&$origbase58[$i]=="1";$i++)
        {
            $return="00".$return;
        }

        if(strlen($return)%2!=0)
        {
            $return="0".$return;
        }

        return $return;
    }

    protected function encodeBase58($hex)
    {
        if(strlen($hex)%2!=0)
        {
            die("encodeBase58: uneven number of hex characters");
        }
        $orighex=$hex;

        $chars="123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
        $hex=self::decodeHex($hex);
        $return="";
        while (bccomp($hex,0)==1)
        {
            $dv=(string)bcdiv($hex,"58",0);
            $rem=(integer)bcmod($hex,"58");
            $hex=$dv;
            $return=$return.$chars[$rem];
        }
        $return=strrev($return);

        //leading zeros
        for($i=0;$i<strlen($orighex)&&substr($orighex,$i,2)=="00";$i+=2)
        {
            $return="1".$return;
        }

        return $return;
    }

    protected function hash160ToAddress($hash160,$addressversion=ADDRESSVERSION)
    {
        $hash160=$addressversion.$hash160;
        $check=pack("H*" , $hash160);
        $check=hash("sha256",hash("sha256",$check,true));
        $check=substr($check,0,8);
        $hash160=strtoupper($hash160.$check);
        return self::encodeBase58($hash160);
    }

    protected function addressToHash160($addr)
    {
        $addr=self::decodeBase58($addr);
        $addr=substr($addr,2,strlen($addr)-10);
        return $addr;
    }

    public static function checkAddress($addr,$addressversion=ADDRESSVERSION)
    {
        if(!extension_loaded("bcmath"))
        {
            exit("This address validation script needs the bcmath extension.");
        }

        $addr=self::decodeBase58($addr);
        if(strlen($addr)!=50)
        {
            return false;
        }

        $version=substr($addr,0,2);
        if(hexdec($version)!= hexdec($addressversion)) //Changed from ">" to "!=" for LTC, and we keep it for guldencoin.
        {
            return false;
        }
        $check=substr($addr,0,strlen($addr)-8);
        $check=pack("H*" , $check);
        $check=strtoupper(hash("sha256",hash("sha256",$check,true)));
        $check=substr($check,0,8);
        return $check==substr($addr,strlen($addr)-8);
    }

    protected function hash160($data)
    {
        $data=pack("H*" , $data);
        return strtoupper(hash("ripemd160",hash("sha256",$data,true)));
    }

    protected function pubKeyToAddress($pubkey)
    {
        return self::hash160ToAddress(self::hash160($pubkey));
    }

    protected function remove0x($string)
    {
        if(substr($string,0,2)=="0x"||substr($string,0,2)=="0X")
        {
            $string=substr($string,2);
        }
        return $string;
    }
}