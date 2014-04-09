<?php
require_once __DIR__.'/../includes/simple_html_dom.php';

class Tutor {
    const gatherer_url = "http://gatherer.wizards.com/Pages/Default.aspx";
    const sets_option_select = 'ctl00$ctl00$MainContent$Content$SearchControls$setAddText';
    const formats_option_select = 'ctl00$ctl00$MainContent$Content$SearchControls$formatAddText';
    const legalities_url = "http://gatherer.wizards.com/Pages/Card/Printings.aspx?multiverseid=";
    const name_details_url = "http://gatherer.wizards.com/Pages/Card/Details.aspx?name=";
    const name_gatherer_image_url = "http://gatherer.wizards.com/Handlers/Image.ashx?type=card&name=";
    const details_url = "http://gatherer.wizards.com/Pages/Card/Details.aspx?multiverseid=";
    const gatherer_image_url = "http://gatherer.wizards.com/Handlers/Image.ashx?type=card&multiverseid=";
    const gatherer_languages_url = "http://gatherer.wizards.com/Pages/Language.aspx";
    const gatherer_spoiler_url = "http://gatherer.wizards.com/Pages/Search/Default.aspx?output=spoiler&method=text&set=";

    function __construct() {
        $this->language = "en-US";

        $this->sets = array(
        	"Limited Edition Alpha" => "1E",
        	"Limited Edition Beta" => "2E",
        	"Unlimited Edition" => "2U",
        	"Revised Edition" => "3E",
        	"Fourth Edition" => "4E",
        	"Ice Age" => "IA",
        	"Mirage" => "MI",
        	"Fifth Edition" => "5E",
        	"Portal" => "PO",
        	"Tempest" => "TE",
        	"Urza's Saga" => "UZ",
        	"Unglued" => "UG",
        	"Portal Second Age" => "P3",
        	"Portal Three Kingdoms" => "PK",
        	"Classic Sixth Edition" => "6E",
        	"Seventh Edition" => "7E",
        	"Mercadian Masques" => "MM",
        	"Battle Royale Box Set" => "BR",
        	"Starter 1999" => "P3",
        	"Starter 2000" => "P4",
        	"Invasion" => "IN",
        	"Beatdown Box Set" => "BD",
        	"Odyssey" => "OD",
        	"Onslaught" => "ONS",
        	"Eighth Edition" => "8ED",
        	"Mirrodin" => "MRD",
        	"Unhinged" => "UNH",
        	"Champions of Kamigawa" => "CHK",
        	"Ninth Edition" => "9ED",
        	"Ravnica: City of Guilds" => "RAV",
        	"Tenth Edition" => "10E",
        	"Time Spiral" => "TSP",
        	"Lorwyn" => "LRW",
        	"Shadowmoor" => "SHM",
        	"Masters Edition" => "MED",
        	"Shards of Alara" => "ALA",
        	"Duel Decks: Jace vs. Chandra" => "DD2",
        	"Magic 2010" => "M10",
        	"Zendikar" => "ZEN",
        	"Planechase" => "HOP",
        	"Rise of the Eldrazi" => "ROE",
        	"Masters Edition III" => "ME3",
        	"Premium Deck Series: Slivers" => "H09",
        	"Duel Decks: Phyrexia vs. the Coalition" => "DDE",
        	"Magic 2011" => "M11",
        	"Scars of Mirrodin" => "SOM",
        	"Mirrodin Besieged" => "MBS",
        	"Archenemy" => "1E",
        	"Duel Decks: Elspeth vs. Tezzeret" => "DDF",
        	"New Phyrexia" => "NPH",
        	"Magic 2012" => "M12",
        	"Innistrad" => "ISD",
        	"Magic 2013" => "M13",
        	"Magic: The Gathering-Commander" => "CMD",
        	"Duel Decks: Ajani vs. Nicol Bolas" => "DDH",
        	"Avacyn Restored" => "AVR",
        	"Planechase 2012 Edition" => "PC2",
        	"Duel Decks: Venser vs. Koth" => "DDI",
        	"Return to Ravnica" => "RTR",
        	"Duel Decks: Izzet vs. Golgari" => "DDJ",
        	"Duel Decks: Sorin vs. Tibalt" => "DDJ",
        	"Alara Reborn" => "ARB",
        	"Alliances" => "AL",
        	"Antiquities" => "AQ",
        	"Apocalypse" => "AP",
        	"Arabian Nights" => "AN",
        	"Betrayers of Kamigawa" => "BOK",
        	"Chronicles" => "CH",
        	"Coldsnap" => "CSP",
        	"Commander's Arsenal" => "CM1",
        	"Conflux" => "CON",
        	"Dark Ascension" => "DKA",
        	"Darksteel" => "DST",
        	"Dissension" => "DIS",
        	"Duel Decks: Divine vs. Demonic" => "DDC",
        	"Duel Decks: Elves vs. Goblins" => "EVG",
        	"Duel Decks: Garruk vs. Liliana" => "DDD",
        	"Duel Decks: Knights vs. Dragons" => "DDG",
        	"Eventide" => "EVE",
        	"Exodus" => "EX",
        	"Fallen Empires" => "FE",
        	"Fifth Dawn" => "5DN",
        	"From the Vault: Dragons" => "DRB",
        	"From the Vault: Exiled" => "V09",
        	"From the Vault: Legends" => "V11",
        	"From the Vault: Realms" => "V12",
        	"From the Vault: Relics" => "V10",
        	"Future Sight" => "FUT",
        	"Guildpact" => "GPT",
        	"Homelands" => "HM",
        	"Judgment" => "JUD",
        	"Legends" => "LE",
        	"Legions" => "LGN",
        	"Masters Edition II" => "ME2",
        	"Masters Edition IV" => "ME3",
        	"Morningtide" => "MOR",
        	"Nemesis" => "NM",
        	"Planar Chaos" => "PLC",
        	"Planeshift" => "PS",
        	"Premium Deck Series: Fire and Lightning" => "PD2",
        	"Premium Deck Series: Graveborn" => "PD3",
        	"Prophecy" => "PR",
        	"Saviors of Kamigawa" => "SOK",
        	"Scourge" => "SCG",
        	"Stronghold" => "ST",
        	"The Dark" => "DK",
        	"Time Spiral \"Timeshifted\"" => "TSB",
        	"Torment" => "TOR",
        	"Urza's Destiny" => "CG",
        	"Urza's Legacy" => "GU",
        	"Vanguard" => "1E",
        	"Visions" => "VI",
        	"Weatherlight" => "WL",
        	"Worldwake" => "WWK",
        	"Promo set for Gatherer" => "PPR",
        	"Gatecrash" => "GTC",
        	"Agent of Artifice Novel" => "PPR",
        	"APAC Blue" => "PPR",
        	"APAC Clear" => "PPR",
        	"APAC Red" => "PPR",
        	"Euro Blue" => "PPR",
        	"Euro Purple" => "PPR",
        	"Euro Red" => "PPR",
        	"Champs" => "PPR",
        	"Game Day" => "PPR",
        	"Grand Prix Promo" => "PPR",
        	"Pro Tour Promo" => "PPR",
        	"Guru" => "PPR",
        	"Judge Rewards" => "PPR",
        	"FNM Promo" => "PPR",
        	"WPN Promo" => "PPR",
        	"Player Rewards" => "PPR",
        	"Dragon's Maze" => "DGM",
            "Theros" => "THS",
            "Magic 2014 Core Set" => "M14",
            "Modern Masters" => "MMA",
            "From the Vault: Twenty" => "V13",
            "Duel Decks: Heroes vs. Monsters" => "DDL",
            "Commander 2013 Edition" => "C13",
            "Born of the Gods" => "BNG",
            "Duel Decks: Jace vs. Vraska" => "DDM"
        );

        $symbols_defs = array(
        	'W' => 'White',
            'U' => 'Blue',
            'B' => 'Black',
            'R' => 'Red',
            'G' => 'Green',
            '2' => 'Two',
            'S' => 'Snow',
            'T' => 'Tap',
            'Q' => 'Untap',
            'X' => 'Variable Colorless',
            'W/P' => 'Phyrexian White',
            'U/P' => 'Phyrexian Blue',
            'B/P' => 'Phyrexian Black',
            'R/P' => 'Phyrexian Red',
            'G/P' => 'Phyrexian Green'
        );
        $this->symbols = array();
        foreach ($symbols_defs as $k => $v) {
        	$this->symbols[$v] = $k;
        }

        $this->supertypes = array('Basic', 'Legendary', 'Ongoing', 'Snow', 'World');
    }

