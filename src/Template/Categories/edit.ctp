<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo __('Categories')?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo __('Categories')?></a></li>
        <li class="active"><?php echo __('Add')?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      
      <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo __('Edit Category'); ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <?php echo $this->Form->create($category, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'data-toggle' => 'validator']);?>
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <?php 
            			echo $this->Form->input('name', [
                    				'required' => 'required',
            			            'type' => "text",
            			            'class' => "form-control",
            			            'placeholder' => 'Enter Name',
            			            'label' => false,
            						'tabindex' => '1'
                    		]);?> <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="form-group">
                    <label for="slug" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-10">
                        <?php 
            			echo $this->Form->input('slug', [
                    				'required' => 'required',
            			            'type' => "text",
            			            'class' => "form-control",
            			            'placeholder' => 'Enter Category Slug',
            			            'label' => false,
            						'tabindex' => '2'
                    		]);?> <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="slug" class="col-sm-2 control-label">Image</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="btn btn-primary" for="my-file-selector">
                        <input id="my-file-selector" type="file" style="display:none;" name="image" onchange="$('#upload-file-info').html($(this).val());">
                        Upload
                    </label>
                    <span class='label label-info' id="upload-file-info"></span>
                </div>
                <div class="form-group">
                    <label for="slug" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="category_description" placeholder="Enter Category Description"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="slug" class="col-sm-2 control-label">Published</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="published" style="margin-top:10px;">                    
                    </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default"><?php echo __('Cancel')?></button>
                <button type="submit" class="btn btn-info pull-right"><?php echo __('Save')?></button>
              </div>
              <!-- /.box-footer -->
             <?php echo $this->Form->end();?>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          
        </div>
        
        </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>