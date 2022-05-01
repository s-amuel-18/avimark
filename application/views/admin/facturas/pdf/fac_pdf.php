<?php

$date = new DateTime();

$fechas_actual = date_format($date, "d/m/Y");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="<?php echo base_url("assets/plugins/bootstrap/css/bootstrap.min.css") ?>">

	<style>
		*,
		h1 {
			font-family: sans-serif;
		}

		@page {
			margin: 0px;
			padding: 0;
		}

		.bg-gray-light {
			background: #eeeeee;
		}

		.head {
			/* height: 1056px; */
		}

		.img-foot {
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
		}

		.title-1 {
			font-size: 45px;
			font-weight: 700;
		}

		.title-3 {
			font-size: 20px;
			font-weight: 700;
		}

		.text-orange {
			color: #EF881E;
		}

		.bg-orange {
			background: #EF881E;
		}

		* {
			font-size: 14px !important;
		}
	</style>

</head>

<body>
	<div class="head">
		<img class="w-100" src="<?php echo base_url("assets/factura-assets/head.png") ?>" alt="">

		<div class="px-4">

			<table class="w-100">
				<tbody>
					<tr>
						<td class="w-50 pb-2">
							<p class="title-3 mb-1 text-orange" style="font-size: 158x;">
								JOB
							</p>
							<p class="mb-0">
								<?php echo $factura->servicio_trabajo ?>
							</p>
						</td>

						<td class="w-50 text-right pb-2">
							<p class="mb-0">Invoice No: <strong>FAC<?php echo $factura->numero_factura ?></strong></p>
							<p class="mb-0">Invoice Date: <strong><?php echo $fechas_actual ?></strong></p>
						</td>
					</tr>

					<tr>

						<td class="w-50">
							<p class="m-0"><strong>NAME</strong>: <?php echo $factura->nombre_empresa ?></p>
							<p class="m-0"><strong>ADRESS</strong>: <?php echo $factura->direccion_empresa ?></p>
							<p class="m-0"><strong>PHONE</strong>: <?php echo $factura->telefono_empresa ?></p>
						</td>

						<td class="w-50">
							<div style="font-size: 18px;" class="title-3 text-orange text-right">
								DATA
							</div>
							<p class="m-0 text-right"><strong>CLIENT</strong>: <?php echo $factura->nombre_cliente ?></p>
							<p class="m-0 text-right"><strong>PAYMENT TERMS</strong>: Payment for <?php echo $factura->nombre_cartera ?></p>
							<p class="m-0 text-right"><strong>to the email</strong>: <?php echo $factura->email_cartera ?></p>
						</td>

					</tr>
				</tbody>
			</table>

		</div>

		<div class="mt-4">

			<table class="text-capitalize table table-striped">
				<thead class="">
					<tr>
						<th class="text-light bg-orange">#</th>
						<th class="text-light bg-orange">Product Description</th>
						<th class="text-light bg-orange">Price</th>
						<th class="text-light bg-orange">Qty</th>
						<th class="text-light bg-orange">Total</th>
					</tr>
				</thead>

				<tbody>

					<?php foreach ($servicios as $key => $servicio) : ?>
						<tr>
							<td><?php echo $key + 1  ?></td>
							<td><?php echo isset($servicio->nombre_categoria) ?  $servicio->nombre_categoria : "" ?></td>
							<td><?php echo isset($servicio->precio)  ? "$" . number_format($servicio->precio, 2) : "" ?></td>
							<td><?php echo isset($servicio->cantidad) ?  $servicio->cantidad : "" ?></td>
							<td><?php echo isset($servicio->total) ? "$" . number_format($servicio->total, 2) : "" ?></td>
						</tr>
					<?php endforeach ?>



					<tr>
						<td></td>
						<td>

							<!-- <img widtd="40px" src="<?php echo base_url("assets/admin-lte/img/credit/paypal.png") ?>" alt=""> -->
						</td>
						<td></td>
						<td>Subtotal</td>
						<td>$<?php echo number_format($servicios_total->total_pago, 2) ?></td>
					</tr>

					<?php if ($impuesto or $impuesto == 0) : ?>
						<tr>
							<td></td>
							<td>
							</td>
							<td></td>
							<td>Tax <?php echo $factura->nombre_cartera ?></td>
							<td>$<?php echo number_format($impuesto, 2) ?></td>
						</tr>

					<?php endif ?>


					<?php if (isset($_SESSION["servicio_extre"])) : ?>

						<?php foreach ($_SESSION["servicio_extre"]["servicios"] as $serv_extr) : ?>

							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td><?php echo $serv_extr["servicio"] ?></td>
								<td>$<?php echo number_format($serv_extr["precio"], 2) ?></td>
							</tr>

						<?php endforeach ?>

					<?php endif ?>

				</tbody>

				<tfoot>



					<tr>
						<td>
							</th>
						<th></th>
						<th></th>
						<th class="bg-gray-light">Total</th>
						<th class="bg-gray-light">$<?php echo number_format($servicios_total->total_pago + $impuesto + (isset($_SESSION["servicio_extre"]["suma_total"]) ? $_SESSION["servicio_extre"]["suma_total"] : 0), 2) ?></th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- <p>dsadsadsa</p> -->

		<!-- <img class="w-100 " height="200px" src="<?php echo base_url("assets/factura-assets/foot.png") ?>" alt=""> -->
	</div>

</body>

</html>

<?php 

if( isset($_SESSION["servicio_extre"]) ) {
	unset( $_SESSION["servicio_extre"] );
}

?>
