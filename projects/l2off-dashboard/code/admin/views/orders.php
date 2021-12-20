<?php
require 'crud/read.php';
?>

<div class="card bg-dark">
    <div class="card-body">
        <div class="title-payment">
            <div class="msg">
                <h2 class="text-warning">Como é definido os status de compra do nosso serviço, antes da compra depois da compra e após recebido!</h2>
            </div>
            <div class="content">
                <ul class="text-light">
                    <li><label class="badge badge-danger">Pending</label></li>
                    <li><label class="badge badge-success">Approved</label></li>
                    <!-- <li><label class="badge badge-success">Received</label></li> -->
                </ul>
            </div>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <!-- <p class="card-description">
            Add class <code>.table-hover</code>
        </p> -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Site Name</th>
                        <th>Price</th>
                        <th>Dyas</th>
                        <th>Order</th>
                        <th>Status</th>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "pedding") { ?>
                        <th>Data</th>
                        <?php } ?>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "approved") { ?>
                        <th>Data Approved</th>
                        <?php } ?>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "pedding") { ?>
                        <th>Form Payment</th>
                        <?php } ?>
                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "pedding") { ?>
                        <th>Delete</th>
                        <?php } ?>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "approved") { ?>
                        <th>Receive Now</th>
                        <?php } ?>


                    </tr>
                </thead>
                <tbody>

                    <?php if (!empty(orderAllById($_SESSION['id']))) { ?>
                    <tr>
                        <td> <?= orderAllById($_SESSION['id'])[0]["site_name"] ?></td>
                        <td> <?= orderAllById($_SESSION['id'])[0]["price"] ?></td>
                        <td> <?= orderAllById($_SESSION['id'])[0]["dyas"] ?></td>
                        <td> <?= orderAllById($_SESSION['id'])[0]["num_order"] ?></td>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "pedding") { ?>
                        <td><label class="badge badge-danger">Pending</label></td>
                        <?php } ?>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "approved") { ?>
                        <td><label class="badge badge-success">Ppproved</label></td>
                        <?php } ?>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "pedding") { ?>
                        <td> <?= orderAllById($_SESSION['id'])[0]["data_order"] ?></td>
                        <?php } ?>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "approved") { ?>
                        <td> <?= orderAllById($_SESSION['id'])[0]["data_approved"] ?></td>
                        <?php } ?>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "pedding") { ?>
                        <td class="payment">
                            <form method="post" action="payment">
                                <input type="hidden" name="order" value="<?= orderAllById($_SESSION['id'])[0]["num_order"] ?>">
                                <input type="hidden" name="form_paypal" value="true">

                                <input type="submit" class="paypal" value="">

                            </form>

                        </td>
                        <?php } ?>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "approved") { ?>
                        <td class="payment">
                            <form method="post" action="receive">
                                <input type="hidden" name="order" value="<?= orderAllById($_SESSION['id'])[0]["num_order"] ?>">
                                <input type="hidden" name="form_paypal" value="true">
                                <input type="submit" class="btn btn-primary" value="Next">
                            </form>
                        </td>
                        <?php } ?>

                        <?php if (orderAllById($_SESSION['id'])[0]["status"] == "pedding") { ?>
                        <td><button id="delete" style="border: 0; background-color: transparent;" value="<?= orderAllById($_SESSION['id'])[0]["token"] ?>"><i class="mdi mdi-delete-forever" style="font-size: 22px; cursor: pointer;"></i></button></td>
                        <?php } ?>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="template">
            <?php if (orderAllById($_SESSION['id'])[0]["status"] == "pedding") { ?>
            <img src="uploaded/66e44e17e4b6cb0b344cb2a8a147a072.jpg" class="img-fluid" alt="Responsive image">
            <?php } ?>
        </div>
    </div>
</div>

<script>
    <?php if (orderAllById($_SESSION['id'])[0]["status"] == "pedding") { ?>
    $(function() {

        $('#delete').click(function() {
            $.ajax({

                url: "<?= $adminUrl . "/run.php"; ?>",
                type: "POST",
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    token: $(this).val(),
                    form_delete_order: true
                }),
                cache: false,
                dataType: "json",
                success: function(json) {

                    console.log(json);
                    if (json.success === true) {
                        window.location.reload();
                    }

                    if (json.error === true) {
                        alert("Error");
                    }

                },
                error: function(json) {
                    console.log("error");
                }
            });
        });
    });
    <?php } ?>
</script>