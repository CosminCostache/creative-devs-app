<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row mx-auto">
    <div class="col-md-3">
        <div class="card card-body bg-light mt-5">
            <h2>Jucatori:</h2>
            <ul>
                <li><?= $data['jucatori']; ?></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-body bg-light mt-5">
            <h2>Fazan</h2>
            <p>Ultimul cuvant: <?php echo $data['cuvant']; ?></p>
            <form action="<?php echo URLROOT; ?>/games/fazan" method="post">
                <p>
                    <input type="submit" name="start_btn" value="Start Joc!" class="btn btn-success">
                    <?php if (array_key_exists('start_btn', $_POST)) : ?>
                    <span class="ml-1">Cuvantul incepe cu litera: <?php echo $data['random_letter']; ?></span>
                    <?php elseif (array_key_exists('submit', $_POST)) : ?>
                    <span class="ml-1">Cuvantul incepe cu litera: </span>
                    <?php endif; ?>
                </p>
                <div class="form-group">
                    <label for="text">Introduce Cuvant nou care incepe cu urmatoarele litere: </label>
                    <input type="text" name="cuvant"
                        class="form-control form-control-lg <?php echo (!empty($data['cuvant_err'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo (array_key_exists('start_btn', $_POST)) ? $data['random_letter'] : $data['last2letters']; ?>">
                    <span class="invalid-feedback"><?php echo $data['cuvant_err']; ?></span>


                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" name="submit" value="Submit" class="btn btn-danger btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-body bg-light mt-5">
            <h2>Scor:</h2>
            <ul>
                <li><?php echo $_SESSION['user_name']; ?>: <?php echo $data['scor']; ?></li>
            </ul>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>