    /*
     * Get the current list of MTG sets from Gatherer
     */
	public function get_sets($language="") {
        $html = $this->get_gatherer_page(self::gatherer_url, $language);

        $select = $html->find('[name='.self::sets_option_select.']');
        $select = $select[0];

        $options = $select->children();

        $sets = array();

        foreach ($options as $option) {
        	$value = $option->value;
        	if (is_string($value) && strlen($value) > 0) $sets[] = html_entity_decode($value);
        }
        return $sets;
    }

    /*
     * Get the current list of MTG set abbreviations
     * TODO: retrieve from Gatherer
     */
    public function get_set_abbreviations() {
        return $this->sets;
    }

    /*
     * Get the current list of MTG formats from Gatherer
     */
    public function get_formats($language="") {
        $html = $this->get_gatherer_page(self::gatherer_url, $language);

        $select = $html->find('[name='.self::formats_option_select.']');
        $select = $select[0];

        $options = $select->children();

        $formats = array();

        foreach ($options as $option) {
            $value = $option->value;
            if (is_string($value) && strlen($value) > 0) $formats[] = $value;
        }
        return $formats;
    }

    public function get_languages() {
        $html = $this->get_gatherer_page(self::gatherer_languages_url);

        $container = $html->getElementById("ctl00_ctl00_MainContent_SubContent_languagePreferenceSelector_ButtonContainer");
        $inputs = $container->find('input');

        $languages = [];
        foreach($inputs as $input) {
            $value = $input->value;
            if (is_string($value) && strlen($value) > 0) $languages[] = $value;
        }
        return $languages;
    }

