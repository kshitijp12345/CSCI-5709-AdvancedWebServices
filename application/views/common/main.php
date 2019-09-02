<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('common/header'); ?>

    <div class="container" style="min-height: 600px;">
        <?php echo $view_content; ?>
    </div>

<?php $this->load->view('common/footer');?>