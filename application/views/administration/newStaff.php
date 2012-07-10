<?php $action = 'index.php/administration/previewNewStaff' ?>
<article class="module width_full" id="epccIssued">
    <?php message() ?>
    <?php echo form_open($action) ?>
    <header><h3>Add New Staff</h3></header>
    <div class="module_content">
        <fieldset>
            <ul>
                <li>
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo set_value('name'); ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('name'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Contact:</label>
                    <input type="text" name="contact" value="<?php echo set_value('contact'); ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('contact'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Date Hired:</label>
                    <input type="text" name="dateHired" value="<?php echo set_value('dateHired'); ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('dateHired'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Email:</label>
                    <input type="text" name="email" value="<?php echo set_value('email'); ?>" style="width: 200px">
                    <span class="form_error"><?php echo form_error('email'); ?></span>
                    <div class="clear"></div>
                </li>
                
                
                 <li>
                    <label>Branch:</label>
                    <?php echo form_dropdown('branchcode', allBranches()) ?>
                     <span class="form_error"><?php echo form_error('branchCode'); ?></span>
                    <div class="clear"></div>
                </li>
                 <li>
                    <label>Department:</label>
                    <?php echo form_dropdown('depcode', departments()) ?><span class="form_error"><?php echo form_error('depcode'); ?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Address:</label>
                    <textarea cols="10" rows="4" name="address" id="address"></textarea>
                  <span class="form_error">  <?php echo form_error('address'); ?></span><div class="clear"></div>
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