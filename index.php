<?php include 'includes/youtube_api.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/bxslider-4/jquery.bxslider.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container-fluid">
      <div class="row">
      <?php
        foreach ($playlistResponse['items'] as $searchResult) :
          $playlist_title = trim(htmlentities($searchResult['snippet']['title']));
      ?>
        <h3><?php echo $playlist_title; ?></h3>
      <?php endforeach; ?>

        <div id="video_container">
          <iframe id="video_frame" width="640" height="360" src="//www.youtube.com/embed?listType=playlist&amp;list=<?php echo $playlist_id; ?>&amp;modestbranding=1&amp;rel=0" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="video-items-container">
          <ul class="video-items bxslider">
          <?php
            foreach ($playlistItemsResponse['items'] as $searchResult) :
              // $playlist_title = $searchResult['snippet'];
              $video_id = $searchResult['snippet']['resourceId']['videoId'];
              $video_thumb = $searchResult['snippet']['thumbnails']['medium']['url'];
              $video_title = trim(htmlentities($searchResult['snippet']['title']));
          ?>
            <li class="video-item slide">
              <a href="http://youtu.be/<?php echo $video_id; ?>?list=<?php echo $playlist_id; ?>" target="_blank" class="clickme" data-id="<?php echo $video_id; ?>" title="Watch '<?php echo $video_title; ?>'">
                <img src="<?php echo $video_thumb; ?>" alt="<?php echo $video_title; ?>" class="video-thumb">
              </a>
              <div class="video-desc"><?php echo $video_title; ?></div>
            </li>
            <!-- end .video-item -->
          <?php endforeach; ?>
          </ul>
          <!-- end .video-items -->
        </div>
        <!-- end .video-item-container -->
      </div>
      <!-- end .row -->
    </div>
    <!-- end .container-fluid -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bower_components/jquery/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/jquery.fitvids/jquery.fitvids.js"></script>
    <script src="bower_components/bxslider-4/jquery.bxslider.js"></script>
    <script>
      $(document).ready(function(){
        $('#video_container').fitVids();
        $('.bxslider').bxSlider({
          slideWidth: 200,
          minSlides: 2,
          maxSlides: 3,
          slideMargin: 10
        });
        $('.clickme').on('click', function(e){
          var videoId = $(this).attr('data-id');
          // console.log(videoId);
          var url = '//www.youtube.com/embed/' + videoId + '?list=<?php echo $playlist_id; ?>&amp;modestbranding=1&amp;rel=0';
          $('#video_frame').attr('src', url);
          e.preventDefault();
        });
      });
    </script>
  </body>
</html>