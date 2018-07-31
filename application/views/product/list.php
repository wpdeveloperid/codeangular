<div class="container my-1">
    <header>
        <h1>Products</h1>
    </header>
    <main>
        <div class="my-1">
            <form action="<?php echo base_url(); ?>product/list" method="get" class="form-inline">
                <?php echo form_input(array(
                    'name'      => 'query',
                    'class'=>'form-control mr-1',
                    'placeholder'=>'Search',
                    'ng-change' => 'productFilter()',
                    'ng-model'  => 'query')); ?>
                <?php echo form_input(array(
                    'name'=>'minprice',
                    'class'=>'form-control mr-1',
                    'placeholder'=>'Min Price',
                    'type'=>'number',
                    'min'=>'0',
                    'max'=>'1000000000000000',
                    'ng-change' => 'productFilter()',
                    'ng-model'  => 'minPrice')); ?>
                <?php echo form_input(array(
                    'name'=>'maxprice',
                    'class'=>'form-control mr-1',
                    'placeholder'=>'Max Price',
                    'type'=>'number',
                    'min'=>'1',
                    'max'=>'1000000000000000',
                    'ng-change' => 'productFilter()',
                    'ng-model'  => 'maxPrice')); ?>
                <?php $options = array(
                    'newest'    => 'Newest',
                    'lowprice'  => 'Lowest Price',
                    'highprice' => 'Highest Price',
                    'az'        => 'Name Ascending',
                    'za'        => 'Name Descending'
                );
                echo form_dropdown('orderby', $options, 'newest', array(
                    'ng-change'=>'productFilter()',
                    'ng-model'=>'orderBy',
                    'class'=>'form-control mr-1'
                ));
                ?>
                <?php //echo form_submit('submit', 'Filter');?>
                <?php echo form_button('reset', 'Reset', array(
                    'ng-click'=>'reset()',
                    'class'=>'btn btn-info'
                )); ?>
            </form>
        </div>

        <div class="my-1 d-flex justify-content-between align-items-center" ng-show="!showAlert">
            <div>Showing {{from}} &ndash; {{to}} of {{itemsCount}} items.</div>
            <div class="btn-group">
                <button ng-repeat="pageIndex in pages" type="button" class="btn btn-outline-dark" ng-click="toPage(this)">{{pageIndex}}</button>
            </div>
        </div>
        <div class="alert alert-danger" ng-show="showAlert" role="alert">
            {{message}}
        </div>
        <div class="row my-1">
            <div ng-repeat="item in items" class="col-md-6 col-lg-3 my-1">
                <div class="card">
                    <div>
                        <a href="<?php echo base_url(); ?>product/detail/{{item.id}}/">
                            <img ng-src="{{item.src}}" width=200 height=200 class="img-fluid card-img-top product__loader">
                        </a>

                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h5>{{item.name}}</h5>
                        </div>
                        <div class="card-text">{{item.price|currency:"IDR":0}}</div>
                    </div>

                </div>

            </div>
        </div>

    </main>

</div>