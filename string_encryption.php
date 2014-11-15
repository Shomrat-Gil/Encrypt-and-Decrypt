<?php 

class string_encryption{
   
   
    private static $key = "";
   
    /**
    * Encryption string
    *
    * @param mixed $string
    */
    public static function encrypt($string=null){
        if(strlen($string)==0){return '';}
        $arr_key    = string_encryption::key_data(); 
        $result     = "";
        $arr_string = str_split($string);
        foreach($arr_string as $i=>$str_string){
             $char      = $str_string;
             $keychar   = substr($arr_key['key'], ($i % $arr_key['size']) - 1, 1);
             $char      = chr(ord($char) + ord($keychar));
             $result    .= $char;
        } 
        return base64_encode($result);
    }
   
    /**
    * Decryption string
    *
    * @param mixed $string
    * @return mixed
    */
    public static function decrypt($string=null){
        if(strlen($string)==0){return '';}
        $arr_key    = string_encryption::key_data();
        $result     = "";
        $string     = base64_decode($string);
        $arr_string = str_split($string);
        foreach($arr_string as $i=>$str_string){
             $char      = $str_string;
             $keychar   = substr($arr_key['key'], ($i % $arr_key['size']) - 1, 1);
             $char      = chr(ord($char) - ord($keychar));
             $result    .=$char;
        }            
        return $result;
    }
   
    private function key_data(){
        $key =  string_encryption::$key; 
        return array(
          "key"=> $key
          ,"size"=> strlen($key)
        );
    }
   
// END CLASS
}
$string = 'test123';
$string_encrypt = string_encryption::encrypt($string);
$string_decrypt = string_encryption::decrypt($string_encrypt);
echo 'string: ' . $string . "
";
echo 'Encryption string: '. $string_encrypt . "
";
echo 'Decryption string: '. $string_decrypt . "
";
?>


?>