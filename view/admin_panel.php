<?php
include '../model/restoran.php';

$restoran = new Restoran();
$data_menu = $restoran->getAllMenu();
  
?>  
  
  <!DOCTYPE html>
  
  <head>
  
      <?php include '../include/css.php' ?>
      <link rel="stylesheet" href="../include/css/admin_panel.css"/>
  </head>
  
<body>
      <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
          <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">UMN Restaurant</a>
          <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
          <ul class="navbar-nav px-3">
              <li class="nav-item text-nowrap">
                  <a class="nav-link" href="../controller/user_logout.php">Sign out</a>
              </li>
          </ul>
      </header>
  
      <div class="container-fluid">
          <div class="row">
              <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                  <div class="position-sticky pt-3">
                      <ul class="nav flex-column">
                          <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="#">
                                  <span data-feather="home"></span>
                                  Dashboard
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">
                                  <i class="far fa-file fa-fw"></i>
                                  <!-- <span data-feather="file"></span> -->
                                  Orders
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">
                                  <i class="fas fa-shopping-cart fa-fw"></i>
                                  <!-- <span data-feather="shopping-cart"></span> -->
                                  Products
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">
                                  <!-- <span data-feather="users"></span> -->
                                  <i class="fas fa-user fa-fw"></i>
                                  Customers
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">
                                  <span data-feather="layers"></span>
                                  Integrations
                              </a>
                          </li>
                      </ul>
  
                      <h6
                          class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                          <span>Saved reports</span>
                          <a class="link-secondary" href="#" aria-label="Add a new report">
                              <span data-feather="plus-circle"></span>
                          </a>
                      </h6>
                      <ul class="nav flex-column mb-2">
                          <li class="nav-item">
                              <a class="nav-link" href="#">
                                  <span data-feather="file-text"></span>
                                  Current month
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">
                                  <span data-feather="file-text"></span>
                                  Last quarter
                              </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Social engagement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Year-end sale
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            This week
                        </button>
                    </div>
                </div>

                <h2>Daftar Menu</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID Menu</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Deskirpsi</th>
                                <th>Nama Kategori</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data_menu as $menu){ ?>
                                <tr>
                                    <td><?php echo $menu['id_menu'] ?></td>
                                    <td><?php echo $menu['nama_menu'] ?></td>
                                    <td><?php echo $menu['harga_menu'] ?></td>
                                    <td><?php echo $menu['deskripsi'] ?></td>
                                    <td><?php echo $menu['nama_kategori'] ?></td>
                                    <td><img src="<?php echo $menu['gambar'] ?>" alt="No Image Found" srcset="" height="200"></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    <?php include '../include/js.php' ?>
</body>

</html>