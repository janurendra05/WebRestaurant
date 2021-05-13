<?php
include '../model/restoran.php';
include '../model/user.php';
session_start();

$user = new User();
$restoran = new Restoran();
$data_menu = $restoran->getAllMenu();
$list_kategori = $restoran->getAllKategori();
$data_user = $user->checkUsername($_SESSION['restoran.uts.username']);

if(!isset($_SESSION['restoran.uts.status']) || $_SESSION['restoran.uts.status'] == ''){
    if($_SESSION['restoran.uts.status'] != 'login'){
        header('location:login.php');
    }
}
if(!isset($_SESSION['restoran.uts.role']) || $_SESSION['restoran.uts.role'] != 'admin'){
    header('location:home.php');
}
  
?>  
  
  <!DOCTYPE html>
  
  <head>
  
      <?php include '../include/css.php' ?>
      <link rel="stylesheet" href="../include/css/admin.css"/>
  </head>
  
<body>
      <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
          <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="home.php">Restoran UTS IF 430</a>
          <ul class="navbar-nav px-3">
              <li class="nav-item text-nowrap">
                  <a class="nav-link" href="../controller/user_logout.php">Sign out</a>
              </li>
          </ul>
      </header>
  
      <div class="container-fluid">
          <div class="row"></div>
            <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <h2>Daftar Menu</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-sm" id="dt">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th class="d-none">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data_menu as $menu){ ?>
                                <tr>
                                    <td><?php echo $menu['id_menu'] ?></td>
                                    <td><?php echo $menu['nama_menu'] ?></td>
                                    <td><?php echo $menu['harga_menu'] ?></td>
                                    <td><?php echo $menu['deskripsi'] ?></td>
                                    <td><?php echo $menu['id_kategori'] ?></td>
                                    <td class="d-none"><?= $menu['gambar'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="main-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data" id="form-menu" action="">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="item-id" class="col-sm-3 col-form-label">ID Menu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" readonly id="item-id" name="id_menu" data-last="<?= $restoran->getNewMenuId() ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="item-name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="item-name" name="nama">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="item-price" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="item-price" name="harga">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="item-desc" class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="item-desc" name="deskripsi">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="item-category" class="col-sm-3 col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="item-category" name="id_kategori">
                            </div>
                        </div>
                        <div class="mb-3 row" id="upload-photo">
                            <label for="upload-photo" class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="file" id="upload-photo" accept="image/*" name="gambar"/>
                            </div>
                        </div>
                        <div class="mb-3 row" id="preview-photo">
                            <label for="preview-photo" class="col-sm-3 col-form-label">Preview</label>
                            <div class="col-sm-9">
                                <img class="img-thumbnail img-fluid rounded" src="https://www.plextek.com/wp-content/uploads/default-placeholder-1024x1024-500x500-1.png" id="preview-photo">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" type="submit" class="btn btn-success" id="create-button" data-bs-dismiss="modal">Create</a>
                        <a href="#" type="submit" class="btn btn-warning" id="update-button" data-bs-dismiss="modal">Edit</a>
                        <a href="#" type="submit" class="btn btn-danger" id="delete-button" data-bs-dismiss="modal">Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../include/js.php' ?>
    <script src="../include/js/admin.js"></script>

</body>

</html>