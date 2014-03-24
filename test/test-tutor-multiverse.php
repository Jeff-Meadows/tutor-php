<?php
require_once __DIR__.'/simpletest/autorun.php';
require_once __DIR__ . '/test-tutor.php';

class TestTutorMultiverse extends TestTutor {
	/*
	 * For each sample card, get tutor.multiverse for that card.  Ensure that each retrieved value matches the saved values (eg loyalty, p/t, name, cmc)
	 * Versions are special because they are nested.
	 * Multi-part cards are also special as they have a "part" attribute
	 */
	function testMultiverseForSampleCards() {
		foreach($this->cards as $cardname => $cardobj) {
			$this->multiverse_test($cardname, $cardobj);
		}
	}

    function testMultiverseWithInvalidInput() {
        $cardid = null;
        $multiverse = $this->tutor->get_card_by_multiverse($cardid);
   		$mname = isset($multiverse['name']) ? $multiverse-> name : "";
   		$this->assertFalse(isset($multiverse['name']), "Expected null for invalid input to tutor.multiverse, but got $mname instead.");
   	}

	private function multiverse_test($cardname, $cardobj) {
		$gurl = isset($cardobj->gatherer_url) ? $cardobj->gatherer_url : $cardobj->parts[0]->gatherer_url;
		$cardid = $this->get_gatherer_id($gurl, true);
/*		if (is_array($cardid)) {
			$_REQUEST['card'] = $cardid[0];
			$_REQUEST['part'] = $cardid[1];
		} else $_REQUEST['card'] = $cardid;
*/
        $multiverse = $this->tutor->get_card_by_multiverse($cardid);
		foreach($multiverse as $property => $value) {
			if ($property !== 'legalities') {
				if ($property === 'versions') {
					$this->multiverse_version_test($cardobj, $cardname, $value);
				} elseif ($property === 'parts') {
					$parts = $value;
					for ($i = 0; $i < count($parts); $i++) {
						$cardpart = $cardobj->parts[$i];
						$retrievedpart = $parts[$i];
						foreach($retrievedpart as $part_property => $part_value) {
							if ($part_property === 'versions') $this->multiverse_version_test($cardpart, $cardname, $part_value);
                            else $this->assertPropertiesEqual($cardpart->$part_property, $part_value, 'Saved value for '.$cardname.' - parts[' . $i .'] - '.$part_property.': %s is equal to retrieved value: %s');
						}
					}
				} else {
                    $this->assertPropertiesEqual($cardobj->$property, $value, 'Saved value for '.$cardname.' - '.$property.': %s is equal to retrieved value: %s');
			    }
            }
		}
	}
}
