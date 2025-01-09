<?php
    ob_start();
    
    $dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "bank";

	//Connect to the MySQL using mysqli function
	$conn =  mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
    header("Content-type: text/xml");
    echo '<?xml version="1.0" encoding="UTF-8" ?>
    <urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">';
	
     $sql = "SELECT DISTINCT bname FROM banks LIMIT 0,50000";
     $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    { 
        
        $sitemap_url = ("https://localhost/".str_replace(' ', '-',strtolower($row['bname']))."/");
        
        
        $sitemap_url1 = preg_replace ('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $sitemap_url);
        
        $html = htmlspecialchars($sitemap_url1);
        echo '
        <url>
            <loc>'. $html .'</loc>
            <changefreq>monthly</changefreq>
            <lastmod>2019-07-02</lastmod>
        </url>';
    }

    echo '</urlset>';
    
    ob_flush();
 ?>