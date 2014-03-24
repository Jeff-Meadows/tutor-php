<?php
require_once __DIR__.'/simpletest/autorun.php';
require_once __DIR__ . '/test-tutor.php';

class TestTutorName extends TestTutor {
	/*
	 * For each sample card, get tutor.name for that card.  Ensure that each retrieved value matches the saved values (eg loyalty, p/t, name, cmc)
	 * Versions are special because they are nested.
	 * Multi-part cards are also special as they have a "part" attribute
	 */
	function testNameForSampleCards() {
		foreach($this->cards as $cardname => $cardobj) {
			if (isset($cardobj->parts)) {
				foreach ($cardobj->parts as $part) {
					$this->name_test($cardname, $part);
				}
			} else $this->name_test($cardname, $cardobj);
		}
	}
	private function name_test($cardname, $cardobj) {
        $multiverse = $this->tutor->get_card_by_name($cardobj->name);
		foreach($multiverse as $property => $value) {
			if ($property !== 'legalities' && strpos($property, "_url") === false) {
				if ($property === 'versions') {
					foreach($value as $version_number => $version) {
						$this->assertTrue($this->versions_equal($cardobj->versions->$version_number, $version), 'Saved version info for '.$cardname.' - '.$version_number.': '.$cardobj->versions->$version_number->expansion.' '.$cardobj->versions->$version_number->rarity.' is equal to retrieved version: '.$version['expansion'].' '.$version['rarity']);
					}
				} else
                    $this->assertPropertiesEqual($cardobj->$property, $value, 'Saved value for '.$cardname.' - '.$property.': %s is equal to retrieved value: %s');
			}
		}
	}
}
