<?php
   
    function encrypt($text) {

        $hasil="";
        $p=47;
        $q=71;
        $n=gmp_mul($p,$q);
        $totient = gmp_mul(gmp_sub($p,1),gmp_sub($q,1));

        for($e=2;$e<100;$e++){  //mencoba perulangan max 100 kali, 
            $gcd = gmp_gcd($e, $totient);
            if(gmp_strval($gcd)=='1')
            break;
        }

        for($i=0;$i<strlen($text);++$i){
            $hasil.=gmp_strval(gmp_mod(gmp_pow(ord($text[$i]),$e),$n));
            if ($i!=strlen($text)-1) {
                $hasil.=".";
            }
        }

        return $hasil;
    }

    function decrypt($text) {
        $hasil="";
        $p=47;
        $q=71;
        $n=gmp_mul($p,$q);
        $totient = gmp_mul(gmp_sub($p,1),gmp_sub($q,1));

        for($e=2;$e<100;$e++){  //mencoba perulangan max 100 kali, 
            $gcd = gmp_gcd($e, $totient);
            if(gmp_strval($gcd)=='1')
            break;
        }

        $i=1;
        do{
            $res = gmp_div_qr(gmp_add(gmp_mul($totient,$i),1), $e);
            $i++;
            if($i==10000) //maksimal percobaan 10000
            break;
        }while(gmp_strval($res[1])!='0');
        $d=gmp_strval($res[0]);

        $raw=explode(".",$text);
        foreach($raw as $nilai){
            //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            $hasil.=chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n)));
        }

        return $hasil;
    }

?>