<article class="module width_full">
    <header>
        <h3><?php echo $training->topic ?></h3>
    </header>
    <div class="module_content">

        <ul>
            <li>
               
                <div> <label>Date Started:</label><span><?php echo date('d M Y',$training->dateStart) ?></span></div>
            </li>
            <li>
                <div><label>Date Ended:</label><span><?php echo date('d M Y',$training->dateEnd) ?></span></div>
            </li>
            <li>
                <div>
                    <label>Group:</label><span><?php echo $training->type ?></span>
                </div>
            </li> 
            <li>
                <div><label>Total Trainees:</label><?php echo $training->totalPeopleTrained ?></div>
            </li>
            <li>
                <div>
                    <?php echo $training->note ?>
                </div>
            </li>
           
        </ul>
        
       
    </div>
</article>