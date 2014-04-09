<?php
require_once __DIR__.'/simpletest/autorun.php';

class TestGatherer extends UnitTestCase {
    function testFireIceReturnsExpected() {
        $saved_html = file_get_contents(__DIR__.'/cards/fireice.html');
        $retrieved_html = file_get_contents('http://gatherer.wizards.com/Pages/Card/Details.aspx?multiverseid=247159');
        $this->assertEqual($saved_html, $retrieved_html, 'Gatherer changed');
    }
}