<?php

class BLLClub
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $fullname;

    public $shortname;

    public $nickname;

    public $country;

    public $league;

    public $founded;

    public $majorhonours;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLOpponent
{

    public $id = null;

    public $fullname;

    public $shortname;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLPlayer
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $squadno;

    public $position;

    public $firstname;

    public $lastname;

    public $nationality;

    public $link1;

    public $link2;

    public $link3;

    public $review;

    public $review_href;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLNewsItem
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $heading;

    public $tagline;

    public $thumb_href;

    public $img_href;

    public $item_href;

    public $summary;

    public $content;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLSquad
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $squadlist;

    public $squadname;

    public $captainindex;

    public $starplayerindex;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLExecutive
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $name;

    public $role;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLManager
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $fname;

    public $lname;

    public $age;

    public $nationality;

    public $bio;

    public $bio_href;

    public $games_managed;

    public $games_lost;

    public $games_won;

    public $games_drawn;

    public $honours;

    public $honours_href;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLCoaching
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $fname;

    public $lname;

    public $role;

    public $bio;

    public $bio_href;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLFixture
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $date;

    public $kickoff = "";

    public $ishome;

    public $opp_full;

    public $opp_abbr;

    public $venue = "";

    public $attendance = 0;

    public $goalsfor = [];

    public $goalsagainst = [];

    public $competition = "";

    public $report;

    public $report_href;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLKit
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $kittype;

    public $kityear;

    public $kitimage_href;

    public $shirtdesc;

    public $shortsdesc;

    public $socksdesc;

    public $manufacturer;

    public $sponsor;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLStadium
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $name;

    public $addr;

    public $capacity;

    public $desc;

    public $desc_href;

    public $lat;

    public $long;

    public $imgdir;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue)
        {
            $this->{$tkey} = $tvalue;
        }
    }
}

?>