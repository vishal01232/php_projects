<?php


//1) scraper quotes from a website

$curl = curl_init();
$data = array();

$start_page = 1;
$end_page = 10; //upto 100 pages
$counter = 0;

//curl setings
//($curl, CURLOPT_URL, 'https://www.goodreads.com/quotes/tag/love?page=1');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0');

$tags = array('love', 'life', 'wisdom');

foreach ($tags as $tag) {
    for ($p = $start_page; $p <= $end_page; $p++) {
        $url = "https://www.goodreads.com/quotes/tag/$tag?page=$p";
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = curl_exec($curl);

        preg_match_all("!&ldquo;(.*?)&rdquo;.*?<span class=\"authorOrTitle\">(.*?)</span>!is", $result, $matches);

        $quotes = $matches[1];
        $authors = $matches[2];

        for ($q = 0; $q < count($quotes); $q++) {
            $data[$tag][$counter]['quote'] = $quotes[$q];
            $data[$tag][$counter]['author'] = rtrim(trim($authors[$q]), ',');
            $counter++;
        }
    }
    $counter = 0;
}


//2) insert quotes into database

print_r($data);

require_once 'db.php';

$mysqli = new mysqli($host, $user, $pass, $db) or die(mysqli_error($mysqli));

foreach ($data as $key => $tag) {
    for ($i = 0; $i < count($data[$key]); $i++) {
        $quote = $mysqli->real_escape_string($data[$key][$i]['quote']);
        $author = $mysqli->real_escape_string($data[$key][$i]['author']);
        $sql = "INSERT IGNORE INTO $table (quote,author,tag) VALUES ('$quote','$author','$key')";
        $mysqli->query($sql) or die($mysqli->error);
    }
}
