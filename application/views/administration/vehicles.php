<?php $type = array('error'=>'Select...','Saloon'=>'Saloon','Van'=>'Van','Motor Bike'=>'Motor Bike','Truck'=>'Truck','Bicycle'=>'Bicycle'); ?>

<?php if ( $vehicles != null) { ?>
    <article class="module width_full">
        <header>
            <h3>Vehicles </h3>
        </header>
        <div class="module_content">
            <table class="tablesorter" cellspacing="0">
                <thead>
                <th>&nbsp;</th>
                <th>Model</th>
                <th>Name</th>
                <th>Registration No</th>
                <th>Location</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach ($vehicles as $value) { ?>
                        <tr>
                            <td><input name="multi[]" type="checkbox" value="<?php echo $value->id ?>" /></td>
                            <td><?php echo anchor('index.php/administration/vehicleGroup/'.$value->type, $value->type, array('title' => 'Click to view all rentals under this group')) ?></td>
                            <td><?php echo $value->name ?></td>
                            <td><?php  echo anchor(base_url('index.php/administration/editVehicle/' . $value->registrationNo,array('title'=>'Edit this vehicle')), $value->registrationNo); ?></td>
                            <td><?php echo $value->location ?></td>
                            <td>
                                <?php echo anchor(base_url('index.php/administration/editVehicle/' . $value->id), img(site_url('images/icn_edit.png')), array('title' => 'Edit')) ?>
                                <?php echo anchor(base_url('index.php/administration/deleteVehicle/' . $value->id), img(site_url('images/icn_trash.png')), array('title' => 'Delete')) ?>
                                <?php echo anchor(base_url('index.php/administration/viewVehicle/' . $value->id), img(site_url('images/icn_view.png')), array('title' => 'Vehicle Details')) ?>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </article>
<?php } else { ?>
    <h4 class="alert_info">There no Vehicle info at the moment...</h4>
<?php } ?>
<?php $action = 'index.php/administration/previewSubmittedVehicle' ?>
<article class="module width_full" id="epccIssued">
    <?php message() ?>
    <?php echo form_open($action) ?>
    <header><h3>New Vehicle</h3></header>
    <div class="module_content">
        <fieldset>
            <ul>
                <li>
                    <label>Type:</label>
                    <?php echo form_dropdown('type', $type) ?><span class="form_error"><?php echo form_error('type'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Model:</label>
                    <input type="text" name="model" value="<?php echo set_value('model'); ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('model'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo set_value('name'); ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('name'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Registration No:</label>
                    <input type="text" name="regNo" value="<?php echo set_value('regNo'); ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('regNo'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Branch:</label>
                    <?php echo form_dropdown('branchCode', allBranches()) ?>
                     <span class="form_error"><?php echo form_error('location'); ?></span>
                    <div class="clear"></div>
                </li>

                <li>
                    <label>Note:</label>
                    <textarea cols="10" rows="7" name="note" id="description"></textarea>
                  <span class="form_error">  <?php echo form_error('note'); ?></span>
                </li>
            </ul>

        </fieldset>

        <div class="clear"></div>
    </div>
    <footer>
        <div class="submit_link">
            <input type="submit" value="Preview" class="alt_btn">
        </div>
    </footer>
</article><!-- end of post new article -->