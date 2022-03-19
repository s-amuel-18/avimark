function validate_checks(class_selector) {
    $validate = false;
    for (let i = 0; i < class_selector.length; i++) {
        let el = class_selector[i];

        if (el.checked) {
            $validate = true;
            // return false;
        } else if ((class_selector.length == (i + 1)) && ($validate == false)) {
            $validate = false;
        }

    }

    return $validate;
}

function isNormalInteger(str) {
    var n = ~~Number(str);
    return String(n) === str && n >= 0;
}
// alert();

function count_num_max_en_arr(arr) {
    if (!arr) {
        alert("Se debe pasar un parametro en la funcion 'count_num_max_en_arr'");
        return null;
    }

    const arr_sort = [...arr];
    arr_sort.sort();

    let numero_mayor = Math.max(...arr_sort);
    let cantidad_repetido = 0;

    arr_sort.forEach(el => {
        // console.log(numero_mayor)
        if (el == numero_mayor) cantidad_repetido += 1;
    })

    return cantidad_repetido;
}