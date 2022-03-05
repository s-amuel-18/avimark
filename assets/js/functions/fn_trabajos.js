function remover_loader_map(preload_map) {
    preload_map.classList.remove("d-flex");
    preload_map.classList.add("d-none");
}

function añadir_loader_map(preload_map) {
    preload_map.classList.add("d-flex");
    preload_map.classList.remove("d-none");
}

function insert_template_in_modal(e, url, loader, insert) {
    const btn_target = e.relatedTarget;
    const id = btn_target.dataset.id;
    const url_de = url + id;
    axios.get(url_de)
    .then(resp => {
        const html = resp.data;
        remover_loader_map(loader)

        insert.innerHTML = html
    });
}