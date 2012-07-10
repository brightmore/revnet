<article class="module width_full" id="epccIssued">
    <div>
        
    </div>
</article>
<?php $type = array('error'=>'Select...','Saloon'=>'Saloon','Van'=>'Van','Motor Bike'=>'Motor Bike','Truck'=>'Truck','Bicycle'=>'Bicycle'); ?>
<?php $action = 'index.php/administration/previewSubmittedVehicle' ?>
<article class="module width_full">
    <?php message() ?>
    <?php echo form_open($action) ?>
    <header><h3>New Vehicle</h3></header>
    <div class="module_content">
        <fieldset>
            <ul>
                <li>
                    <label>Type:</label>
                    <?php echo form_dropdown('type', $type, $vehicle->type) ?><span class="form_error"><?php echo form_error('type'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Model:</label>
                    <input type="text" name="model" value="<?php echo $vehicle->model; ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('model'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo $vehicle->name; ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('name'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Registration No:</label>
                    <input type="text" name="regNo" value="<?php echo $vehicle->registrationNo; ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('regNo'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Branch:</label>
                    <?php echo form_dropdown('branchCode', allBranches(),$vehicle->location) ?>
                     <span class="form_error"><?php echo form_error('location'); ?></span>
                    <div class="clear"></div>
                </li>

                <li>
                    <label>Note:</label>
                    <textarea cols="10" rows="7" name="note" id="description"><?php echo $vehicle->note ?></textarea>
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