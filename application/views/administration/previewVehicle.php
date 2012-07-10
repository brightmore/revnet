<h4 class="alert_warning">Are you sure you want submit information? The information when submitted can not be reversed</h4>
<?php echo form_open('index.php/administration/previewSubmittedRentals'); ?>
<article class="module width_full">
    <header>
        <h3>Rental Information</h3>
    </header>
    <div class="module_content">
        <table class="tablesorter" cellspacing="0">
            <tr>
                <td>Vehicle Type: </td>
                <td><?php echo $type ?></td>
            </tr>
            <tr>
                <td>Model:</td>
                <td><?php echo $model ?></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><?php echo $name ?></td>
            </tr>
             <tr>
                <td>Registration No:</td>
                <td><?php echo $registrationNo ?></td>
            </tr>
            
            <tr>
                <td>Branch Code:</td>
                <td><?php echo $branchCode ?></td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td><?php echo $note ?></td>
            </tr>

        </table>
    </div>
    <?php echo form_hidden('note', $note); ?>
    <?php echo form_hidden('name', $name); ?>
    <?php echo form_hidden('branchcode', $branchCode) ?>
    <?php echo form_hidden('type', $type) ?>
    <?php echo form_hidden('registrationNo', $registrationNo); ?>
    <?php echo form_hidden('model', $model); ?>
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
            $back = site_url('index.php/administration/editVehicle/' . $id);
        } else {
            $back = site_url('index.php/administration/vehicles');
        }
        ?>
        <a href="<?php echo $back ?>" class="button" /> <input type="submit" value="Save" class="alt_btn">
    </div>
</footer>
<?php echo form_close(); ?>
