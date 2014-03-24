#tutor-php

Port of [Tutor](https://github.com/davidchambers/tutor) (an MTG web scraping tool) to PHP

##About

Like the original project, Tutor-PHP aims to provide an API on top of
[Gatherer](http://gatherer.wizards.com/Pages/Default.aspx), the canonical source for MTG information. Since this
information is made available only through Gatherer's web interface, accessing it programmatically can be difficult.
Enter Tutor-PHP! The included `Tutor` class can be used to get useful information about:
*Cards
*Sets
*Formats
*Languages

##Usage

Tutor-PHP depends on `simple_html_dom.php`, which is included.

###From PHP

Instantiate the `Tutor` class:
    $tutor = new Tutor();
Then, start making requests!

###From the command line:

Use the included `tutor` shell script.

###Get information about a card, by name

####From PHP
    $force_of_will = $tutor->get_card_by_name("Force of Will");

####From the command line
    ./tutor action=card name="Force of Will"

###Get information about a card, by its multiverse ID

####From PHP
    $lightning_bolt = $tutor->get_card_by_multiverse("209");

####From the command line
    ./tutor action=card multiverse=209

###Get information about a card's legalities

####From PHP
    $legalities = $tutor->get_legalities("209");

####From the command line
    ./tutor action=legalities multiverse=209

###Get a list of all multiverse IDs in a set

####From PHP
    $ids_in_born_of_the_gods = $tutor->get_set_ids("Born of the Gods");

####From the command line
    ./tutor action=set set="Born of the Gods"

###Get information about which sets exist

####From PHP
    $all_sets = $tutor->get_sets();

####From the command line
    ./tutor action=sets

###Get information about which formats exist

####From PHP
    $all_sets = $tutor->get_formats();

####From the command line
    ./tutor action=formats

###Get information about which languages Gatherer supports

####From PHP
    $all_sets = $tutor->get_languages();

####From the command line
    ./tutor action=languages

Language codes, as returned by the above commands, can be passed to any of the above commands to get cards in that
language.  For example:
    $german_theros_ids = $tutor->get_set_ids("Theros", "de-de");
    ./tutor action=set set="Theros" language="de-de"

##Output Format

Queries about sets, formats, and languages return a PHP array of those objects (multiverse IDs in a set, set names,
format names, and language codes).

Queries about a card return an associative array in the following format.

    ./tutor action=card name="Jace Beleren" | python -mjson.tool

    {
        "converted_mana_cost": 3,
        "gatherer_url": "http://gatherer.wizards.com/Pages/Card/Details.aspx?name=Jace+Beleren",
        "image_url": "http://gatherer.wizards.com/Handlers/Image.ashx?type=card&name=Jace+Beleren",
        "loyalty": 3,
        "mana_cost": "{1}{U}{U}",
        "name": "Jace Beleren",
        "subtypes": [
            "Jace"
        ],
        "supertypes": [],
        "text": "+2: Each player draws a card.\n\n-1: Target player draws a card.\n\n-10: Target player puts the top twenty cards of his or her library into his or her graveyard.",
        "types": [
            "Planeswalker"
        ],
        "versions": {
            "140222": {
                "expansion": "Lorwyn",
                "rarity": "Rare"
            },
            "185816": {
                "expansion": "Duel Decks: Jace vs. Chandra",
                "rarity": "Mythic Rare"
            },
            "191240": {
                "expansion": "Magic 2010",
                "rarity": "Mythic Rare"
            },
            "205960": {
                "expansion": "Magic 2011",
                "rarity": "Mythic Rare"
            }
        }
    }

Cards with power, toughness, or other attributes will have those fields as well; cards without them will not.
