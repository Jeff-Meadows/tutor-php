<?php
require_once __DIR__.'/simpletest/autorun.php';
require_once __DIR__ . '/test-tutor.php';

class TestTutorMisc extends TestTutor {
	/*
	 * Assert that tutor.sets contains "Alara Reborn" (implicitly tests that tutor.sets returns an array)
	 */
	function testSetsContainsAlaraReborn() {
		$sets = $this->tutor->get_sets();
		$this->assertTrue(in_array("Alara Reborn", $sets), 'Sets contains Alara Reborn.');
	}
	/*
	 * Assert that tutor.setAbbreviations contains "Alara Reborn" => "ARB" (implicitly tests that tutor.setAbbreviations returns an array)
	 */
	function testSetsAbbreviationsContainsAlaraRebornARB() {
		$abbr = $this->tutor->get_set_abbreviations();
		$this->assertTrue(array_key_exists("Alara Reborn", $abbr), 'Abbreviation array contains Alara Reborn.');
		$this->assertTrue($abbr["Alara Reborn"] === "ARB", 'Abbreviation of Alara Reborn is ARB.');
	}
	/*
	 * For each set in tutor.sets, ensure that tutor.setAbbreviations contains that set.
	 */
	function testSetsAbbreviationsCoverSets() {
        $abbr = $this->tutor->get_set_abbreviations();
        $sets = $this->tutor->get_sets();
		foreach ($sets as $set) {
			$this->assertTrue(array_key_exists($set, $abbr), 'Abbreviation array contains key '.$set);
		}
	}
	/*
	 * Assert that tutor.formats contains "Classic" (implicitly tests that tutor.formats returns an array)
	 */
	function testFormatsContainsClassic() {
		$formats = $this->tutor->get_formats();
		$this->assertTrue(in_array("Classic", $formats), 'Formats contains Classic.'.$formats[0]);
	}
}
