<?php
  // Language
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["lang"])) {
      switch($_GET["lang"]) {
        case "es": require("strings/spanish.php"); break;
        case "it": require("strings/italian.php"); break;
        case "pt": require("strings/portuguese.php"); break;
        case "fr": require("strings/french.php"); break;
        case "de": require("strings/german.php"); break;
        case "nl": require("strings/dutch.php"); break;
        default: require("strings/english.php"); break;
      }
    }
    else {
      require("strings/english.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="<?php e($code) ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php e($sitename) ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i">
    <link rel="stylesheet" href="/css/main.css">
  </head>
  <body>
    <div>
      <nav class="navbar navbar-expand-md navigation-clean">
        <div class="container">
          <a class="navbar-brand" href="<?php if ($code !== "en"){e("/".$code);} else{echo "/";} ?>"><?php e($sitename) ?></a>
        </div>
      </nav>
    </div>
    <section class="video_download text-white">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-1">
            <div class="text-center p-5">
              <h2><?php e($video_facenook) ?></h2>
              <div id="video_image">
              </div>
            </div>
          </div>
          <div class="col-lg-6 order-lg-2">
            <div class="mx-auto p-5">
              <p class="text-center" id="video_title"></p>
              <div class="mx-auto" id="video_options">
                <p class="text-left"><?php e($options) ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h2 class="text-center p-5"><?php e($more_facebook) ?></h2>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form action="<?php if ($code !== "en"){e("/".$code);} ?>/facebook" method="get">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <div class="input-group">
                    <input class="form-control form-control" type="text" id="URL" placeholder="https://www.facebook.com/321960231808748/videos/1987908671310955" name="URL">
                  </div>
                </div>
                <div class="col-12 col-md-3">
                  <button class="btn btn-success btn-block" type="submit"><?php e($download) ?></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <footer class="py-5">
      <div class="container">
        <p class="text-center text-muted m-0 small">© <?php e($sitename) ?> 2019. <?php e($copyright) ?>.</p>
      </div>
    </footer>
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/cc91b92ca8.js"></script>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["URL"]) && strpos($_GET["URL"], 'facebook.com') !== false) {
      $url = $_GET["URL"];
      echo '    <script>'."\n";
      echo '      var url = "'.$url.'";'."\n";
      echo '      $.get("https://cors-anywhere.herokuapp.com/" + url, function(data) {'."\n";
      echo '        var thumbnail;'."\n";
      echo '        var title = $(data).filter(\'meta[property="og:title"]\').attr("content");'."\n";
      echo '        var video_hd = facebookURL(data, "hd_src:",",sd_src:", 1, 1);'."\n";
      echo '        var video_sd = $(data).filter(\'meta[property="og:video"]\').attr("content");'."\n";
      echo '        $(\'#video_title\').append(title);'."\n";
      
      echo '        if(video_hd){'."\n";
      echo '          thumbnail = facebookURL(data, "_4lpf", "/></div>", 2, 7).replace(/amp;/g, "");'."\n";
      echo '	        $(\'#video_image\').append(\'<a href="\' + url + \'" target="_blank"><img class="img-fluid d-inline" src="\'+ thumbnail +\'" alt="\' + title + \'" title="\' + title + \'" /></a>\');'."\n";      
      echo '          $(\'#video_options\').append(\'<div class="input-group m-3"><div class="input-group-prepend"><span class="input-group-text text-monospace">'.$sd.'</span></div><div class="input-group-append"><a class="btn btn-primary" href="\'+ video_sd + \'" role="button"><i class="fas fa-download fa-fw"></i> '.$download,'</a></div></div>\');'."\n";
      echo '          $(\'#video_options\').append(\'<div class="input-group m-3"><div class="input-group-prepend"><span class="input-group-text text-monospace">'.$hd.'</span></div><div class="input-group-append"><a class="btn btn-primary" href="\'+ video_hd + \'" role="button"><i class="fas fa-download fa-fw"></i> '.$download,'</a></div></div>\');'."\n";
      echo '	      }'."\n";
      echo '        else {'."\n";
      echo '          thumbnail = $(data).filter(\'meta[property="twitter:image"]\').attr("content");'."\n";
      echo '          $(\'#video_image\').append(\'<a href="\' + url + \'" target="_blank"><img class="img-fluid d-inline" src="\'+ thumbnail +\'" alt="\' + title + \'" title="\' + title + \'" /></a>\');'."\n";
      echo '          $(\'#video_options\').append(\'<div class="input-group m-3"><div class="input-group-prepend"><span class="input-group-text" text-monospace>'.$sd.'</span></div><div class="input-group-append"><a class="btn btn-primary" href="\'+ video_sd + \'" role="button"><i class="fas fa-download fa-fw"></i> '.$download,'</a></div></div>\');'."\n";
      echo '        }'."\n";
      echo '      });'."\n";
      echo '      function facebookURL(data, antes, despues, n1, n2) {'."\n";
      echo '        var before = data.substring(data.indexOf(antes));'."\n";
      echo '        var after = before.substring(before.indexOf(despues)-n1,0);'."\n";
      echo '        var url = after.substring(after.indexOf(\'"\')+n2);'."\n";
      echo '        return url;'."\n";
      echo '      }'."\n";
      echo '    </script>'."\n";
      }
    }
?>
  </body>
</html>