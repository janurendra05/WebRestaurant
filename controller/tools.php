<?php
class Tools{
    public function uploadToImgur($img){
        // Upload Photo to imgur api
        $filename = $img['tmp_name'];
        $client_id = "a199127d5918115"; //Your Client ID here
        $handle = fopen($filename, "r");
        $data = fread($handle, filesize($filename));
        $pvars   = array('image' => base64_encode($data));
        $timeout = 30;
        $curl    = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl, CURLOPT_POST, 1);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
        $out = curl_exec($curl);
        curl_close($curl);
        $pms = json_decode($out, true);
        $url = $pms['data']['link'];
        if ($url != "") {
            // $user->editBackgroundPhoto($url);
            $url_foto = $url;
            // echo $url;
            // echo "<img src='$url_foto' alt=''>";
        } else {
            $url_foto = '';
            echo "<h2>There's a Problem</h2>";
            echo $pms['data']['error']['message'];
        }
        return $url_foto;
    }
}

?>