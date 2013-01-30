// For testing
for($i = 0; $i<=50; $i++) {
        $backupDate = date('Y-m-d', strtotime('2013-01-01')+86400*$i);
        echo whichTape($backupDate, 15);
}
 
/**
 * For towers of hanoi for backup strategies
 */
function whichTape($backupDate, $tapeCount) {
        static $oneRotation;
        if(!isset($oneRotation)) { $oneRotation = array(); }
        if(!isset($oneRotation[$tapeCount])) {
                $oneRotation[$tapeCount] = getHanoi($tapeCount);
        }
        $days = round(strtotime($backupDate)/86400);
        $index = $days % count($oneRotation[$tapeCount]);
        return $oneRotation[$tapeCount][$index];
}
 
function getHanoi($elements=4) {
        // init
        $stacks = array();
        for($i=0; $i<pow(2,$elements); $i++) {
                $stacks[$i] = null;
        }
 
        // fill algorithm
        for($i=0; $i<$elements; $i++) {
                // counter for free places found
                $free = 0;
                // find first free place
                for($j=0; $j<count($stacks); $j++) {
                        if($stacks[$j] === null) {
                                $free++;
                                // fill if applies
                                $every_2nd_gap = $free % 2 === 1;
                                $last_element = $i == $elements-1;
                                $name = chr(65+$i);
                                if($every_2nd_gap) { $stacks[$j] = $name; }
                                if($last_element) { $stacks[$j] = $name; }
                        }
                }
        }
        return $stacks;
}