    /*
     * Get information about an MTG card by name
     */
    public function get_card_by_name($card, $language="") {
        $pieces = array();
        if (preg_match("/(\w+)\s+\/\/\s+(\w+)/", $card, $pieces)) {
        	$cards = array();
        	foreach(array_slice($pieces, 1) as $piece) {
        		$gatherer_url = self::name_details_url.urlencode($piece);
        		$image_url = self::name_gatherer_image_url.urlencode($piece);
                if (!isset($html)) {
                    $html = $this->get_gatherer_page($gatherer_url, $language);
                }
        		$cards[] = $this->get_card($piece, $html, $image_url, $gatherer_url);
        	}
        	return array(
                'name' => $card,
                "parts" => $cards
            );
        }
        $gatherer_url = self::name_details_url.urlencode($card);
        $image_url = self::name_gatherer_image_url.urlencode($card);
        $html = $this->get_gatherer_page($gatherer_url, $language);
        if ($html === false) $ret = 0;
        else $ret = $this->get_card($card, $html, $image_url, $gatherer_url);
        return $ret;
    }

    /*
     * Get information about an MTG card by multiverse ID
     */
    public function get_card_by_multiverse($card, $language="") {
        $gatherer_url = self::details_url.$card;
        $image_url = self::gatherer_image_url.$card;
        $html = $this->get_gatherer_page($gatherer_url, $language);
        if ($html === false) $ret = 0;
        else {
        	$split = $html->find("a[href*=part]");
            $card_name_elm = $html->getElementById("ctl00_ctl00_ctl00_MainContent_SubContent_SubContentHeader_subtitleDisplay");
            $card_name = isset($card_name_elm->innertext) ? $card_name_elm->innertext : "";

        	if ($split) {
        		$names = trim($split[0]->parent()->parent()->parent()->find("b", -1)->innertext);
        		$pieces = array();
        		if (preg_match("/(\w+)\s+\/\/\s+(\w+)/", $names, $pieces)) {
        			$cards = array();
        			$card_names = array();
        			foreach(array_slice($pieces, 1) as $piece) {
        				$new_card = $this->get_card($piece, $this->get_gatherer_page($gatherer_url."&part=$piece", $language), $image_url, $gatherer_url."&part=$piece");
        				$cards[] = $new_card;
        				$card_names[] = $new_card['name'];
        			}
        			$ret = array("name" => implode(" // ", $card_names), "parts" => $cards);
        			return $ret;
        		}
        	} else if (strpos($card_name, " // ") !== false ) {
                $left_card = $this->get_card($card, $html, $image_url, $gatherer_url, 'a');
                $right_card = $this->get_card($card, $html, $image_url, $gatherer_url, 'b');
                $ret = array('name' => $card_name, 'parts' => array($left_card, $right_card));
        		return $ret;
        	}
        	$ret = $this->get_card($card, $html, $image_url, $gatherer_url);
        }
        return $ret;
    }

    /*
     * Get information about the legality of a card by multiverse ID
     */
    public function get_card_legalities($card, $language="") {
        $html = $this->get_gatherer_page(self::legalities_url.$card, $language);
        if ($html === false) $formats = 0;
        else {
        	$table = $html->find("table[class=cardList]", 1);
        	$formats = array();
        	if ($table != null) {
        		$format_rows = $table->find("tr[class=cardItem]");
        		foreach($format_rows as $row) {
        			$tds = $row->find("td");
        			$formats[trim($tds[0]->innertext)] = trim($tds[1]->innertext);
        		}
        	}
        }
        return $formats;
    }

