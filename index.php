<?php

define('FACEBOOK_PAGE_ID', 'tu wpisz ID strony');
define('FACEBOOK_ACCESS_TOKEN', 'tu wpisz access token');

$post_url = 'https://graph.facebook.com/'.FACEBOOK_PAGE_ID.'?fields=access_token&access_token='.FACEBOOK_ACCESS_TOKEN;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $post_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$results = json_decode(curl_exec($ch), true);
curl_close($ch);
$access_token = $results['access_token'];

if($access_token){
  $data['link'] = 'Link do strony';
  $data['message'] = 'Treść wiadomości';
  $data['caption'] = 'Nagłówek wpisu';
  $data['access_token'] = $access_token;

  $post_url = 'https://graph.facebook.com/'.FACEBOOK_PAGE_ID.'/feed';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $post_url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $return = curl_exec($ch);
  curl_close($ch);
  print_r($return); // linia opcjonalna, jeśli chcemy wyświetlić wynik na ekranie
}
