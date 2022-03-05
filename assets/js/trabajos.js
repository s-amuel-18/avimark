const insert_trabajo_detalle = document.getElementById("insert_trabajo_detalle");
const load_trabajo_detalle = document.getElementById("load_trabajo_detalle")

const insert_trabajo_update = document.getElementById("insert_trabajo_update");
const load_trabajo_update = document.getElementById("load_trabajo_update")

$('#view_datos').on('show.bs.modal', function (e) {
    insert_template_in_modal(
        e,
        site_url + "admin/trabajos/detalle/",
        load_trabajo_detalle,
        insert_trabajo_detalle,
    )    
});

$('#view_form_update').on('show.bs.modal', function (e) {
    insert_template_in_modal(
        e,
        site_url + "admin/trabajos/form_update/",
        load_trabajo_update,
        insert_trabajo_update,
    )    
});

$('#view_datos').on('hidden.bs.modal', function (e) {
    añadir_loader_map(load_trabajo_detalle);
    insert_trabajo_detalle.innerHTML = "";
});



const button_delete_pagina = document.querySelectorAll(".btn_delete_pagina");

for (let i = 0; i < button_delete_pagina.length; i++) {
  const boton = button_delete_pagina[i];
  boton.addEventListener("click", e => {
    // console.log(e.currentTarget);return;
    deleteElement(
      e,
      site_url + "admin/trabajos/delete/paginas_trabajos",
      "pagina",
      "insert_pagina"
    );
  });
}

const button_update_pagina = document.querySelectorAll(".btn_update_pagina");
const url_get_pagina = site_url + "admin/trabajos/pagina/";

for (let i = 0; i < button_update_pagina.length; i++) {
  const boton = button_update_pagina[i];
  boton.addEventListener("click", async e => {
    const id = e.currentTarget.dataset.id;
    
    const data_update_await = await axios.get(url_get_pagina + id)
      .then(resp => {
        const data = resp.data;
        return data;
      })
    
      const data_update = await data_update_await.pagina;
      
      
    update_element(
      {
        form_id: "#form_pagina_nueva",
        inputs: {
          url_nueva_pagina: data_update.url,
          id: data_update.id,
          nombre: data_update.nombre
        }
      }
    );
    // $('#collapseTwo').collapse("hide")
    $('#collapseOne').collapse("show")
  });
}

$('#collapseOne').on('show.bs.collapse', function () {
  const form_pagina_nueva = document.getElementById("form_pagina_nueva")
  form_pagina_nueva.reset();
})