    public function get_set_ids($set, $language="") {
        $ids = [];
        $html = $this->get_gatherer_page(self::gatherer_spoiler_url.'["'.urlencode($set).'"]', $language);
        $spoiler = $html->find('.textspoiler')[0];
        $trs = $spoiler->find('tr');
        $count = 0;
        foreach ($trs as $tr) {
            if ($count % 7 === 0) {
                $tds = $tr->find('td');
                if (preg_match("/multiverseid=(\d+)/iu", $tds[1]->innertext, $matches)) {
                    $ids[] = $matches[1];
                }
            }
            $count++;
        }
        $html->clear();
        return $ids;
    }

    public function handle_action() {
        if (!isset($_REQUEST['action'])) return null;
        $ret = null;
        $action = $_REQUEST['action'];
        $language = "";
        if (isset($_REQUEST['language'])) {
            $language = $_REQUEST['language'];
        }
        switch ($action) {
            case 'card':
                if (isset($_REQUEST['name'])) {
                    $ret = $this->get_card_by_name($_REQUEST['name'], $language);
                    break;
                }
                elseif (isset($_REQUEST['multiverse'])) {
                    $ret = $this->get_card_by_multiverse($_REQUEST['multiverse'], $language);
                    break;
                }
                break;
            case 'legalities':
                if (isset($_REQUEST['multiverse'])) {
                    $ret = $this->get_card_legalities($_REQUEST['multiverse'], $language);
                    break;
                }
                break;
            case 'sets':
                $ret = $this->get_sets($language);
                break;
            case 'set':
                if (isset($_REQUEST['set'])) {
                    $ret = $this->get_set_ids($_REQUEST['set'], $language);
                    break;
                }
                break;
            case 'formats':
                $ret = $this->get_formats($language);
                break;
            case 'languages':
                $ret = $this->get_languages();
                break;
            default:
                break;
        }
        if (isset($_REQUEST['verbose'])) {
        	header('Content-type: application/json');
        	echo json_encode($ret);
        }
        return $ret;
    }

    /*
     * Fetch the HTML of a page from Gatherer
     */
    private function get_gatherer_page($url, $language="") {
        if ($language === "") $language = $this->language;
        $opts = array('http' => array('header'=> 'Cookie: CardDatabaseSettings=1=' . $language . ';' . "\r\n"));
        $context = stream_context_create($opts);
        return file_get_html($url, false, $context);
    }

    /*
     * Parse information about an MTG card from the HTML returned by Gatherer
     */
    private function get_card($name, $html, $image_url, $gatherer_url, $which='a') {
       	$row_id = "ctl00_ctl00_ctl00_MainContent_SubContent_SubContent_";
       	$ret = array("converted_mana_cost" => 0, "supertypes" => array(), "types" => array(), "subtypes" => array());
       	$ret['image_url'] = stripslashes($image_url);
       	$ret['gatherer_url'] = stripslashes($gatherer_url);
       	$sides = $html->find('.cardComponentContainer');
       	if (count($sides) > 1) {
       		$left = $sides[0];
       		$right = $sides[1];
               $left_prefix = 'ctl07_';
               $right_prefix = 'ctl08_';
       		$left_sets = Gatherer::get_card_sets($left, $row_id.$left_prefix);
               if ($left_sets == null) {
                   $left_prefix = 'ctl09_';
                   $right_prefix = 'ctl10_';
                   $left_sets = Gatherer::get_card_sets($left, $row_id.$left_prefix);
               }
               if ($left_sets == null) {
                   $left_prefix = 'ctl05_';
                   $right_prefix = 'ctl06_';
                   $left_sets = Gatherer::get_card_sets($left, $row_id.$left_prefix);
               }
       		$right_sets = Gatherer::get_card_sets($right, $row_id.$right_prefix);
       		$right_names = $right->find(".value");
       		if ($which === 'b' || (isset($right_sets[$name]) &&
                   !isset($left_sets[$name])) ||
                       (isset($right_names[0]) && isset($right_names[0]->innertext) &&
                           $name === trim($right_names[0]->innertext))) {
       			$html = $right;
       			$row_id .= $right_prefix;
       		} else {
       			$html = $left;
       			if (count($right->find("img")) > 0) {
       				$row_id .= $left_prefix;
       			}
       		}
       	}
       	$ret["name"] = Gatherer::get_row_value($html, $row_id, "nameRow");
       	$ret["text"] = Gatherer::get_text_from_row($html, $row_id, "textRow");
       	$mana_cost = Gatherer::get_mana_cost_from_row($html, $row_id, "manaRow", $this->symbols);
       	if ($mana_cost != null) {
       		$ret["mana_cost"] = $mana_cost;
       	}
       	$converted_mana_cost = Gatherer::get_row_value($html, $row_id, "cmcRow");
       	if ($converted_mana_cost != null) {
       		$ret['converted_mana_cost'] = intval($converted_mana_cost);
       	}
       	$types = Gatherer::get_row_value($html, $row_id, "typeRow");
       	$type_matches = array();

       	preg_match("/^(.+?)(?:\s+—\s+(.+))?$/", $types, $type_matches); //it matches, no need to check
       	$types = isset($type_matches[1]) ? $type_matches[1]: null;
       	$subtypes = isset($type_matches[2]) ? $type_matches[2] : null;
       	$type_matches = preg_split("/\s+/", $types);
       	for($i = 0; $i < count($type_matches); $i++) {
       		if (in_array($type_matches[$i], $this->supertypes)) {
       			$ret["supertypes"][] = $type_matches[$i];
       		} else {
       			$ret["types"][] = $type_matches[$i];
       		}
       	}
       	if (isset($subtypes) && count($subtypes)) {
       		$ret["subtypes"] = preg_split("/\s+/", $subtypes);
       	}
       	$pt = Gatherer::get_row_value($html, $row_id, "ptRow");
       	if ($pt != null) {
       		$pt_matches = array();
       		if (preg_match("/^(.+?)\s+\/\s+(.+)$/", $pt, $pt_matches)) {
       			$ret["power"] = intval($pt_matches[1]);
       			$ret["toughness"] = intval($pt_matches[2]);
       		} else {
       			$ret["loyalty"] = intval($pt);
       		}
       	}
       	$ret["versions"] = Gatherer::get_card_sets($html, $row_id);
       	return $ret;
    }
}

