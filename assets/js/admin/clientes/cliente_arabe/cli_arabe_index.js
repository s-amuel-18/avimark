// alert();
$(function () {
	$(".datatable").DataTable();
	const input_reporte_check = document.querySelectorAll(".input_reporte_check");
	// const form_reportes_select = document.getElementById(".form_reportes_select");
	const submit_button_reportes_select = document.getElementById("submit_button_reportes_select");

	$(".input_reporte_check").on("change", e => {

		let check = 0;

		Array.from(input_reporte_check).forEach(el => {
			check += el.checked == true ? 1 : 0;
		});

		if (check > 0) {
			submit_button_reportes_select.disabled = false;
		} else {
			submit_button_reportes_select.disabled = true;

		}

	})



});
