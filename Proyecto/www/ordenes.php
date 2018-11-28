<?php
include "php/DbOperations.php";
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Productos</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="vendors/iconfonts/font-awesome/css/font-awesome.css">
  <script src="js/funcs.js"></script>
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />

</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html">
          <img src="images/logo.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="images/logo-mini.svg" alt="logo" />
        </a>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="text-wrapper">
                    <p class="profile-name">Taquetos Max Paine</p>
                  <div>
                    <small class="designation text-muted">Manager</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Mesas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="empleados.php">
              <i class="menu-icon fa fa-id-badge"></i>
              <span class="menu-title">Empleados</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cuentas.php">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Cuentas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productos.php">
              <i class="menu-icon fa fa-id-badge"></i>
              <span class="menu-title">Productos</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ordenes.php">
              <i class="menu-icon fa fa-id-badge"></i>
              <span class="menu-title">Ordenes</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="nomina.php">
              <i class="menu-icon fa fa-id-badge"></i>
              <span class="menu-title">Nomina</span>
            </a>
          </li>
        </ul>
      </nav>

      <div id="addProductModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Agregar Producto</h4>
            </div>
            <div class="modal-body">
              <form role="form" method='post' action='' enctype="multipart/form-data">
                Nombre:
                <input type='text' name='nombreDelProducto' class="form-control" id='nombreDelProducto'>
                Costo:
                <input type='number' name='costoDelProducto' class="form-control" id='costoDelProducto'>
                Precio:
                <input type='number' name='precioDelProducto' class="form-control" id='precioDelProducto'>
                Tipo:
                <br>
                <select name="tipoSelect" id='tipoSelect'>
                  <option value='Bebida'>Bebida</option>
                  <option value='Postre'>Postre</option>
                  <option value='PlatoFuerte'>Plato Fuerte</option>
                  <option value='Entradas'>Entradas</option>
                </select>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-fw" data-dismiss="modal"> Cancelar</button>
              <button type="button" class="btn btn-success btn-fw" onclick='addProductFunction()'>Agregar</button>
            </div>
          </div>
        </div>
      </div>




      <!-- partial -->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">En proceso</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Orden
                          </th>
                          <th>
                            Producto
                          </th>
                          <th>
                            Mesa
                          </th>
                          <th>
                            Cuenta
                          </th>
                          <th>
                            Opciones
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $db = new DbOperations();
                        $db->setData('Orden', 0);
                         ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Completadas</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Orden
                          </th>
                          <th>
                            Producto
                          </th>
                          <th>
                            Mesa
                          </th>
                          <th>
                            Cuenta
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $db = new DbOperations();
                        $db->setData('Orden', 1);
                         ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>

          <div id="modifyProductModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modificar Producto</h4>
                </div>
                <div class="modal-body">
                  <form role="form" method='post' action='' enctype="multipart/form-data">
                    ID:
                    <input type='text' name='idDelProducto1' class="form-control" id='idDelProducto1' disabled>
                    Nombre:
                    <input type='text' name='nombreDelProducto1' class="form-control" id='nombreDelProducto1'>
                    Costo:
                    <input type='number' name='costoDelProducto1' class="form-control" id='costoDelProducto1'>
                    Precio:
                    <input type='number' name='precioDelProducto1' class="form-control" id='precioDelProducto1'>
                    Tipo:
                    <br>
                    <select id='tipoSelectMod1'>
                      <option value='Bebida'>Bebida</option>
                      <option value='Postre'>Postre</option>
                      <option value='PlatoFuerte'>Plato Fuerte</option>
                      <option value='Entradas'>Entradas</option>
                    </select>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-fw" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-success btn-fw" onclick='modifyProductFunction()'>Modificar</button>
                </div>
              </div>
            </div>
          </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
              <i class="mdi mdi-heart text-danger"></i>
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/funcs.js"></script>
  <!-- End custom js for this page-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>



</body>
</html>
