A simple PHP client for the [Gracenote Rhythm API](https://developer.gracenote.com/rhythm-api), which allows you to create custom playlits/radio-stations based on artist, track, mood, genre, era, etc.

:exclamation: **_This is just example code to get you started on your own projects using Gracenote's Rhythm API, and is not meant as an exhaustive wrapper of the full API._**

### Installation

Just copy the `gracenote-rhythm` directory into your project, then include the `GracenoteRhythm.class.php` file.

    <?php
    include("./gracenote-rhythm/GracenoteRhythm.class.php");

### Prerequisites

You will need a Gracenote Client ID from the [Gracenote Developer Portal](https://developer.gracenote.com/) to use the API.

Each installed application also needs to have a User ID, which may be obtained by registering your Client ID with the Gracenote API. To do this, do:

    $api = new Gracenote\WebAPI\GracenoteRhythm($clientID, $clientTag);
    $userID = $api->register();

**This registration should be done only once per application to avoid hitting your API quota** (i.e. definitely do NOT do this before every query). The userID can be stored in persistent storage (e.g. on the filesystem) and used for all subsequent calls.

Once you have your Client ID and User ID, you can start making queries.

### Usage

First, initialize the object using your credentials and UserID.

    $api = new Gracenote\WebAPI\GracenoteRhythm($clientID, $clientTag, $userID);

Then, to create a station/playlist based on the artist Moby, you can just do this,

    $results = $api->createStationFromArtist("Moby");

The results are a PHP array containing the station/playlist information,

    array(2) {
      ["RADIO"]=>
      array(1) {
        [0]=>
        array(1) {
          ["ID"]=>
          string(32) "d2bed4bb72825d5f33a6de331ba1f02a"
        }
      }
      ["ALBUM"]=>
      array(10) {
        [0]=>
        array(7) {
          ["ORD"]=>
          string(1) "1"
          ["GN_ID"]=>
          string(40) "5026977-5C6DC28B1E1ADB1D028FF248DDFAEB55"
          ["TRACK_COUNT"]=>
          string(2) "18"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(4) "Moby"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(4) "Play"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(3) {
              ["TRACK_NUM"]=>
              string(1) "3"
              ["GN_ID"]=>
              string(40) "5026980-ECBA40087EF8911805E0EA8BA1FF2245"
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(9) "Porcelain"
                }
              }
            }
          }
          ["URL"]=>
          array(1) {
            [0]=>
            array(5) {
              ["TYPE"]=>
              string(8) "COVERART"
              ["SIZE"]=>
              string(6) "MEDIUM"
              ["WIDTH"]=>
              string(3) "450"
              ["HEIGHT"]=>
              string(3) "450"
              ["VALUE"]=>
              string(80) "http://akamai-b.cdn.cddbp.net/cds/2.0/cover/28CB/AE88/7BD9/B944_medium_front.jpg"
            }
          }
        }
        [1]=>
        array(7) {
          ["ORD"]=>
          string(1) "2"
          ["GN_ID"]=>
          string(42) "225485771-FD00428F62193125406634146AC7A014"
          ["TRACK_COUNT"]=>
          string(2) "17"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(14) "Ellie Goulding"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(13) "Bright Lights"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(4) {
              ["TRACK_NUM"]=>
              string(2) "11"
              ["GN_ID"]=>
              string(42) "225485782-05A4232E22AC9566845AEC757A6E40B7"
              ["ARTIST"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(14) "Ellie Goulding"
                }
              }
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(6) "Lights"
                }
              }
            }
          }
          ["URL"]=>
          array(1) {
            [0]=>
            array(5) {
              ["TYPE"]=>
              string(8) "COVERART"
              ["SIZE"]=>
              string(6) "MEDIUM"
              ["WIDTH"]=>
              string(3) "450"
              ["HEIGHT"]=>
              string(3) "450"
              ["VALUE"]=>
              string(80) "http://akamai-b.cdn.cddbp.net/cds/2.0/cover/CE8D/DBDD/6B1F/9FAA_medium_front.jpg"
            }
          }
        }
        [2]=>
        array(7) {
          ["ORD"]=>
          string(1) "3"
          ["GN_ID"]=>
          string(42) "120341057-ADC2C9F29C6BA77EEA588E1ED8D0073F"
          ["TRACK_COUNT"]=>
          string(2) "13"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(12) "Patrick Wolf"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(18) "The Magic Position"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(3) {
              ["TRACK_NUM"]=>
              string(1) "2"
              ["GN_ID"]=>
              string(42) "120341059-E8FFB53B8D39A6317181B7093408074E"
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(18) "The Magic Position"
                }
              }
            }
          }
          ["URL"]=>
          array(1) {
            [0]=>
            array(5) {
              ["TYPE"]=>
              string(8) "COVERART"
              ["SIZE"]=>
              string(6) "MEDIUM"
              ["WIDTH"]=>
              string(3) "450"
              ["HEIGHT"]=>
              string(3) "450"
              ["VALUE"]=>
              string(80) "http://akamai-b.cdn.cddbp.net/cds/2.0/cover/53C4/711B/143A/38F0_medium_front.jpg"
            }
          }
        }
        [3]=>
        array(7) {
          ["ORD"]=>
          string(1) "4"
          ["GN_ID"]=>
          string(42) "186635416-CFD97126055ADA89DA731E0F812B904D"
          ["TRACK_COUNT"]=>
          string(2) "12"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(7) "La Roux"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(7) "La Roux"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(4) {
              ["TRACK_NUM"]=>
              string(1) "4"
              ["GN_ID"]=>
              string(42) "186635420-04BF4B4056B0B34FCE456DD15D26339F"
              ["ARTIST"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(7) "La Roux"
                }
              }
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(11) "Bulletproof"
                }
              }
            }
          }
          ["URL"]=>
          array(1) {
            [0]=>
            array(5) {
              ["TYPE"]=>
              string(8) "COVERART"
              ["SIZE"]=>
              string(6) "MEDIUM"
              ["WIDTH"]=>
              string(3) "450"
              ["HEIGHT"]=>
              string(3) "450"
              ["VALUE"]=>
              string(80) "http://akamai-b.cdn.cddbp.net/cds/2.0/cover/44D0/2FFA/4CCE/2994_medium_front.jpg"
            }
          }
        }
        [4]=>
        array(7) {
          ["ORD"]=>
          string(1) "5"
          ["GN_ID"]=>
          string(40) "4910181-E2B1A4461916E4E3B105E74A9878C796"
          ["TRACK_COUNT"]=>
          string(2) "11"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(23) "Everything But The Girl"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(15) "Amplified Heart"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(3) {
              ["TRACK_NUM"]=>
              string(1) "6"
              ["GN_ID"]=>
              string(40) "4910187-EFE93CE00C1D361EF89BF5A5CF347FAF"
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(7) "Missing"
                }
              }
            }
          }
          ["URL"]=>
          array(1) {
            [0]=>
            array(5) {
              ["TYPE"]=>
              string(8) "COVERART"
              ["SIZE"]=>
              string(6) "MEDIUM"
              ["WIDTH"]=>
              string(3) "450"
              ["HEIGHT"]=>
              string(3) "450"
              ["VALUE"]=>
              string(80) "http://akamai-b.cdn.cddbp.net/cds/2.0/cover/CED2/894D/0039/90A2_medium_front.jpg"
            }
          }
        }
        [5]=>
        array(6) {
          ["ORD"]=>
          string(1) "6"
          ["GN_ID"]=>
          string(41) "86550627-230D44ECCB784161D54A1CB388901809"
          ["TRACK_COUNT"]=>
          string(2) "11"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(9) "Goldfrapp"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(11) "Supernature"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(3) {
              ["TRACK_NUM"]=>
              string(1) "1"
              ["GN_ID"]=>
              string(41) "86550628-D19FD45D0B4F8F525925839C2D87AFB9"
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(9) "Ooh La La"
                }
              }
            }
          }
        }
        [6]=>
        array(6) {
          ["ORD"]=>
          string(1) "7"
          ["GN_ID"]=>
          string(40) "5026977-5C6DC28B1E1ADB1D028FF248DDFAEB55"
          ["TRACK_COUNT"]=>
          string(2) "18"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(4) "Moby"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(4) "Play"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(3) {
              ["TRACK_NUM"]=>
              string(1) "7"
              ["GN_ID"]=>
              string(40) "5026984-5CDBDBB57B6CD506449E197605D5DC9A"
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(8) "Bodyrock"
                }
              }
            }
          }
        }
        [7]=>
        array(6) {
          ["ORD"]=>
          string(1) "8"
          ["GN_ID"]=>
          string(40) "5026977-5C6DC28B1E1ADB1D028FF248DDFAEB55"
          ["TRACK_COUNT"]=>
          string(2) "18"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(4) "Moby"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(4) "Play"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(4) {
              ["TRACK_NUM"]=>
              string(1) "5"
              ["GN_ID"]=>
              string(40) "5026982-51CB371F4B1676CA812E6C1665F45A78"
              ["ARTIST"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(23) "Moby Feat. Gwen Stefani"
                }
              }
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(10) "South Side"
                }
              }
            }
          }
        }
        [8]=>
        array(6) {
          ["ORD"]=>
          string(1) "9"
          ["GN_ID"]=>
          string(41) "10969781-7F51A87A4B4B2658827F3A596883BA98"
          ["TRACK_COUNT"]=>
          string(2) "18"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(6) "Moloko"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(21) "Things To Make And Do"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(3) {
              ["TRACK_NUM"]=>
              string(1) "9"
              ["GN_ID"]=>
              string(41) "10969790-1E98812F11E78648FA21A2129D34290C"
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(15) "The Time Is Now"
                }
              }
            }
          }
        }
        [9]=>
        array(6) {
          ["ORD"]=>
          string(2) "10"
          ["GN_ID"]=>
          string(42) "167898371-EE019E9DB22416F75615D3C9B16E42B7"
          ["TRACK_COUNT"]=>
          string(2) "10"
          ["ARTIST"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(17) "Empire Of The Sun"
            }
          }
          ["TITLE"]=>
          array(1) {
            [0]=>
            array(1) {
              ["VALUE"]=>
              string(18) "Walking On A Dream"
            }
          }
          ["TRACK"]=>
          array(1) {
            [0]=>
            array(3) {
              ["TRACK_NUM"]=>
              string(1) "2"
              ["GN_ID"]=>
              string(42) "167898373-305E62BA1629707E81BFF24878D547CF"
              ["TITLE"]=>
              array(1) {
                [0]=>
                array(1) {
                  ["VALUE"]=>
                  string(18) "Walking On A Dream"
                }
              }
            }
          }
        }
      }
    }


_Note that URLs to related content (e.g. Album Art, Artist Image, etc) are not valid forever, so your application should download the content you want relatively soon after the lookup and cache it locally._

You can change the language or country at any time by calling the following functions, using the standard 3 character [ISO-639-2 language codes](http://en.wikipedia.org/wiki/List_of_ISO_639-2_codes) or the 3 character [ISO-3166-1 country codes](http://en.wikipedia.org/wiki/ISO_3166-1_alpha-3#Current_codes), all subsequent requests will then use the new localization settings.

    $api->setCountry("jpn");
    $api->setLanguage("jpn");

There are various other helper functions you can use to get started, see `example.php` for their usage.

    // List out all of the available Mood/Genre/Era ID's and their labels.
    $api->getMoods();
    $api->getGenres();
    $api->getEras();

    // Create stations/playlists based on various other seeds
    $api->createStationFromTrack("artist", "track");
    $api->createStationFromMood(65322);
    $api->createStationFromGenre(25974);
    $api->createStationFromEra(29483);

