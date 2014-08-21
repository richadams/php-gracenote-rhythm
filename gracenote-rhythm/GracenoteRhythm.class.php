<?php
namespace Gracenote\WebAPI;

// You will need a Gracenote Client ID to use this. Visit https://developer.gracenote.com/ for info.

// Defaults
if (!defined("GN_DEBUG")) { define("GN_DEBUG", false); }

// Dependencies
include(dirname( __FILE__ )."/GracenoteError.class.php");
include(dirname( __FILE__ )."/HTTP.class.php");

// The different API calls that can be made.
class GracenoteRhythmAPI
{
    const REGISTER  = "register";
    const CREATE    = "create";
    const FIELDS    = "fieldvalues";
    const RECOMMEND = "recommend";
}

class GracenoteRhythm
{
    // Members
    private $_clientID  = null;
    private $_clientTag = null;
    private $_userID    = null;

    private $_apiURL    = "https://c[[CLID]].web.cddbp.net/webapi/json/1.0/radio/";

    private $_country   = "usa"; // Default to US
    private $_lang      = "eng"; // Default to English

    // Constructor
    public function __construct($clientID, $clientTag, $userID = null)
    {
        // Sanity checks
        if ($clientID === null || $clientID == "")   { throw new GNException(GNError::INVALID_INPUT_SPECIFIED, "clientID"); }
        if ($clientTag === null || $clientTag == "") { throw new GNException(GNError::INVALID_INPUT_SPECIFIED, "clientTag"); }

        $this->_clientID  = $clientID;
        $this->_clientTag = $clientTag;
        $this->_userID    = $userID;
        $this->_apiURL    = str_replace("[[CLID]]", $this->_clientID, $this->_apiURL);
    }

    // Setters for localization if people need to override.
    public function setCountry($country) { $this->_country = $country; }
    public function setLanguage($lang)   { $this->_lang    = $lang; }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    // Executes the query to Gracenote.
    protected function _execute($api, $inputs)
    {
        // Add common inputs
        $inputs["client"]  = $this->_clientID."-".$this->_clientTag;
        $inputs["country"] = $this->_country;
        $inputs["lang"]    = $this->_lang;
        if ($this->_userID !== null) { $inputs["user"] = $this->_userID; }

        // Construct the URL
        $url = $this->_apiURL.$api."?";
        foreach ($inputs as $key => $value) { $url .= $key."=".urlencode($value)."&"; }

        // Make the request
        $request  = new HTTP($url);
        $response = $request->get();
        return $this->_parseResponse($response);
    }

    // Check the response for any Gracenote API errors.
    protected function _checkResponse($response = null)
    {
        // Response is JSON, so try to decode.
        $json = json_decode($response, true);

        // Check if we could decode it
        if ($json === false) { throw new GNException(GNError::UNABLE_TO_PARSE_RESPONSE); }

        // Check response status code.
        $status = $json["RESPONSE"][0]["STATUS"];

        // Check for any error codes and handle accordingly.
        switch ($status)
        {
            case "ERROR":    throw new GNException(GNError::API_RESPONSE_ERROR); break;
            case "NO_MATCH": throw new GNException(GNError::API_NO_MATCH); break;
            default:
                if ($status != "OK") { throw new GNException(GNError::API_NON_OK_RESPONSE, $status); }
        }

        // We're done with the STATUS field now, so get rid of it and just return the data part.
        $data = $json["RESPONSE"][0];
        unset($data["STATUS"]);
        return $data;
    }

    // This parses the API response into a PHP Array object.
    protected function _parseResponse($response)
    {
        $data = array();

        // Parse the response from Gracenote, check for errors, etc.
        try
        {
            $data = $this->_checkResponse($response);
        }
        catch (GNException $e)
        {
            // If it was a no match, just give empty array back
            if ($e->getCode() == GNError::API_NO_MATCH) { return array(); }

            // Otherwise, re-throw the exception
            throw $e;
        }

        return $data;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    // Will register your clientID and Tag in order to get a userID. The userID should be stored
    // in a persistent form (filesystem, db, etc) otherwise you will hit your user limit.
    public function register()
    {
        // Make sure user doesn't try to register again if they already have a userID in the ctor.
        if ($this->_userID !== null)
        {
            echo "Warning: You already have a userID, no need to register another. Using current ID.\n";
            return $this->_userID;
        }

        // Do the register request
        $response = $this->_execute(GracenoteRhythmAPI::REGISTER, array());

        // Cache it locally, then return it to the user.
        $this->_userID = (string)$response["USER"][0]["VALUE"];
        return $this->_userID;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    // Wrappers to get static field lookups for mood, era, genre, etc.
    public function getMoods()
    {
        $response = $this->_execute(GracenoteRhythmAPI::FIELDS, array("fieldname" => "RADIOMOOD"));
        return $response["MOOD"];
    }

    public function getGenres()
    {
        $response = $this->_execute(GracenoteRhythmAPI::FIELDS, array("fieldname" => "RADIOGENRE"));
        return $response["GENRE"];
    }

    public function getEras()
    {
        $response = $this->_execute(GracenoteRhythmAPI::FIELDS, array("fieldname" => "RADIOERA"));
        return $response["ERA"];
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////

    // Generic function to create a station from various seeds.
    public function createStation($inputs, $mode = GracenoteRhythmAPI::CREATE)
    {
        // Automatically add some common options.
        if(!isset($inputs["return_count"])) $inputs["return_count"]    = 10;
        if(!isset($inputs["select_extended"])) $inputs["select_extended"] = "cover,link";

        $response = $this->_execute($mode, $inputs);
        return $response;
    }
    
    // Generic function to create recommendations from various seeds.
    public function createRecomendation($inputs)
    {
        return $this->createStation($inputs, GracenoteRhythmAPI::RECOMMEND);
    }

    // Helpers to create radio stations based on various seeds.
    public function createStationFromArtist($artist)
    {
        return $this->createStation(array("artist_name" => $artist));
    }

    public function createStationFromTrack($artist, $track)
    {
        return $this->createStation(array("artist_name" => $artist,
                                          "track_title" => $track));
    }

    public function createStationFromMood($moodID)
    {
        return $this->createStation(array("mood" => $moodID));
    }

    public function createStationFromGenre($genreID)
    {
        return $this->createStation(array("genre" => $genreID));
    }

    public function createStationFromEra($eraID)
    {
        return $this->createStation(array("era" => $eraID));
    }
}
