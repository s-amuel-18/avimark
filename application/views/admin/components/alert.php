        <!-- alerta -->
        <?php if (isset($_SESSION["message"])) : ?>
            <div class="alert alert-<?php echo $_SESSION["message"]["color"] ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION["message"]["message"] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>