<?php echo $header ?>
<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">Community</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->
<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
        <?php foreach($posts as $post){ ?>
        <div class="col-md-6">
            <div class="product-body">
                <h2 class="product-name"><?php echo $post->title; ?></h2>
                <div class="product-btns">
                <?php 
                echo $post->user; 
                $comments = $this->User_model->getComments($post->id);
                $count = 0;
                foreach($comments as $c){
                    $count+=1;
                }
                
                ?>
                <table runat="server" id="tbldescriptions" cellpadding= "0" cellspacing="0">
                    <?php echo stripslashes($post->content); ?>
                    </table>
                </div>
                <div>
                    <a href="<?php echo base_url()?>comment/<?php echo "demo".'/'."Community" ?>"><?php echo $count; ?> Review(s) / Add Review</a>
                </div>
                

                
            </div>
        </div>
        <?php } ?>
        <div class="col-md-6">
        <div class="product-btns">
        <a class="primary-btn" href='<?php echo base_url()?>/create_post'  <?php if($this->session->userdata('logged_in')!=true) echo 'disabled' ?>>Create Post</a>
	</div>
</div>

        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->
    <?php echo $footer ?>