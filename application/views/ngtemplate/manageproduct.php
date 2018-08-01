<div class="container-fluid">
    <section class="d-flex align-items-center p-1">
        <h1 class="h5 mb-0 d-inline">Manage Products</h1>&nbsp;
        <a href="<?php echo base_url(); ?>admin/product/add" class="btn btn-primary btn-sm">Add</a>
    </section>
    
    <div class="table-responsive table-sm">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheckAll">
                            <label class="custom-control-label" for="customCheckAll"></label>
                        </div>
                    </th>
                    <th class="text-center" scope="col">ID</th>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Image</th>
                    <th class="text-center" scope="col">Posted at</th>
                    <th class="text-center" scope="col">Price</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in items">
                    <td>                        
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck{{item.id}}">
                            <label class="custom-control-label" for="customCheck{{item.id}}"></label>
                        </div>
                    </td>
                    <th scope="row" class="text-center">{{item.id}}</th>
                    <td>{{item.name}}</td>
                    <td class="text-center"><img ng-src="{{item.src}}" alt="" height="25"></td>
                    <td class="text-center">{{item.created_at|date:"short"}}</td>
                    <td class="text-right">{{item.price|currency}}</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>                
            </tbody>
        </table>
    </div>
    Page {{currentPage}} of {{pagesCount}}.
    <div class="btn-group">
        <button ng-repeat="pageIndex in pages" type="button" class="btn btn-outline-dark btn-sm" ng-click="toPage(this)">{{pageIndex}}</button>
    </div>
</div>