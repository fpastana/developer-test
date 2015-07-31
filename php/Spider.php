<?php
require_once 'autoload.php';
class Spider {
    public function request($url, $http_verb = 'GET', $referer = '', $params = array()){
        $webpage = null;
        $ch = curl_init();
        if($http_verb = 'POST'){
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
        }elseif($http_verb = 'GET'){
            if(count($params) > 0) {
                $url .= '?';
            }
            foreach($params as $key => $value){
                $url .= $key . '=' . $value . '&';
            }
        }else{
            throw new Exception("This http verb $http_verb isn't valid!");
        }
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('Expect:'));
        curl_setopt($ch,CURLOPT_TIMEOUT, 120);
        curl_setopt($ch,CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch,CURLOPT_COOKIEJAR, dirname(__FILE__).'/cookie.txt');
        curl_setopt($ch,CURLOPT_COOKIEFILE, dirname(__FILE__).'/cookie.txt');
        curl_setopt($ch,CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36');
        curl_setopt($ch,CURLOPT_REFERER, $referer);
        $webpage = curl_exec($ch);
        curl_close($ch);
        return $webpage;
    }
} 