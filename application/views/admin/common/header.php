<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $page_title; ?> </title>
        <meta name="description" content="Dalhousie online forum initiative brings the capabilities of a forum online, rather than the traditional way which members of a society or particular interest need to meet physically to discuss and vote on suggestions/ideas">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.jpg">
		<link type = "text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link type = "text/css" href="<?php echo base_url(); ?>assets/css/admin/admin_style.css" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <button class="navbar-toggler pull-left" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>&nbsp;
                    <a href="<?php echo base_url(); ?>admin/post">
                        <img src="<?php echo base_url(); ?>assets/images/dal-logo.jpg" height="32" alt="Dal Logo"> Connect
                    </a>    
                </div>
      
    
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item <?php if($this->uri->segment(2) =='post') { echo 'active'; } ?>">
                            <a class="nav-link" href="<?php echo base_url(); ?>admin/post">Posts</a>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(2) =='user') { echo 'active'; } ?>">
                            <a class="nav-link" href="<?php echo base_url(); ?>admin/user">Users </a>
                        </li>
                        <li class="nav-item <?php if($this->uri->segment(2) =='feedback') { echo 'active'; } ?>">
                            <a class="nav-link" href="<?php echo base_url(); ?>admin/feedback">Feedback </a>
                        </li>
                    </ul>
                </div>
    
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> 
                            <?php 
                                if(isset($name)) {
                                    echo $name;
                                } else {
                                    echo "Account";
                                }
                            ?> 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Help</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>account/logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    
