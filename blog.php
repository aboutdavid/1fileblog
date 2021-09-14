<?php 
// This is the config you need to edit
$config = new stdClass;
$config->name = "1fileblog"; // what you want yout blog to be named
$config->description = "This is a example blog in 1 file!"; // describe your blog in a few words
$config->postdir = "./posts"; // folder where your markdown files are stored
$config->css = "/style.css";  // path to custom css file, leave blank to disable
$config->rewrite = true; // only if you can use .htaccess files on your servers, makes the url pretty
$config->markdown = "./markdown.sh"; // path to markdown.sh file, leave blank to disable, get from git.io/JGs8I
$config->cachetime = 900;  // cache time in seconds (how long the server and browser will cache the blog files), leave blank to disable
$config->timezone = "America/New_York"; // Your timezone (can be found at php.net/manual/en/timezones.php)


// Timezone
date_default_timezone_set($config->timezone);
  
// browser cache
header("Cache-Control: max-age=$config->cachetime");

$filecachepath = "./cache/" . md5($_SERVER['REQUEST_URI']). ".html";
if (file_exists($filecachepath)){
$cached=time()-filemtime($filecachepath);
$cached_date = date("l\, F jS\, Y \@ h:i:s A",filemtime($filecachepath));
  if ($cached < $config->cachetime){
    echo "<!-- Serving file from cache. Cached on $cached_date ($config->timezone) -->";
    die(file_get_contents($filecachepath));
  };
};
ob_start();

function metatags($config){
  // meta tags
  echo "<meta charset=\"utf-8\"><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"><meta name=\"viewport\" content=\"width=device-width,initial-scale=1\"><meta name=\"title\" content=\"$config->name\"><meta name=\"description\" content=\"$config->description\"><meta property=\"og:type\" content=\"website\"><meta property=\"og:url\" content=\"$url\"><meta property=\"og:title\" content=\"$config->name\"><meta property=\"og:description\" content=\"$config->description\"><meta property=\"og:image\" content=\"\"><meta property=\"twitter:card\" content=\"summary_large_image\"><meta property=\"twitter:url\" content=\"$url\"><meta property=\"twitter:title\" content=\"$config->name\"><meta property=\"twitter:description\" content=\"$config->description\"><meta property=\"twitter:image\" content=\"\">";
};
function savecache($filecachepath){
  $cachefile = fopen($filecachepath, "w");
  fwrite($cachefile, ob_get_contents());
  fclose($cachefile);
  ob_end_flush();
};
function footer($config){
  $year = date("Y");
  echo "<small>&copy; $year $config->author_name | Powered by <a href=\"https://github.com/aboutdavid/1fileblog\">1fileblog</a></small>";
}
function readtime($text){
  // 225 is the average words per min an average human can read.
  // Based on https://aboutdavid.me/post/2020-10-8-calculating-read-time-in-javascript/
  return round(str_word_count($text)/225);
};
// url (for meta tags)
$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!empty($config->css)){
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$config->css\"/>";
};

metatags($config);
// see if the client is requesting a post
if (!empty($_GET['post'])){
  // user has requested a post
$filepath = $config->postdir . "/" . $_GET['post'] . ".md";
  // see if that file existed
  if (file_exists($filepath)){
    // if markdown can be used, use it
    if (!empty($config->markdown)){
      echo "<a href=\"/\">&larr; Back to $config->name</a>";
      echo system("bash " . $config->markdown ." ". $filepath);
    } else {
      // if no markdown, use regular html/plaintext
      echo $metadata[1];
    }
    // request footer and save cache
  footer($config);
    savecache($filecachepath);
    die;
  } else {
    // Say the post was not found, send a 404 response, send footer, 
    http_response_code(404);
    echo "Post not found :/";
footer($config);
    savecache($filecachepath);
    die();
  }
}

?>

<h1 class="site-sitle">
  <?php echo $config->name; ?>
</h1>
<p class="site-description">
  <?php echo $config->description; ?>
</p>
<h3 class="site-archive">
  Post Archive
</h3>
<ul class="site-postlist">
  

<?php
$postfiles = preg_grep('/^([^.])/', scandir($config->postdir));

foreach ($postfiles as $value) {
$postdir = $config->postdir;
$title = rtrim(strtok(file_get_contents("./$postdir/$value"), "\n"));
$cleanedtitle = preg_replace('/#/', "", $title, 1);
$slug = substr($value, 0, strpos($value, "."));
$path = $config->postdir . "/" . substr($value, 0, strpos($value, "."));
$date = date("F jS\, Y ",filemtime("./$postdir/$value"));
$readtime = readtime(file_get_contents("./$postdir/$value"));
  if ($config->rewrite){
    echo "<li><a href=\"/post/$slug\" class=\"post-item\">$cleanedtitle</a>
    <br>$date
    <br>🍿 $readtime min read
    </li><br>";
  } else {
    echo "<li><a href=\"/?post=$slug\" class=\"post-item\">$cleanedtitle</a>
    <br>$date
    <br>🍿 $readtime min read
    </li><br>";
  };

};
echo "</ul>";
footer($config);
savecache($filecachepath);
?>
  
