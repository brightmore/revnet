<?php if (isset($rentals)) { ?>
    <article class="module width_full">
        <header>
            <h3>RENTALS</h3>
        </header>
        <div class="module_content">
            <table class="tablesorter" cellspacing="0">
                <thead>
                <th>&nbsp;</th>
                <th>Rental Type</th>
                <th>Agreement Date</th>
                <th>Expiry Date</th>
                <th>Location</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach ($rentals as $value) { ?>
                        <tr>
                            <td><input name="multi[]" type="checkbox" value="<?php echo $value->id ?>" selected="true" /></td>
                            <td><?php echo anchor('index.php/administration/rentalGroup', $value->rentalType, array('title' => 'Click to view all rentals under this group')) ?></td>
                            <td><?php echo date('d M y', $value->agreementDate) ?></td>
                            <td><?php echo date('d M y', $value->expiryDate) ?></td>
                            <td><?php echo $value->location ?></td>
                            <td>
                                <?php echo anchor(base_url('index.php/administration/editRentals/' . $value->id), img(site_url('images/icn_edit.png')), array('title' => 'Edit')) ?>
                                <?php echo anchor(base_url('index.php/administration/deleteRentals/' . $value->id), img(site_url('images/icn_trash.png')), array('title' => 'Delete')) ?>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </article>
<?php } else { ?>
    <h4 class="alert_info">There no rental info at the moment...</h4>
<?php } ?>
<?php $action = 'index.php/administration/previewSubmittedRentals' ?>
<article class="module width_full" >
    <?php message() ?>
    <?php echo form_open($action) ?>
    <header><h3>Training Section</h3></header>
    <div class="module_content">
        <fieldset>
            <ul>
                <li>
                    <label>Property Type:</label>
                    <input type="text" name="propertyType" value="<?php echo $rental->rentalType ?>" style="width: 200px"> <span class="form_error"><?php echo form_error('propertyType'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Agreement Date:</label>
                    <input type="text" name="agreementDate" value="<?php echo date('d M Y',$rental->agreementDate); ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('agreementDate'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Expiry Date:</label>
                    <input type="text" name="expiryDate" value="<?php echo date('d M Y',$rental->expiryDate); ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('expiryDate'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Address:</label>
                    <input type="text" name="location" value="<?php echo $rental->location; ?>" style="width: 200px">
                     <span class="form_error"><?php echo form_error('location'); ?></span>
                    <div class="clear"></div>
                </li>

                <li>
                    <label>Description:</label>
                    <textarea cols="10" rows="7" name="description" id="description"><?php echo $rental->description ?></textarea>
                  <span class="form_error">  <?php echo form_error('description'); ?></span>
                </li>
            </ul>
            <input type="hidden" name="id" value="<?php echo $rental->id; ?>"
        </fieldset>

        <div class="clear"></div>
    </div>
    <footer>
        <div class="submit_link">
            <a href="<?php echo site_url('index.php/administration/editRentals/'.$rental->id )?>" class="button" title="" >Back</a> <input type="submit" value="Preview" class="alt_btn">
        </div>
    </footer>
</article><!-- end of post new article -->