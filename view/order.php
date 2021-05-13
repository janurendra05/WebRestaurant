<?php
include '../model/restoran.php';
include '../model/user.php';
session_start();

$user = new User();
$restoran = new Restoran();
$data_menu = $restoran->getAllMenu();

$categories = $restoran->getAllCategory();
$data_user = $user->checkUsername($_SESSION['restoran.uts.username']);

if(!isset($_SESSION['restoran.uts.status']) || $_SESSION['restoran.uts.status'] == ''){
    if($_SESSION['restoran.uts.status'] != 'login'){
        header('location:login.php');
    }
}

foreach($categories as $each_item){
    $each_item['menu'] = $restoran->getByCategory($each_item['id_kategori']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>

    <?php include '../include/css.php' ?>
    <link rel="stylesheet" href="../include/css/homepage.css" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Restoran UTS IF 430</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="order.php">Order</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a class="nav-item text-nowrap nav-link" href="../controller/user_logout.php">Sign out</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <div data-aos="fade-down" data-aos-delay="300" class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 fw-normal">We got everything you need</h1>
                <p class="lead fw-normal">From appetizer to dessert, feel free to choose what suits your taste.</p>
            </div>
            <div class="product-device shadow-sm d-none d-md-block"></div>
            <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
        </div>

        <div class="d-flex align-items-center justify-content-between px-5">
            <h2 class="text-center my-3 py-3">Category</h2>
        </div>

        <ul class="nav nav-pills nav-fill mb-3" role="tablist">
            <?php $i = 0; foreach($categories as $item) { ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link mx-auto <?php if($i == 0){$i++; echo 'active';} ?>" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#tab-<?= $item['id_kategori'] ?>" type="button" role="tab"><?= $item['nama_kategori'] ?></button>
            </li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <?php $i = 0; foreach($categories as $item) { ?>
                <div class="tab-pane fade <?php if($i == 0){$i++; echo 'show active';} ?>" id="tab-<?= $item['id_kategori'] ?>" role="tabpanel">
                    <div class="grid">
                    <?php $item['menu'] = $restoran->getByCategory($item['id_kategori']); ?>
                    <?php foreach($item['menu'] as $menu) { ?>
                    <div class="grid-item">
                        <div class="card m-5" style="width: 18rem;">
                            <?php if(isset($menu['gambar'])) { ?>
                            <img src="<?= $menu['gambar'] ?>" class="card-img-top" alt="<?= $menu['id_menu'] ?>">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $menu['nama_menu'] ?></h5>
                                <p class="card-text"><?= $menu['deskripsi'] ?></p>
                                <button class="btn btn-warning initiate-order-button">Add to Order</button>
                                <div class="input-group d-none order-counter">
                                    <button class="btn btn-outline-danger decrement-button" type="button"><i class="fas fa-minus fa-fw"></i></button>
                                    <input type="number" class="form-control text-center" readonly name="quantity" value="0" data-nama="<?= $menu['nama_menu'] ?>" data-harga="<?= $menu['harga_menu'] ?>" data-idmenu="<?= $menu['id_menu'] ?>">
                                    <button class="btn btn-outline-success increment-button" type="button"><i class="fas fa-plus fa-fw"></i></button>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush subcost">
                                <li class="list-group-item"><?= $item['nama_kategori'] ?></li>
                                <li class="list-group-item">Rp. <?= $menu['harga_menu'] ?></li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <div class="col-md-3">
        <div class="col-md-12">
            <table class="table table-striped" id="order-table">
                <tr>
                    <td>nama_menu</td>
                    <td id="id_menu">jumlah</td>
                    <td id="harga_menu">Harga*Jumlah</td>
                </tr>
                <tbody id='isi-data-order'>
                    <tr>
                        
                    </tr>
                </tbody>
                <tr>
                    <td>Total</td>
                    <td colspan="2" align="center">
                        <p id="tmp">0</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <button type="submit" class="btn btn-primary" id="checkout-button">Pesan</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <?php include '../include/js.php' ?>
    <script type="module">
    AOS.init();
    
    $(document).ready(function () {
        let listOfOrders = [];

        
        
        $('.grid').masonry({
            itemSelector: '.grid-item',
            columnWidth: 80
        });

        $(document).on('click', '.initiate-order-button', function () {
            $(this).addClass('d-none');
            $(this).next('.input-group').removeClass('d-none');
            $(this).next('.input-group').find('input[name=quantity]').val(1).change();
            let cost = $(this).next('.input-group').find('input[name=quantity]').data('harga');
            let id = $(this).next('.input-group').find('input[name=quantity]').data('idmenu');
        });

        $(document).on('click', '.decrement-button', function () {
            let currentValue = $(this).next('input[name=quantity]').val();
            if (currentValue == 1) {
                $(this).next('input[name=quantity]').val(--currentValue).change();
                $(this).parent().addClass('d-none');
                $(this).parent().prev('.initiate-order-button').removeClass('d-none');
            } else {
                $(this).next('input[name=quantity]').val(--currentValue).change();
            }
        });

        $(document).on('click', '.increment-button', function () {
            let currentValue = $(this).prev('input[name=quantity]').val();
            $(this).prev('input[name=quantity]').val(++currentValue).change();
        });

        $(document).on('change', 'input[name=quantity]', function (event) {
            let cost = $(this).attr('data-harga');
            let id = $(this).attr('data-idmenu');
            let name = $(this).attr('data-nama');
            let value = $(this).val();
            
            let order = {};
            order['id'] = id;
            order['name'] = name;
            order['qty'] = value;
            order['cost'] = cost;
            var i = 0;
            var find = false;
            for(i = 0; i < listOfOrders.length; i++){
                if(id == listOfOrders[i]['id'] && find == false){
                    listOfOrders[i]['qty'] = value;
                    find = true;
                }else if(find == true) break;
            }
            if(find == false){
                listOfOrders.push(order);
            }
            document.getElementById('isi-data-order').innerHTML = '';
            var total = 0;
            for(i = 0; i < listOfOrders.length; i++){
                if(listOfOrders[i]['qty'] != 0){
                    document.getElementById('isi-data-order').innerHTML +=
                    "<tr>"+
                    "<td>"+listOfOrders[i]['name']+"</td>"+
                    "<td>"+listOfOrders[i]['qty']+"</td>"+
                    "<td>"+(listOfOrders[i]['qty']*listOfOrders[i]['cost'])+"</td>"+
                    "</tr>";
                }
                total += (listOfOrders[i]['qty']*listOfOrders[i]['cost']);
            }
            document.getElementById('tmp').innerHTML = total;
        });

        $(document).on('shown.bs.tab', 'button[data-bs-toggle="pill"]', function (e) {
            $('.grid').masonry({
                itemSelector: '.grid-item',
                columnWidth: 80
            });
        });

        $(document).on('click', 'button[type=submit].btn.btn-primary#checkout-button', function (event) {
            swal("Order Made", "Order successfully made!", "success");
        });
        
    });


    </script>
</body>

</html>