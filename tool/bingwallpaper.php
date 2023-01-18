<?php
    $n = $_SERVER["QUERY_STRING"];
    $str = file_get_contents('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=8');
    $data = json_decode($str);
    $imghost = 'https://cn.bing.com';
    if ($n == NULL) {
      $imgpath = $data -> {'images'}[0] -> {'url'};
    } else {
      $imgpath = $data -> {'images'}[$n] -> {'url'};
    }
    if ($imgpath) {
      $imgurl = $imghost . $imgpath;
        $img = imagecreatefromjpeg($imgurl);
        header('Expires: ' . gmdate('D, d M Y H:i:s', strtotime(date('Y-m-d', strtotime('+1 day')))) . ' GMT');
        header('Cache-Control: public, max-age=3600');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', strtotime(date('Y-m-d'))) . ' GMT');
        header('Content-Type: image/jpeg');
        imageinterlace($img, 1);
        imagejpeg($img);
        imagedestroy($img);
    } else {
        exit('error');
    }
?>