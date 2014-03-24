<?php
require_once __DIR__.'/simpletest/autorun.php';

class TutorTests extends TestSuite {
	function __construct() {
        parent::__construct();
		$this->TestSuite('Tutor-PHP Tests');
		$this->addFile(__DIR__.'/test-tutor-legalities.php');
        $this->addFile(__DIR__.'/test-tutor-misc.php');
        $this->addFile(__DIR__.'/test-tutor-multiverse.php');
        $this->addFile(__DIR__.'/test-tutor-name.php');
	}
}
