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

// alert();