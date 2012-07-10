<section>
    <span>Total Epcc Card Issued In the </span><span class="monthName"><?php echo getMonthName($month) ?></span> is <span class="number"><?php echo $totalCardIssued ?></span>
</section>
<?php $action = 'index.php/businessdevt/submitEpcc' ?>
<article class="module width_full" id="epccIssued" style="margin-bottom: 20px">
    <?php echo form_open($action) ?>
    <header><h3>TOTAL EPCC ISSUED FOR THIS MONTH</h3></header>
    <div class="module_content">
        <fieldset>
            <label>Card Issued</label>
            <input type="text" name="epccIssued" style="width: 200px">
            <select name="branchcode">
                <option value="select">select...</option>
            </select>
        </fieldset>

        <div class="clear"></div>
    </div>
    <footer>
        <div class="submit_link">
            <input type="submit" value="Save" class="alt_btn">
        </div>
    </footer>
    
</article>
<?php echo form_close() ?>


<div class="tab_container">
<?php echo form_open('index.php/businessdevt/multiDelete') ?>
<table class="tablesorter" cellspacing="0">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Branch Code</th>
            <th>Location</th>
            <th>Card Issued</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($results as $row) {?>
        <tr>
            <td><input type="checkbox" name="multi[]" value="<?php echo $row->id; ?>" class="selectme"/></td>
            <td><?php echo $row->branchcode ?></td>
            <td><?php echo $row->location ?></td>
           
            <td><?php echo $row->epccIssued ?></td>
            <td><?php echo anchor(base_url('index.php/businessdevt/editCardIssued/'.$row->id),img(site_url('images/icn_edit.png'))) ?>
            <?php echo anchor(base_url('index.php/businessdevt/deleteCardIssued/'.$row->id),img(site_url('images/icn_trash.png'))) ?></td>
        </tr>
        <?php } ?>
    </tbody>
<?php
?>
</table>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo img(site_url('images/arrow_ltr.png')); ?> <label><input type="checkbox" name="checkall" id="checkall" value="Select All" />Select All To</label>
<input type="submit" id="deleteAll" value="Delete" name="deleteAll" />
<?php echo form_close() ?>
</div>