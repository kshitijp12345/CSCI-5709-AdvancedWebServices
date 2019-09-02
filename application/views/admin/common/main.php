<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/common/header'); ?>

    <div class="container" id="content_wrapper">
        <?php echo $the_view_content; ?>
    </div>

<?php $this->load->view('admin/common/footer');?>