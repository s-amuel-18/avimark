     <!-- Content Header (Page header) -->
     <section class="content-header">
       <div class="container-fluid">
         <div class="row mb-2">
           <div class="col-sm-6">
             <h1>Administrador De Facturas</h1>
           </div>
           <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?php echo site_url("admin_dashboard") ?>">Home</a></li>
               <li class="breadcrumb-item active">Administrador De Facturas</li>
             </ol>
           </div>
         </div>
       </div><!-- /.container-fluid -->
     </section>

     <!-- Main content -->
     <section class="content">

       <!-- Default box -->
       <div class="card">
         <div class="card-header">
           <h3 class="card-title">facturas</h3>

           <div class="card-tools">
             <a class="btn btn-primary btn-sm" href="<?php echo site_url("admin_facturas/vista_crear") ?>">Nueva factura</a>
           </div>
         </div>
         <div class="card-body">
           <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>',  ' *</div>') ?>

           <?php $this->load->view("admin/components/alert"); ?>


           <!-- tabla de facturas -->
           <table class="table table_data_tr table-striped table-valign-middle">
             <thead class="">
               <tr>
                 <th>#</th>
                 <th>ID</th>
                 <th>Usuario</th>
                 <th>Nombre Servicio</th>
                 <th>Cliente</th>
                 <th>Metodo De Pago</th>
                 <th>ultima Modificacion</th>
                 <th>Creado</th>
                 <th>Acciones</th>
               </tr>
             </thead>
             <tbody>

               <?php foreach ($facturas as $i => $factura) : ?>

                 <tr>

                   <td>
                     <?php if (!$factura->id_cliente or $factura->cantidad_categorias == 0) : ?>
                       <i class="text-warning icon fas fa-exclamation-triangle"></i>
                     <?php else : ?>
                       <?php echo $i + 1 ?>
                     <?php endif ?>

                   </td>
                   <td><?php echo $factura->id ?></td>
                   <td>
                     <img src="<?php echo base_url($factura->foto_usuario) ?>" alt="Product 1" class="img-circle img-size-32 mr-2">
                     <?php echo $factura->nombre_usuario ?>
                   </td>
                   <td><?php echo $factura->servicio_trabajo ?></td>
                   <td>
                     <?php if (!$factura->id_cliente) : ?>
                       <div data-toggle="tooltip" title="Debes actualizar la plantilla con un nuevo cliente">
                         <i class="text-warning icon fas fa-exclamation-triangle"></i> El cliente fue eliminado

                       </div>
                     <?php else : ?>
                       <?php echo $factura->nombre_cliente ?>

                     <?php endif ?>
                   </td>
                   <td><?php echo $factura->nombre_cartera ?></td>
                   <!-- <td><?php echo $factura->email ?></td> -->
                   <td><?php echo $factura->updated_at ?></td>
                   <td><?php echo $factura->fac_created_at ?></td>
                   <td>

                     <form onsubmit="return confirm('¿Realmente deseas eliminar esta plantilla de factura?')" action="<?php echo site_url("admin/facturas/eliminar") ?>" method="POST">

                       <input type="hidden" value="<?php echo $factura->id ?>" name="id">

                       <!-- <?php if (!$factura->id_cliente) : ?>
                         <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Debes actualizar la plantilla con un nuevo cliente">
                           <button class="btn btn-info btn-sm" style="pointer-events: none;" type="button" disabled>
                             <i class="fas fa-file-pdf"></i>
                           </button>
                         </span>
                       <?php elseif ($factura->cantidad_categorias == 0) : ?>
                         <span class="d-inline-block" tabindex="1" data-toggle="tooltip" title="Se han eliminado todos los servicios de esta plantilla, actualiza la plantilla.">
                           <button class="btn btn-info btn-sm" style="pointer-events: none;" type="button" disabled>
                             <i class="fas fa-file-pdf"></i>
                           </button>
                         </span>
                       <?php else : ?>

                        
                        
                        <?php endif ?> -->
                        
                        <a onclick="return confirm('¿Deseas crear una nueva factura?')" href="<?php echo site_url("admin_facturas/ver_factura_plantilla/{$factura->id}") ?>" class="btn btn-info btn-sm">
                          <i class="fas fa-file-pdf"></i>
                        </a>

                       <a href="<?php echo site_url("admin_facturas/vista_actualizar/{$factura->id}") ?>" class="btn btn-warning btn-sm">
                         <i class="fas fa-edit"></i>
                       </a>

                       <button class="btn btn-danger btn-sm" type="submit">
                         <i class="fas fa-trash"></i>
                       </button>
                     </form>
                   </td>
                 </tr>

               <?php endforeach; ?>

             </tbody>
           </table>

           <!-- tabla de facturas end -->




         </div>
       </div>
       <!-- /.card -->

     </section>
     <!-- /.content -->