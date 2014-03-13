<?php
include("./gracenote-rhythm/GracenoteRhythm.class.php");

// You will need a Gracenote Client ID to use this. Visit https://developer.gracenote.com/
// for more information.

$clientID  = ""; // Put your Client ID here.
$clientTag = ""; // Put your Client Tag here.

/* You first need to register your client information in order to get a userID.
Best practice is for an application to call this only once, and then cache the userID in
persistent storage, then only use the userID for subsequent API calls. The class will cache
it for just this session on your behalf, but you should store it yourself. */
$api = new Gracenote\WebAPI\GracenoteRhythm($clientID, $clientTag); // If you have a userID, you can specify as third parameter to constructor.
$userID = $api->register();
echo "UserID = ".$userID."\n";

// Once you have the userID, you do all of the other fancy stuff.
echo "\n\nList Available Moods:\n";
var_dump($api->getMoods());

echo "\n\nLocalize Moods to Japan:\n";
$api->setCountry("jpn");
$api->setLanguage("jpn");
var_dump($api->getMoods());
$api->setCountry("usa");
$api->setLanguage("eng");

echo "\n\nList Available Genres:\n";
var_dump($api->getGenres());

echo "\n\nList Available Eras:\n";
var_dump($api->getEras());

echo "\n\nCreate an Artist Based Station/Playlist:\n";
var_dump($api->createStationFromArtist("moby"));

echo "\n\nCreate a Track Based Station/Playlist:\n";
var_dump($api->createStationFromArtist("moby", "porcelin"));

echo "\n\nCreate a Mood Based Station/Playlist:\n";
var_dump($api->createStationFromMood(65322));

echo "\n\nCreate a Genre Based Station/Playlist:\n";
var_dump($api->createStationFromGenre(25980));

echo "\n\nCreate a Era Based Station/Playlist:\n";
var_dump($api->createStationFromEra(42877));

echo "\n\nCreate a Custom Station/Playlist Based on Multiple Seeds:\n";
var_dump($api->createStation(array("mood" => 65322, "genre" => 25980, "era" => 42877)));
