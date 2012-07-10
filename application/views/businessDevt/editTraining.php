<?php message() ?>
<?php $options = array('error'=>'Select...','staff'=>'Staff','stakeholder'=>'Stakeholder') ?>
<article class="module width_full">
    <header>
        <h3>Training Result</h3>
    </header>
    <div class="module_content">
        <?php if (isset($training)) { ?>
            <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Topic</th>
                        <th>Total Trainee</th>
                        <th>Date Started</th>
                        <th>Date Ended</th>
                        <th><?php echo anchor('index.php/businessDevt/training/' . $group, 'Grouping') ?></th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($training as $value) { ?>
                        <tr>
                            <td>
                                <?php echo anchor('index.php/businessDevt/branchAnalysis/' . $value->branchcode, $value->location,array('title'=>'Branch Information')); ?>
                            </td>
                            <td>
                                <?php echo anchor('index.php/businessDevt/viewTraining/'.$value->id,$value->topic) ?>
                            </td>
                            <td>
                                <?php echo $value->totalPeopleTrained ?>
                            </td>
                            <td><?php echo date('d/M/Y', $value->dateStart) ?></td>
                            <td><?php echo date('d/M/Y', $value->dateEnd) ?></td>
                            <td><?php echo $value->type ?></td>
                            <td><?php echo anchor(base_url('index.php/businessdevt/editTraining/'.$value->id),img(site_url('images/icn_edit.png')),array('title'=>'Edit')) ?>
            <?php echo anchor(base_url('index.php/businessdevt/deleteCardIssued/'.$value->id),img(site_url('images/icn_trash.png')),array('title'=>'Delete')) ?></td>
                        </tr>    
                    <?php } ?>

                </tbody>
            </table>
        <?php } else { ?>
            <h4 class="alert_info">There is no training information in system at the moment.</h4>
        <?php } ?>
    </div>

</article>

<?php $action = 'index.php/businessdevt/submitTraining' ?>
<article class="module width_full" id="epccIssued">
    <?php message() ?>
    <?php echo form_open($action) ?>
    <header><h3>Training Section</h3></header>
    <div class="module_content">
        <fieldset>
            <ul>
                <li>
                    <label>Topic:</label>
                    <input type="text" name="topic" value="<?php echo $result->topic ?>" style="width: 200px"> 
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Date Started:</label>
                    <input type="text" name="dateStarted" value="<?php echo date('d M Y',$result->dateStart) ?>" style="width: 200px"><div class="clear"></div>
                </li>
                <li>
                    <label>Date Ended:</label>
                    <input type="text" name="dateEnded" value="<?php echo date('d M Y',$result->dateEnd) ?>" style="width: 200px"><div class="clear"></div>
                </li>
                <li>
                    <label>Total Trainees</label>
                    <input type="text" name="total" value="<?php echo $result->totalPeopleTrained ?>" style="width: 200px">
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Group</label>
                    <?php echo form_dropdown('group', $options, $result->type); ?>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Summary:</label>
                    <textarea cols="10" rows="7" name="summary" id="summary"></textarea>
                </li>
            </ul>

        </fieldset>

        <div class="clear"></div>
    </div>
    <footer>
        <div class="submit_link">
            <input type="submit" value="Save" class="alt_btn">
        </div>
    </footer>
</article><!-- end of post new article -->