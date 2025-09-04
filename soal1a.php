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

?>