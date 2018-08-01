<div ng-controller="addProductCtrl">
<div class="container-fluid">
    <section class="p-1">
        <h1 class="h5 mb-0">Add Product{{tinymceModel}}</h1>
    </section>
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
</div>
</div>