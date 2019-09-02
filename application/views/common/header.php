<!DOCTYPE html>
<html lang="en">
	<head>

		 <meta charset="utf-8">
		 <title><?php echo $page_title; ?></title>
		 <meta name="description" content="Dalhousie online forum initiative brings the capabilities of a forum online, rather than the traditional way which members of a society or particular interest need to meet physically to discuss and vote on suggestions/ideas">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.jpg">
		<link type = "text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link type = "text/css" href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<style>
          .card-header {
              color: #fff;
              background-color: #6c757d !important;
              border-color: #6c757d !important;
          }

          .btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active, .show>.btn-secondary.dropdown-toggle {
              color: #fff;
              background-color: #6c757d;
              border-color: #6c757d;
          }

          @media only screen and (min-width: 768px) {
              #search_container {
                width: 100%;
                margin-left: 20%;
                margin-right: auto;
            }

            .categories {
              margin-top: 98px;
            }

            .borderless-group .list-group-item {
              padding-left: 0px;
              padding-right: 0px;
              border: 0 none;
            }
          }

          .material-icons{
            vertical-align: top;
          }
          .hover:hover{
            color:green;
            cursor: pointer;
          }
          .hover2:hover{
            color:red;
            cursor: pointer;
            text-decoration: none!important;
          }
          .blueTxt:hover{
            color: #0056b3;
            cursor: pointer;
          }
          .card {
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;
            margin-bottom: 25px;
          }

          .card:hover {
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.20), 0 3px 15px rgba(0, 0, 0, 0.20) !important;
          }

          .row-mb{
            margin-bottom: 1.5rem;
          }
          .row-mb-1{
            margin-bottom: 1rem;
          }
          @media only screen and (max-width: 512px) {
            .newmt {
              margin-top: 50px;
            }

          }
          @media only screen and (max-width: 768px) {
            .textalign{
              text-align: center;
            }
          }

          textarea{
            overflow:hidden;
            padding:10px;
            width:500px;
            font-size:14px;
            border-radius:10px;
            max-width: 100%;
          }

          footer a {
              color: #989c9e !important;    
          } 
                      
      </style>
	</head>
	<body>


    <nav class="navbar  navbar-expand-lg  navbar-fixed-top">

      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>post">
            <img src="<?php echo base_url(); ?>assets/images/dal-logo.jpg" height="32" alt="Dal Logo"> Connect
        </a>
        <button class="navbar-toggler navbar-light bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
          	<div class="row col-lg-12 col-xs-12 col-sm-12">
      
            	<div class="col-lg-7 col-xs-7 col-sm-12 col-12">
					<?php echo form_open(base_url() .'post/searchPost', 'id="contact_user_form"'); ?>
						<div class="input-group" id="search_container">
							<input type="text" class="form-control" name="searchKeyword" placeholder="Search..." >

							<div class="input-group-append search-button">
								<button class="btn btn-secondary" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</form>
          </div>

            <div class="col-lg-5 col-xs-5 col-sm-4 col-6">
              <ul class="navbar-nav float-lg-right">
                <li id="createPostBtn" data-toggle="modal" data-target="#createPostModal"  class="button btn btn-outline-success">
                   <i class="material-icons">create</i>
                </li> 
          
                <!-- <li class="nav-item active">
                  <a class="nav-link btn btn-info" href="#">Start a Topic </a>
                </li> -->
                
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
                    <a class="dropdown-item" href="<?php echo base_url(); ?>account/profile">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>account/logout">Logout</a>
                  </div>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </nav>
