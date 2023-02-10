<?php

namespace App;

class GenerateLoadout
{
    public function generate(): string
    {
        $buy = [];
        $array = [0, 1, 2, 3];
        shuffle($array);
        $pistol = [0, 'elite', 'p250', 'fn57', 'deagle'];
        $primary = [0, 1, 2, 3];
        $rifle = ['famas', 'm4a1', 'ssg08', 'aug', 'awp', 'scar20'];
        $heavy = ['nova', 'xm1014', 'mag7', 'm249', 'negev'];
        $smg = ['mp9', 'mp7', 'ump45', 'p90', 'bizon'];
        $equipment = ['vest', 'vesthelm', 'taser', 'defuser'];
        $grenades = ['incgrenade', 'decoy', 'flashbang', 'hegrenade', 'smokegrenade'];

        foreach ($array as $item) {
            switch ($item) {
                case 0:
                    shuffle($pistol);
                    $item = $pistol[0];
                    break;
                case 1:
                    shuffle($primary);
                    switch ($primary[0]) {
                        case 0:
                            break;
                        case 1:
                            shuffle($rifle);
                            $item = $rifle[0];
                            break;
                        case 2:
                            shuffle($heavy);
                            $item = $heavy[0];
                            break;
                        case 3:
                            shuffle($smg);
                            $item = $smg[0];
                            break;
                    }
                    break;
                case 2:
                    $count = random_int(0, 5);
                    shuffle($grenades);
                    $item = array_slice($grenades, 0, $count);
                    break;
                case 3:
                    $count = random_int(0, 4);
                    shuffle($equipment);
                    $item = array_slice($equipment, 0, $count);
                    break;
            }
            if (is_array($item)) {
                foreach ($item as $i) {
                    array_push($buy, $i);
                }
            } else {
                array_push($buy, $item);
            }
        }
        $buyscript = $this->buyScript($buy);
        return $buyscript;
    }

    public function buyScript(array $items): string
    {
        $path = '/Users/gg/Library/Application Support/Steam/userdata/181533909/730/local/cfg/buy.cfg';

        $items = array_diff($items, array(0, 1, 2, 3, 4));
        $buyScript = 'bind "B" "buy '.implode('; buy ', $items).';"';
        file_put_contents($path, $buyScript);
        return $buyScript;
    }
}
