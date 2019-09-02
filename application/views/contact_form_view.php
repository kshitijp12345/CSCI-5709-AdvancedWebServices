<div class="col-md-6 col-md-offset-3" style="margin-left: auto; margin-right: auto;">
    <div class="panel panel-default">
        <div class="panel-heading">
        	<br><br>
            <h4 class="panel-title selected_tab_title">Contact Form - DFI</h1>
        </div>
        <form method="post">
        <div class="panel-body">
            <?php $attributes = array("name" => "contactform");
            echo form_open("contactform/index", $attributes);?>
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" name="name" placeholder="Your Full Name" type="text" value="<?php echo $name; ?>" />
                <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email ID</label>
                <input class="form-control" name="email" placeholder="Email-ID" type="text" value="<?php echo $this->session->email; ?>" />
                <span class="text-danger"><?php echo form_error('email'); ?></span>
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input class="form-control" name="subject" placeholder="Subject" type="text" value="<?php echo set_value('subject'); ?>" />
                <span class="text-danger"><?php echo form_error('subject'); ?></span>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" rows="4" placeholder="Message"><?php echo set_value('message'); ?></textarea>
                <span class="text-danger"><?php echo form_error('message'); ?></span>
            </div>

            <div class="form-group">
                <p>
					<button type="reset" class="btn btn-secondary">Reset</button>
					<button name="submit" type="submit" class="btn btn-success">Submit</button>
                </p>
            </div>
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
        </div>
        <br>
        </form>
    </div>
</div>
