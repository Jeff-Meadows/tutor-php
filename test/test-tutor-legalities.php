<?php
require_once __DIR__.'/simpletest/autorun.php';
require_once __DIR__ . '/test-tutor.php';

class TestTutorLegalities extends TestTutor {
	/*
	 * For each sample card, get tutor.legalities for that card.  Ensure that each retrieved legality matches the saved legalities for that sample card.
	 */
	function testLegalitiesForSampleCards() {
		foreach($this->cards as $cardname => $card) {
			$url = isset($card->parts) ? $card->parts[0]->gatherer_url : $card->gatherer_url;
			$cardid = $this->get_gatherer_id($url);
            $legalities = $this->tutor->get_card_legalities($cardid);
			foreach($legalities as $format => $legality) {
				$this->assertTrue($card->legalities->$format === $legality, 'Saved legality for '.$cardname.'('.$cardid.') in '.$format.': '.$card->legalities->$format.' is equal to retrieved legality: '.$legality);
			}
		}
	}
}
