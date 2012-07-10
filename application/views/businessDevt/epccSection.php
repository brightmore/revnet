<article class="module width_full" >
    <div style="float: left; width: 40%;">
        <h3>EPCC REPORT</h3>
    <ul >
        <li>
            <a href="" >Card Requested In All Branches</a>
        </li>
        
        <li>
            <a href="" ></a>
            <?php echo anchor('index.php/businessdevt/getEpccCardsIssuedInMonthAllBranch','Card Issued In All Branches')  ?>
        </li>
         <li>
            <a href="" >Meetings Organized For Stakeholder</a>
        </li>
         <li>
            <a href="" >Meetings Organized For Staffs</a>
        </li>
    </ul>
    </div>
    
    <div style="float: right; width: 40%;">
        <h3>MEETINGS REPORT</h3>
     <ul >
        <li>
            <a href="" >Number Of Stakeholder Meetings In All Branches</a>
        </li>
        
        <li>
            <a href="" >Number Of Staffs Meetings In All Branches</a>
        </li>
        
    </ul>
    </div>
    <div class="clear"></div>
</article>

<section id="container">

<?php $action = 'index.php/businessdevt/submitEpcc' ?>
<article class="module width_full" id="epccIssued">
    <?php echo form_open($action) ?>
    <header><h3>TOTAL EPCC ISSUED FOR THIS MONTH</h3></header>
    <div class="module_content">
        <fieldset>
            <label>Card Issued</label>
            <input type="text" name="epccIssued" style="width: 200px">
        </fieldset>

        <div class="clear"></div>
    </div>
    <footer>
        <div class="submit_link">
            <input type="submit" value="Save" class="alt_btn">
        </div>
    </footer>
</article><!-- end of post new article -->
<?php echo form_close() ?>
<hr style="margin-top: 10px"/>
<article class="module width_full" id="epccRequest">
     <?php echo form_open($action) ?>
    <header><h3>TOTAL EPCC REQUESTED FOR THIS MONTH</h3></header>
    <div class="module_content">
        <fieldset>
            <label>Card Requested</label>
            <input type="text" name="epccRequest" id="epccRequest" class="card" style="width: 200px">
        </fieldset>
        <div class="clear"></div>
    </div>
    <footer>
        <div class="submit_link">
            <input type="submit" value="Save" class="alt_btn">
        </div>
    </footer>
    <?php echo form_close() ?>
</article><!-- end of post new article -->
</section>