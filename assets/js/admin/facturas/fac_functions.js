function insert_template_item(data_obj) {
    // console.log(data_obj);

    $template = `
  <tr data-id="${data_obj.id}" class="alert fade show" id="categoria_select_${data_obj.id}">
    <td>
      ${data_obj.nombre}
    </td>
    <td>
      <div class="form-group m-0">
        <input step="any" value="1" data-id="${data_obj.id}" placeholder="Cantidad" class="form-control cantidad_sercios_inputs" type="number" name="cantidad_servicios[${data_obj.id}]" min="0">
      </div>
    </td>
    <td>
      <div class="input-group m-0">
        <div class="input-group-prepend">
          <span class="input-group-text">$</span>
        </div>
        <input required value="${data_obj.precio_total}" id="precio_${data_obj.id}" placeholder="$...." class="form-control input_cantidad_categoria" type="number" min="0" name="precio[${data_obj.id}]">
      </div>
    </td>
    <td>
      <div class="input-group m-0">
        <div class="input-group-prepend">
          <span class="input-group-text">$</span>
        </div>
        <input disabled id="total_precio_${data_obj.id}" value="0" placeholder="$...." class="form-control" style="background: #4d4d4d;" type="number" min="0">
      </div>

    </td>
    <td>
     <!-- <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button> -->
    </td>
  </tr>
  `;

    return $template;
}

function insertar_template(obj_data = null) {

    $obj_data = obj_data;

    $arr_categorias.push($obj_data);
    $template = insert_template_item($obj_data);
    $insert_categorias.innerHTML += $template;

    count_cantidad_inputs("input_cantidad_categoria", "input_total")
    count_cantidad_inputs("cantidad_sercios_inputs", "cantidad_servicio_total")
    multiplicar_precio_por_cantidad("cantidad_sercios_inputs", "input_total_precios_all")
    $('.alert').on('closed.bs.alert', function(e) {
        $id = e.target.dataset.id;
        $check = document.getElementById("check_categoria_" + $id);
        if ($id && $check) {
            let sin_itmes = document.getElementById("element_sin_items_categorias")
            let tfoot_total = document.getElementById("tfoot_total")
            $check.checked = false;

            $arr_categorias = $arr_categorias.filter(el => el.id != $id)

            if ($arr_categorias.length < 1) {

                tfoot_total.classList.remove("d-table-row");
                sin_itmes.classList.remove("d-table-row");
            }

        }
        count_cantidad_inputs("input_cantidad_categoria", "input_total")
        count_cantidad_inputs("cantidad_sercios_inputs", "cantidad_servicio_total")
        multiplicar_precio_por_cantidad("cantidad_sercios_inputs", "input_total_precios_all")
    })

    $(".input_cantidad_categoria").on("keyup", (e) => {
        count_cantidad_inputs("input_cantidad_categoria", "input_total");
        count_cantidad_inputs("cantidad_sercios_inputs", "cantidad_servicio_total");
        multiplicar_precio_por_cantidad("cantidad_sercios_inputs", "input_total_precios_all");
    })

    $(".input_cantidad_categoria").on("change", (e) => {
        count_cantidad_inputs("input_cantidad_categoria", "input_total");
        count_cantidad_inputs("cantidad_sercios_inputs", "cantidad_servicio_total");
        multiplicar_precio_por_cantidad("cantidad_sercios_inputs", "input_total_precios_all");
    })

    $(".cantidad_sercios_inputs").on("keyup", (e) => {

        count_cantidad_inputs("input_cantidad_categoria", "input_total");
        count_cantidad_inputs("cantidad_sercios_inputs", "cantidad_servicio_total");
        multiplicar_precio_por_cantidad("cantidad_sercios_inputs", "input_total_precios_all");
    })

    $(".cantidad_sercios_inputs").on("change", (e) => {


        count_cantidad_inputs("input_cantidad_categoria", "input_total");
        count_cantidad_inputs("cantidad_sercios_inputs", "cantidad_servicio_total");
        multiplicar_precio_por_cantidad("cantidad_sercios_inputs", "input_total_precios_all");
    })
}

function remover_item(id, nombre) {
    $item_element = document.getElementById("categoria_select_" + id);

    if ($item_element) {
        $item_element.parentElement.removeChild($item_element);
    } else {
        alert("El elemento no existe");
    }

    $arr_categorias = $arr_categorias.filter(el => el.id != id);
    count_cantidad_inputs("input_cantidad_categoria", "input_total");
    count_cantidad_inputs("cantidad_sercios_inputs", "cantidad_servicio_total");
    multiplicar_precio_por_cantidad("cantidad_sercios_inputs", "input_total_precios_all");

}

function count_cantidad_inputs(elements_input, element_total_input) {
    $inputs = document.querySelectorAll("." + elements_input);
    $input_total = document.getElementById(element_total_input);

    $result = 0;

    for (let i = 0; i < $inputs.length; i++) {
        $inputs[i].setAttribute("value", $inputs[i].value);
        $result += Number($inputs[i].value);
    }

    $input_total.value = $result;

}


function multiplicar_precio_por_cantidad(cantidad_element, precio_total_element) {
    $camtidades = document.querySelectorAll("." + cantidad_element);
    $precio_total = document.getElementById(precio_total_element);

    $total = 0;

    Array.from($camtidades).forEach(el => {
        $id = el.dataset.id;
        $cantidad_por_id = Number(el.value);
        $precio_por_id = Number(document.getElementById("precio_" + $id).value);
        $total_precio_por_id = document.getElementById("total_precio_" + $id);

        $multiplicacion = ($cantidad_por_id * $precio_por_id);
        $total_precio_por_id.value = $multiplicacion;

        $total += $multiplicacion;

    })

    $precio_total.setAttribute("value", $total);
}

$("#form_nueva_factura").on("submit", (e) => {
    $cantidad_select = document.querySelectorAll(".cantidad_sercios_inputs");

    Array.from($cantidad_select).forEach(el => {
        if (!esEntero(Number(el.value))) {


            e.preventDefault();
            Swal.fire(
                'Alerta',
                "La cantidad que se ingresa en el modulo de categorias NO puede tener numeros decimales.",
                'warning'
            )
        }
    });

    if ($arr_categorias.length < 1) {
        let cheks_categorias = document.querySelectorAll(".check_categoria");

        $check_valid = 0;

        Array.from(cheks_categorias).forEach(el => {
                if (el.checked) {
                    $check_valid += 1;
                }
            })
            // console.log($check_valid)
        if ($check_valid < 1) {
            e.preventDefault();

            // alert();

            Swal.fire(
                'Alerta',
                "Debes seleccionar como minimo un servicio cotizable.",
                'warning'
            )

        }


    } else {

        // e.currentTarget[e.currentTarget.length - 1].disabled = true;
    }

})

// alert();