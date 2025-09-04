<?php

// cek step
$step = isset($_POST['step']) ? (int)$_POST['step'] : 1;

// step 1
if ($step === 1) {
?>
    <form method="post">
        <label>Inputkan Jumlah Baris:</label>
        <input type="number" name="rows" min="1" required> Contoh: 1
        <br><br>
        <label>Inputkan Jumlah Kolom:</label>
        <input type="number" name="cols" min="1" required> Contoh: 3
        <br><br>
        <input type="hidden" name="step" value="2">
        <button type="submit">SUBMIT</button>
    </form>
<?php
}

// step 2
if ($step === 2) {
    $rows = (int)$_POST['rows'];    
    $cols = (int)$_POST['cols'];    
?>
    <form method="post">
        <?php
        for ($i = 1; $i <= $rows; $i++) {
            for ($j = 1; $j <= $cols; $j++) {
                echo "$i.$j: <input type='text' name='data[$i][$j]'> ";
            }
            echo "<br><br>";
        }
        ?>
        <input type="hidden" name="rows" value="<?= $rows ?>">
        <input type="hidden" name="cols" value="<?= $cols ?>">
        <input type="hidden" name="step" value="3">
        <button type="submit">SUBMIT</button>
    </form>
<?php
}

?>