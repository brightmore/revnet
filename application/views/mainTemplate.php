<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <title><?php echo $title ?></title>

        <link rel="stylesheet" href="<?php echo base_url() ?>css/layout.css" type="text/css" media="screen" />
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?php echo base_url() ?>js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>js/hideshow.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>js/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.equalHeight.js"></script>
        <script type="text/javascript">
            $(document).ready(function() 
            { 
                $(".tablesorter").tablesorter(); 
            } 
        );
            $(document).ready(function() {

                //When page loads...
                $(".tab_content").hide(); //Hide all content
                $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                $(".tab_content:first").show(); //Show first tab content

                //On Click Event
                $("ul.tabs li").click(function() {

                    $("ul.tabs li").removeClass("active"); //Remove any "active" class
                    $(this).addClass("active"); //Add "active" class to selected tab
                    $(".tab_content").hide(); //Hide all tab content

                    var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                    $(activeTab).fadeIn(); //Fade in the active ID content
                    return false;
                });

            });
        </script>
        <script type="text/javascript">
            $(function(){
                $('.column').equalHeight();
            });
        </script>

    </head>


    <body>

        <header id="header">
            <hgroup>
                <h1 class="site_title"><a href="#">View Site</a></h1>
                <h2 class="section_title">REVNET LTD</h2><div class="btn_view_site"><a href="#">Logout</a> </div>
            </hgroup>
        </header> <!-- end of header bar -->

        <section id="secondary_bar">
            <div class="user">
                <p>John Doe (<a href="#">3 Messages</a>)</p>
                <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
            </div>
            <div class="breadcrumbs_container">
                <article class="breadcrumbs"><a href="index.html">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
            </div>
        </section><!-- end of secondary bar -->

        <aside id="sidebar" class="column">
            <form class="quick_search">
                <input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
            </form>
            <hr/>
            <h3>Administration</h3>
            <ul class="toggle">
                <li class="icn_new_article"><a href="<?php echo base_url('index.php/administration/newStaff') ?>">New Staff</a></li>
                <li class="icn_new_article"><a href="<?php echo base_url('index.php/administration/StaffsInBranches') ?>">Staffs In Branches</a></li>
                <li class="icn_edit_article"><a href="<?php echo base_url('index.php/administration/RecruitmentInBranches') ?>">Recruitment In Branches</a>
                    <ul>
                        <li class="icn_new_article"><a href="<?php echo base_url('index.php/administration/StaffsInBranches') ?>">Staffs In Branches</a></li>
                <li class="icn_edit_article"><a href="<?php echo base_url('index.php/administration/RecruitmentInBranches') ?>">Recruitment In Branches</a>
                    </ul>
                </li>
                <li class="icn_categories"><a href="<?php echo base_url('index.php/administration/TerminationAndResignation') ?>">Termination And Resignation</a></li>
                <li class="icn_tags"><a href="<?php echo base_url('index.php/administration/Vehicles') ?>">vehicles</a></li>
                <li class="icn_tags"><a href="<?php echo base_url('index.php/administration/Rentals') ?>">Rentals</a></li>
            </ul>
            <h3>Operations</h3>
            <ul class="toggle">
                <li class="icn_add_user"><a href="<?php echo base_url('index.php/operations/collection'); ?>">Collections</a></li>
                <li class="icn_view_users"><a href="<?php echo base_url('index.php/operations/propertyRate'); ?>">Property Rate</a></li>
                <li class="icn_profile"><a href="<?php echo base_url('index.php/operations/bop'); ?>">BOP</a></li>
            </ul>
            <h3>Corporate Affairs</h3>
            <ul class="toggle">
                <li class="icn_folder"><a href="<?php echo base_url('index.php/CorporateAffairs/newContracts') ?>">New Contracts</a></li>
                <li class="icn_folder"><a href="<?php echo base_url('index.php/CorporateAffairs/allExistingContracts') ?>">All Existing Contracts</a></li>
                <li class="icn_photo"><a href="<?php echo base_url('index.php/CorporateAffairs/contractExpired') ?>">Contract Expired</a></li>
                <li class="icn_audio"><a href="<?php echo base_url('index.php/CorporateAffairs/contractRenewed') ?>">Contract Renewed</a></li>
                <li class="icn_video"><a href="<?php echo base_url('index.php/CorporateAffairs/stakeholderMeetings') ?>">Stakeholder Meetings</a></li>
            </ul>
            <h3>Business Development</h3>
            <ul class="toggle">
                <li class="icn_settings"><a href="<?php echo base_url('index.php/BusinessDevt/') ?>">Epcc Section</a></li>
                <li class="icn_security"><a href="<?php echo base_url('index.php/BusinessDevt/training') ?>">Training</a></li>
                <li class="icn_jump_back"><a href="<?php echo base_url('index.php/BusinessDevt/eduNcampaign')?>">Education & Campaign</a></li>
            </ul>

            <h3>Information Systems</h3>
            <ul class="toggle">
                <li class="icn_settings"><a href="<?php echo base_url('index.php/informationSystems/allSystems') ?>">Systems In All</a></li>
                <li class="icn_security"><a href="<?php echo base_url('index.php/informationSystem/faultySystem') ?>">Faulty Systems</a></li>
                <li class="icn_jump_back"><a href="<?php echo base_url('index.php/informationSystem/newSystem') ?>">New Systems</a></li>
                <li class="icn_jump_back"><a href="<?php echo base_url('index.php/informationSystem/repairdSystem') ?>">Repaired Systems</a></li>
            </ul>
            
            <h3>Finance</h3>
            <ul class="toggle">
                <li class="icn_settings"><a href="<?php echo base_url('index.php/finance/allcommission') ?>">Commission From Branches</a></li>
                <li class="icn_security"><a href="<?php echo base_url('index.php/BusinessDevt/outstanding') ?>">Outstanding From Branches</a></li>
            </ul>


            <footer>
                <hr />
                <p><strong>Copyright &copy; 2012 Revnet</strong></p>
            </footer>
        </aside><!-- end of sidebar -->

        <section id="main" class="column">
            <?php if ($this->session->flashdata('failure')) { ?>
                <h4 class="alert_info"><?php echo $this->session->flashdata('failure') ?></h4>
            <?php } elseif ($this->session->flashdata('warning')) { ?>
                <h4 class="alert_info">  <?php echo $this->session->flashdata('failure') ?></h4>
            <?php } elseif ($this->session->flashdata('success')) { ?>
                <h4 class="alert_info">  <?php echo $this->session->flashdata('success') ?></h4>
            <?php } ?>
            <?php echo $content ?>

        </section>


    </body>

</html>