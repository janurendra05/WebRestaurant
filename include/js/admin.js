$(document).ready(function () {
    let modal = new bootstrap.Modal(document.getElementById('main-modal'))
    const img = "https://www.plextek.com/wp-content/uploads/default-placeholder-1024x1024-500x500-1.png";

    let table = $('table#dt').DataTable({
        dom: 'Bfrtip',
        select: {
            style: 'single'
        },
        buttons: [
            {
                text: 'Add',
                action: function () {
                    // document.getElementById('item-id').readOnly = false;
                    document.getElementById('upload-photo').value = "";
                    // document.getElementById('item-id').classList.remove('form-control-plaintext');
                    // document.getElementById('item-id').classList.add('form-control');
                    if ($('#item-id').data('last')) {
                        let val = $('#item-id').data('last');
                        document.getElementById('item-id').value = val;
                    } else {
                        document.getElementById('item-id').value = "";
                    }
                    document.getElementById('create-button').href = "../controller/add_menu.php";
                    document.getElementById('create-button').classList.remove('d-none');
                    document.getElementById('update-button').href = "#";
                    document.getElementById('update-button').classList.add('d-none');
                    document.getElementById('delete-button').href = "#";
                    document.getElementById('delete-button').classList.add('d-none');
                    document.getElementById('item-name').value = "";
                    document.getElementById('item-price').value = "";
                    document.getElementById('item-desc').value = "";
                    document.getElementById('item-category').value = "";
                    $('img#preview-photo').attr('src', img);
                    let form = $('form#form-menu')
                    form.attr('action', '../controller/add_menu.php');
                    // Listener 
                    $('a#create-button').on('click', function (event) {
                        form.submit();
                    });

                    modal.show();
                }
            }
        ],
        // processing: true,
		// serverSide: true,
        // initComplete: function () {
        //     // Callback
        // }
    });

    $('table#dt tbody').on('click', 'tr', function () {
        let selectedData = table.row(this).data();
        // document.getElementById('item-id').readOnly = true;
        document.getElementById('upload-photo').value = "";
        // document.getElementById('item-id').classList.add('form-control-plaintext');
        // document.getElementById('item-id').classList.remove('form-control');
        // $('input#item-id').val(selectedData[0]);
        document.getElementById('item-id').value = selectedData[0];
        document.getElementById('create-button').classList.add('d-none');
        document.getElementById('update-button').href = "../controller/edit_menu.php?id=" + selectedData[0];
        document.getElementById('update-button').classList.remove('d-none');
        document.getElementById('delete-button').href = "../controller/delete_menu.php?id=" + selectedData[0];
        document.getElementById('delete-button').classList.remove('d-none');
        document.getElementById('item-name').value = selectedData[1];
        document.getElementById('item-price').value = selectedData[2];
        document.getElementById('item-desc').value = selectedData[3];
        document.getElementById('item-category').value = selectedData[4];
        $('img#preview-photo').attr('src', selectedData[5]);
        document.getElementById('form-menu').action = "";
        
        let form = $('form#form-menu');

        $('a#update-button').on('click', function (event) {
            form.attr('action', '../controller/edit_menu.php?id=' + selectedData[0]);
            form.submit();
        });

        $('a#delete-button').on('click', function (event) {
            form.attr('action', '../controller/delete_menu.php?id=' + selectedData[0]);
            form.submit();
        });

        let file;
        $('input#upload-photo').on('change', function (event) {
            if ($(this).get(0).files.length === 0) {
                file = null;
            } else {
                file = $(this).get(0).files;
            }

            let output = $('img#preview-photo');
            output.attr('src', URL.createObjectURL(event.target.files[0]));
            output.on('load', function () {
                URL.revokeObjectURL(output.src);
            });
        });
      
        // let form = document.getElementById('form-menu');
        // let fd = new FormData(form);
        // fd.append('gambar', file);
        // fd.append('nama', data[1]);
        // fd.append('harga', data[2]);
        // fd.append('deskripsi', data[3]);
        // fd.append('id_kategori', data[4]);

        // var form = document.getElementById('form-menu');
        // form.action = '../controller/edit_menu.php?id=' + selectedData[0];
        // $('a#update-button').click(function(){
        //     form.submit();
        // });
        
        $('a#update-button').on('click', function () {
            // let name = $('input[name=nama]').val();
            // let cost = $('input[name=harga]').val();
            // let desc = $('input[name=deskripsi]').val();
            // let category = $('input[name=id_kategori]').val();
            // console.log({name, cost, desc, category});
            $.ajax({
                url: '../controller/edit_menu.php?id=' + selectedData[0],
                type: "POST",
                data: {
                    nama: $('input[name=nama]').val(),
                    harga: $('input[name=harga]').val(),
                    deskripsi: $('input[name=deskripsi]').val(),
                    id_kategori: $('input[name=id_kategori]').val(),
                    gambar: file
                },
                dataType: 'json',
                // processData: false,
                // contentType: 'multipart/form-data',
                success: function(response){

                },
                complete: function(data){
                    console.log(data);
                    console.log('kontol');
                    // table.rows().invalidate().draw();
                    // table.ajax.reload();
                }
            });
            location.reload();
        });
        modal.show();
    });

    $('input#upload-photo').on('change', function (event) {
        let output = $('img#preview-photo');
        output.attr('src', URL.createObjectURL(event.target.files[0]));
        output.on('load', function () {
            URL.revokeObjectURL(output.src);
        });
    });
});