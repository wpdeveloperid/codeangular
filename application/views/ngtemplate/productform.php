<div class="container-fluid">
    <section class="p-1">
        <h1 class="h5 mb-0">{{action.charAt(0).toUpperCase()+action.slice(1)}} Product</h1>
        <div class="alert alert-{{alertType}}" ng-hide="hideAlert">{{message}}</div>
    </section>
    <?php echo form_open_multipart('product/add'); ?>
    <?php echo form_input(array(
        'name'      => 'name',
        'class'=>'form-control',
        'placeholder'=>'Product Name',
        'ng-model'  => 'name')); ?>
    <?php echo form_input(array(
        'name'      => 'price',
        'type'=>'number',
        'min'=>'0',
        'max'=>'1000000000000000',
        'class'=>'form-control',
        'placeholder'=>'Price',
        'ng-model'  => 'price')); ?>
    <?php echo form_textarea(array(
        'name'=>'description',
        'class'=>'form-control tinymce',
        'ng-model'=>'description',
        'placeholder'=>'Description',
        'ui-tinymce'=>'tinymceOptions'
    )) ?>
    <input type="file" ngf-select ng-model="image" name="image" accept="jpeg" class="form-control-file">
    <img ng-src="{{src}}" alt="" width=300 ng-hide="hideImage">
    <?php echo form_button('submit','Store/Update',array(    
        'class'=>'btn btn-dark',    
        'ng-click'=>'storeupdate(image)'
    )); ?>
    <?php echo form_close(); ?>
</div>