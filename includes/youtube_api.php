<?php require_once 'youtube_api_key.php'; ?>
<?php
  date_default_timezone_set('America/New_York');
  require_once 'google-api-php-client/src/Google/Client.php';
  require_once 'google-api-php-client/src/Google/Service/YouTube.php';

  $client = new Google_Client();
  $client->setDeveloperKey($API_KEY);
  $youtube = new Google_Service_YouTube($client);

  $playlist_id = 'PLsqKKilf_LzSxDphr30lUbMSebTV3kpKK';

  $playlistResponse = $youtube->playlists->listPlaylists('snippet', array(
    'maxResults' => 1,
    'id' => $playlist_id
  ));

  $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
    'maxResults' => 50,
    'playlistId' => $playlist_id
  ));
?>