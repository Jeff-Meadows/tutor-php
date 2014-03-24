<?php
require_once __DIR__.'/simpletest/autorun.php';
require_once __DIR__.'/../src/tutor.php';

abstract class TestTutor extends UnitTestCase {

	function setUp() {
		$this->cards = array(
			'Jace' => json_decode(file_get_contents(__DIR__.'/cards/jace.json')),
			'Fire // Ice' => json_decode(file_get_contents(__DIR__.'/cards/fireice.json')),
			'Erayo' => json_decode(file_get_contents(__DIR__.'/cards/erayo.json')),
			'Island' => json_decode(file_get_contents(__DIR__.'/cards/island.json')),
			'Huntmaster of the Fells' => json_decode(file_get_contents(__DIR__.'/cards/huntmaster.json')),
			'Ravager of the Fells' => json_decode(file_get_contents(__DIR__.'/cards/ravager.json')),
			'Deathrite Shaman' => json_decode(file_get_contents(__DIR__.'/cards/deathrite.json')),
		);
        $this->tutor = new Tutor();
	}

	protected function multiverse_version_test($card, $cardname, $versions) {
		foreach($versions as $version_number => $version) {
			$this->assertTrue($this->versions_equal($card->versions->$version_number, $version), 'Saved version info for '.$cardname.' - '.$version_number.': '.$card->versions->$version_number->expansion.' '.$card->versions->$version_number->rarity.' is equal to retrieved version: '.$version['expansion'].' '.$version['rarity']);
		}
	}

    protected function assertPropertiesEqual($a, $b, $msg) {
        if (is_array($a)) {
            $a = implode(', ', $a);
        }
        if (is_array($b)) {
            $b = implode(', ', $b);
        }
        $this->assertTrue($a === $b, sprintf($msg, $a, $b));
    }

	protected function get_gatherer_id($gurl, $parts = false) {
		preg_match('/.*?(\d+)(&part=(.*))?$/', $gurl, $matches);
		$m = array_slice($matches, 1);
		return (count($m) == 1 || $parts === false) ? $matches[1] : $m;
	}
	
	protected function versions_equal($a, $b) {
		return $a->expansion === $b['expansion'] && $a->rarity === $b['rarity'];
	}
}
