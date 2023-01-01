<?php echo $header ?>

<?php echo $this->session->flashdata('response'); ?>
<form class="form-horizontal form-bordered" action="<?php echo $baseurl; ?>welcome/post_insert" method="post" enctype='multipart/form-data'>
<div class="form-group row">
    <label class="col-lg-3 control-label text-lg-right pt-2">Post Title</label>
    <div class="col-lg-6">
        <div class="input-group">
            <span class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> </span>
            </span>
            <input type="text" name="title" class="form-control" placeholder="Post Title">
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 control-label text-lg-right pt-2">Post Content</label>
    <div class="col-lg-6">
        <div class="input-group">
            <!-- <span class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i> </span>
            </span> -->
                <textarea name="content" class="summernote" data-plugin-summernote
                    data-plugin-options='{ "height": 280, "codemirror": { "theme": "ambiance" } }'> 
                </textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center mt-3">
        <button class="btn btn-success ">Add</button>
    </div>
</div>
</form>

<?php echo $footer ?>