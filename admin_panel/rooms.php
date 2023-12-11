<?php require('./config/config.php');
admin_login();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php require('./partials/links.php') ?>
    <link rel="stylesheet" href="./public/css/common.css">
    <style>
    .actions {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-top: 40px;
        border-bottom: none;
    }

    th {
        font-size: .8rem;
        text-align: center;
    }

    td {
        font-size: .8rem;
        text-align: center;

        vertical-align: middle;
    }

    .btn_edit {
        padding: 2px 10px;
    }

    .room_description_text {
        font-size: .7rem;
        width: 300px;
    }

    input {
        font-size: .7rem !important;
    }
    </style>
</head>

<body>
    <?php require('./partials/header.php'); ?>
    <?php require('./partials/nav_pills.php'); ?>

    <div class="center">
                    <div class="top d-flex justify-content-between align-items-center">
                    <h1>Rooms</h1>
        <button class="btn btn-primary btn_add"><i class="bi bi-plus-square"></i>&nbsp; Add</button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Room Picture</th>
                    <th>Room Title</th>
                    <th>Room Description</th>
                    <th>Room Max Person</th>
                    <th>Room Price per Night</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table_body">
                <!-- Example row, you can add more rows dynamically -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade my_modal_add_us" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="" id="modal_form_add">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Room</h1>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn_edit shadow-none">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    function get_rooms() {

        let xhr = new XMLHttpRequest()
        xhr.open('POST', 'http://localhost/teal-residences/admin_panel/ajax/settings_crud.php', true)
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

        xhr.onload = function() {
            const table_body = document.querySelector('.table_body');
            table_body.innerHTML = this.responseText
            // console.log(this.responseText);
        }
        xhr.send('get_rooms')
    }

    window.onload = function() {
        get_rooms()
    }

    function edit_room(button) {
        // Fetch data from the row
        const row = button.closest('tr');
        const roomPicture = row.cells[0].innerHTML;
        const roomTitle = row.cells[1].innerHTML;
        const roomDescription = row.cells[2].innerHTML;
        const roomMaxPerson = row.cells[3].innerHTML;
        const roomPricePerNight = row.cells[4].innerHTML;

        // Populate the modal with data
        const modalBody = document.querySelector('.modal-body');
        modalBody.innerHTML = `
        <p style="font-size: .7rem; margin-bottom: 0; font-weight: bold;">Picture</p>
            <div">${roomPicture}</div>
            <div><input class="form-control form-control-sm shadow-none mt-1"  type="file" accept="image/*"></div>
            
        <p style="font-size: .7rem; margin-bottom: 0; font-weight: bold; margin-top: 1rem;">Room Title</p>
            <div><input  type="text" class="form-control shadow-none" value="${roomTitle}"></div>
            
        <p style="font-size: .7rem; margin-bottom: 0; font-weight: bold; margin-top: 1rem;">Room Description</p>
            <div><input  type="text" class="form-control shadow-none" value="${roomDescription}"></div>

        <p style="font-size: .7rem; margin-bottom: 0; font-weight: bold; margin-top: 1rem;">Room Max Person</p>
            <div><input  type="text" class="form-control shadow-none" value="${roomMaxPerson}"></div>

        <p style="font-size: .7rem; margin-bottom: 0; font-weight: bold; margin-top: 1rem;">Room Price per Night</p>


            <div class="input-group">
  <span class="input-group-text" id="basic-addon1">₱</span>
  <input type="text" class="form-control shadow-none" aria-describedby="basic-addon1" value="${roomPricePerNight}">
</div>
        `;

        // Show the modal
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }
    </script>
</body>

</html>