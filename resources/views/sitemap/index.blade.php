<?php
  header('Content-type: application/xml; charset="ISO-8859-1"',true);  
  $datetime1 = new DateTime(date('Y-m-d H:i:s'));
?>
 
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{ URL::to('/') }}</loc>
    <lastmod>{{ $datetime1->format(DATE_ATOM) }}</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.1</priority>
  </url>
  <url>
    <loc>{{ URL::to('faq') }}</loc>
    <lastmod>{{ $datetime1->format(DATE_ATOM) }}</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.80</priority>
  </url>
  <url>
    <loc>{{ URL::to('login') }}</loc>
    <lastmod>{{ $datetime1->format(DATE_ATOM) }}</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.80</priority>
  </url>
  <url>
    <loc>{{ URL::to('register') }}</loc>
    <lastmod>{{ $datetime1->format(DATE_ATOM) }}</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.80</priority>
  </url>
</urlset>