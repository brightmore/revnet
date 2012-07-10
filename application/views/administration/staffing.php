<?php if ( $activeStaff != null) { ?>
    <?php echo form_open('index.php/administration/', array('name'=>'staffing','id'=>'staffing')) ?>
    <article class="module width_full">
        <header>
            <h3>Vehicles </h3>
        </header>
        <div class="module_content">
            <table class="tablesorter" cellspacing="0">
                <thead>
                <th>&nbsp;</th>
                
                <th>Name</th>
                <th>Branch</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach ($activeStaff as $value) { ?>
                        <tr>
                            <td><input name="multi[]" type="checkbox" value="<?php echo $value->id ?>" /></td>
                            <td><?php echo $value->name ?></td>
                            <td><?php echo anchor('index.php/administration/StaffsInBranch/'.$value->branchcode, $value->location,
                                    array('title' => 'Click to view all staff under this branch')) ?></td>
                            <td><?php $value->contact; ?></td>
                            <td><?php echo $value->email ?></td>
                            <td>
                                <?php echo anchor(base_url('index.php/administration/editVehicle/' . $value->id), img(site_url('images/icn_edit.png')), array('title' => 'Edit')) ?>
                                <?php echo anchor(base_url('index.php/administration/deleteVehicle/' . $value->id), img(site_url('images/icn_trash.png')), array('title' => 'Delete')) ?>
                                <?php echo anchor(base_url('index.php/administration/viewVehicle/' . $value->id),'View') /* img(site_url('images/icn_view.png')), array('title' => 'Vehicle Details')*/?>   
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
            <?php echo $pagination ?>
        </div>
    </article>
<?php echo form_close() ?>
<?php } else { ?>
    <h4 class="alert_info">There no Staff info at the moment...</h4>
<?php } ?>