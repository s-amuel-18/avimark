<div id="tata-bs-modal" class="modal fade text-white" tabindex="-1" role="dialog" aria-labelledby="Tasa Bolivar" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="Tasa Bolivar">Tasa Bolivar</h5>
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_tasa_bolivar" action="<?php echo site_url("admin/tasa_bolivares/actualizar") ?>" method="POST">
					<!-- tasa de bolivares -->
					<div class="form-group">
						<label for="tasa">Tasa Del Bolivar</label>
						<input id="tasa" class="form-control" min="0" type="number" name="tasa" placeholder="Tasa Del Bolivar">
					</div>
					<!-- tasa de bolivares end -->

					<div class="d-flex justify-content-end">
						<button class="btn btn-primary btn-sm" type="submit">Registrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
