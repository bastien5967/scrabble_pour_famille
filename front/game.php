<!-- game.php -->
<?php
    function magic_number($i, $j) {
        $magic_calc = 100*$i + $j;
        // var_dump($magic_calc);
        switch ($magic_calc) {
            case 101: case 108: case 115: case 801: case 815: case 1501: case 1508: case 1515:
                return "mot_triple";
                break;
            case 202: case 214: case 303: case 313: case 404: case 412: case 505: case 511: case 808: case 1105: case 1111: case 1204: case 1212: case 1303: case 1313: case 1402: case 1414:
                return "mot_double";
                break;
            case 206: case 210: case 602: case 606: case 610: case 614: case 1002: case 1006: case 1010: case 1014: case 1406: case 1410:
                return "lettre_triple";
                break;
            case 104: case 112: case 307: case 309: case 401: case 408: case 415: case 703: case 707: case 709: case 713: case 804: case 812: case 903: case 907: case 909: case 913: case 1201: case 1208: case 1215: case 1307: case 1309: case 1504: case 1512:
                return "lettre_douple";
                break;
            default:
                return "";
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <?php include 'outil/head.php'; ?>
    <title>Game</title>
    <script defer src="./script/game.js"></script>
    <body>
        <?php include 'outil/menu.php'; ?>
        <div id=error_catch></div>
        <!-- Main content -->
        <div class="plateau" id="plateau">
            <div class="plateau-table table">
                <?php for ($i = 1; $i <= 15; $i++) { ?>
                    <div class="tr">
                        <?php for ($j = 1; $j <= 15; $j++) { ?>
                            <div id="cell_<?= $i . '_' . $j ?>" class="td <?php
                            $magicnumber = magic_number($i, $j);
                            if ($magicnumber != "") {
                                ?><?= $magicnumber ?> <?php
                            } ?> plateau_cell" onclick="clickCell(this)"<?php if ($magicnumber != "") {
                                ?> title="<?= $magicnumber ?>" <?php
                            } ?>>
                            <!-- <?php var_dump($magicnumber); ?> -->
                            <!-- <span class="plateau_cell_number"><?= $i . '_' . $j ?></span> -->
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>