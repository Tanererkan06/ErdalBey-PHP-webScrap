<?php

require_once './simplehtmldom/simple_html_dom.php';

$pages = 50;
$url = $_SERVER['PHP_SELF'];
$currentPage = (int)($_GET['page'] ?? 1);

$firstLink = createPageLink($url, 1, '<<');
$lastLink = createPageLink($url, $pages, '>>');

$firstPage = 1;
$prevLink = createPageLink($url, max(1, $currentPage - 1), '<');
$nextLink = createPageLink($url, min($pages, $currentPage + 1), '>');

echo $firstLink;
echo $prevLink;

for ($page = $firstPage; $page <= $pages; ++$page) {
    if ($page === $currentPage) {
        printf('%d ', $page);
    } else {
        echo createPageLink($url, $page);
    }
}

echo $nextLink;
echo $lastLink;

function createPageLink($url, $pageNum, $text = null)
{
    if ($text === null) {
        $text = $pageNum;
    }

    return sprintf('<a href="%s?page=%d">%s</a> ', $url, $pageNum, htmlspecialchars($text));
}

exit;
//$url = 'https://www.etsy.com/de/shop/GeorgiaGemDesign?ref=simple-shop-header-name&listing_id=626032227&ga_search_query=kammererite';
//$url = 'https://www.etsy.com/de/c/weddings/accessories?ref=catcard-11014-550758578&explicit=1';
//$url = 'https://www.etsy.com/de/c/weddings/accessories?ref=pagination&explicit=1&page=%d';
//$url = 'https://www.etsy.com/de/search?q=kammererite&ref=pagination&as_prefix=kammererite&page=%d';
$url = 'https://www.etsy.com/de/shop/GeorgiaGemDesign?ref=simple-shop-header-name&listing_id=658988844&ga_search_query=kammererite&page=%d#items';
$currentUrl = sprintf($url, $currentPage);
var_dump($currentUrl);
$html_source = file_get_html($currentUrl);

echo '<br>';
echo $icerik = $html_source->find('h1',0)->plaintext;
echo '<br>';

echo '<br>';
echo $icerika = $html_source->find('span',0)->plaintext;
echo '<br>';
echo '<br>';
echo $icerika = $html_source->find('title',0)->plaintext;
echo '<br/>';
echo '<br/>';

$list = $html_source->find('li[data-palette-listing-id]');

if (count($list) === 0) {
    $list = $html_source->find('div[data-palette-listing-id]');
}

$count = count($list);
var_dump($count);

for ($i = 0; $i < $count; $i++) {
    $element = $list[$i];

    var_dump($element->attr['data-listing-id']);
    var_dump($element->find('h2[class*=text-body]')[0]->plaintext);
    var_dump($element->find('span[class*=currency-value]')[0]->plaintext);
    var_dump($element->find('span[class*=currency-symbol]')[0]->plaintext);

    foreach ($element->find('img') as $img) {
        if (!empty($img->attr['src'])) {
            var_dump($img->attr['src']);
        }

        if (isset($img->attr['data-srcset'])) {
            var_dump($img->attr['data-srcset']);
        }
    }
}

//echo '----------------------file_get_contents ve preg_match_all ile deneme-----------------------------------------------';



//$kaynak = file_get_contents('https://www.etsy.com/shop/GeorgiaGemDesign?ref=simple-shop-header-name&listing_id=658990008');
//preg_match_all('@div class="featured-listings bb-xs-1 pb-xs-2"  data-featured-products-area="">(.?*)</div>@si',$sonuc);
//print_r($sonuc[1]);






?>