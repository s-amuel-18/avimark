$(function() {

    $(".check_categoria").on("change", (e) => {
        $checkbox = e.target;
        $id = e.target.dataset.id;
        $nombre = e.target.dataset.nombre;
        $precio_total = e.target.dataset.precio_total;
        let sin_itmes = document.getElementById("element_sin_items_categorias")
        let tfoot_total = document.getElementById("tfoot_total")
            // alert();

        if ($checkbox.checked) {
            sin_itmes.classList.add("d-none");
            // let sin_itmes = document.getElementById("element_sin_items_categorias")
            tfoot_total.classList.add("d-table-row");

            insertar_template({ id: $id, nombre: $nombre, precio_total: $precio_total });
            // alert();
        } else {
            remover_item($id, $nombre);
            if ($arr_categorias.length < 1) {
                tfoot_total.classList.remove("d-table-row");
                sin_itmes.classList.remove("d-none");
            }
        }
    })
})