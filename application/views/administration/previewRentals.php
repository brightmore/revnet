<h4 class="alert_warning">Are you sure you want submit information? The information when submitted can not be reversed</h4>
<?php echo form_open('index.php/administration/previewSubmittedRentals'); ?>
<article class="module width_full">
    <header>
        <h3>Rental Information</h3>
    </header>
    <div class="module_content">
        <table class="tablesorter" cellspacing="0">
            <tr>
                <td>Agreement Date: </td>
                <td><?php echo $agreementDate ?></td>
            </tr>
            <tr>
                <td>Expiry Date:</td>
                <td><?php echo $expiryDate ?></td>
            </tr>
            <tr>
                <td>Rent Type:</td>
                <td><?php echo $rentalType ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><?php echo $location ?></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td><?php echo $description ?></td>
            </tr>

        </table>
    </div>
    <?php echo form_hidden('agreementDate', $agreementDate); ?>
    <?php echo form_hidden('expiryDate', $expiryDate); ?>
    <?php echo form_hidden('location', $location) ?>
    <?php echo form_hidden('propertyType', $rentalType) ?>
    <?php echo form_hidden('description', $description); ?>
    <?php
    if ($this->session->userdata('id')) {
        echo form_hidden('id', $id);
    }
    ?>
</article>
<footer>
    <div class="submit_link">
        <?php
        if ($this->session->userdata('id')) {
            $back = site_url('index.php/administration/editRentals/' . $id);
        } else {
            $back = site_url('index.php/administration/rentals');
        }
        ?>
        <a href="<?php echo $back ?>" class="button" /> <input type="submit" value="Save" class="alt_btn">
    </div>
</footer>
<?php echo form_close(); ?>
