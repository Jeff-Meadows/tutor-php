<?php
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