class Gatherer {
    public static function get_card_sets($element, $row_id) {
        $row = $element->getElementById($row_id."otherSetsRow");
       	if ($row === null) {
       		$row = $element->getElementById($row_id."setRow");
       	}
       	$elm = $row;
           $ret = null;
       	if ($elm != null) {
       		$elm = $elm->find("div[class=value]", 0);
       		$ret = array();
       		foreach ($elm->find('img') as $img) {
       			$m = array();
       			$alt = $img->alt;
       			preg_match("/^(.*\S)\s+[(](.+)[)]$/", $alt, $m); //matches expansion text"
       			$expansion = html_entity_decode($m[1]);
       			$rarity = $m[2];
       			$version_digits = array();
       			preg_match("/\d+$/", $img->parent()->href, $version_digits);
       			$version = $version_digits[0];
       			$ret[$version] = array("expansion" => $expansion, "rarity" => $rarity);
       		}
       	}
       	return $ret;

    }

    public static function get_row_value($element, $row_id, $row_name) {
    	$element = $element->getElementById($row_id.$row_name);
    	if ($element != null) {
    		$element = $element->find("div[class=value]", 0);
    		$element = trim($element->innertext);
    	}
    	return $element;
    }

    public static function get_text_from_row($element, $row_id, $row_name) {
        $element = $element->getElementById($row_id.$row_name);
       	if ($element != null) {
       		$element = $element->find("div[class=value]", 0);
            $nodes = $element->children();
           	$node_values = array();
           	foreach($nodes as $node) {
           		$node_values[] = $node->innertext;
           	}
       		$element = trim(implode("\n\n", $node_values));
       	}
       	return $element;
    }

    public static function get_mana_cost_from_row($element, $row_id, $row_name, $symbols) {
    	$element = $element->getElementById($row_id.$row_name);
        $ret = null;
    	if ($element != null) {
    		$element = $element->find("div[class=value]", 0);
    		$ret = "";
    		foreach ($element->find('img') as $img) {
    			$m = array();
    			$alt = $img->alt;
    			if (preg_match("/^(\S+) or (\S+)$/", $alt, $m)) { //matches hybrid mana, like "2 or Red"
    				$ret.="{".static::get_mana_cost_symbol($m[1], $symbols)."/".static::get_mana_cost_symbol($m[2], $symbols)."}";
    			} else {
    				$ret.="{".static::get_mana_cost_symbol($alt, $symbols)."}";
    			}
    		}
    	}
    	return $ret;
    }

    private static function get_mana_cost_symbol($symbol, $symbols) {
        if (isset($symbols[$symbol])) {
       		return $symbols[$symbol];
       	} else {
       		return $symbol;
       	}
    }
}