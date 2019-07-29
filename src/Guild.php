<?php

namespace TibiaApi\Website;

class Guild
{

    private $name;
    private $description;
    private $homepage;
    private $founded;
    private $guildHouse;
    private $invites = array();
    private $ranks = array();
    private $members = array();

    public function __construct(string $name)
    {
        // Fetch guild details
    }
}