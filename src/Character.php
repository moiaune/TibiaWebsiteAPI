<?php

namespace TibiaApi\Website;

class Character
{
    private $name;
    private $title;
    private $sex;
    private $vocation;
    private $level;
    private $points;
    private $world;
    private $formerWorld;
    private $residence;
    private $lastLogin;
    private $comment;
    private $status;
    
    private $achievements = array();

    private $loyaltyTitle;
    private $created;

    private $house;
    private $guild;

    private $deaths = array();
    private $otherCharacters = array();


    public function __construct(string $name) {
        $dom = new \DOMDocument();
        $dom->loadHTMLFile("https://www.tibia.com/community/?subtopic=characters&name=" . urlencode($name));

        $tables = $dom->getElementsByTagName('table');

        $this->name = $tables[1]->childNodes[1]->textContent;
        $this->title = $tables[1]->childNodes[3]->textContent;

        echo "Name: " . $this->name . "\n";
        echo "Title: " . $this->title . "\n";
    }
}

$char = new Character('Kamerat');