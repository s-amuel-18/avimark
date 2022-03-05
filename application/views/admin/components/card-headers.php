<?php foreach ($items as $item) : ?>
    <div class="col-md-3">
        <div class="card card-outline card-<?php echo $item["color"] ?>">
            <div class="card-header">
                <h3 class="card-title">
                    <?php echo $item["titulo"] ?>: <b><?php echo $item["cantidad"] ?></b>
                </h3>
                
                <!-- en caso de tener un reporte -->
                <?php if (false) : ?>

                    <div class="card-tools">
                        <a href="<?php echo $item["url_reporte"]?>" class="btn btn-tool"><i class="fas fa-table"></i></a>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach ?>