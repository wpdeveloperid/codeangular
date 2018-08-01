<div class="container my-1">
    <div class="my-1 d-flex justify-content-between">
        <div>
            <h1>{{item.name}}</h1>
        </div>
        <div>
            <button onclick="window.history.back()" class="btn btn-outline-dark">Back</button>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3">
            <img src="{{item.src}}" alt="" class="img-fluid img-thumbnail">
        </div>
        <div class="col-lg-6">

            <div>Price: {{item.price|currency:"IDR":0}}</div>
            <div>Description: {{item.description}}</div>
        </div>
        <div class="col-lg-3">
            <div>Posted at: {{item.posted_at|date:"medium"}}</div>
            <div class="my-1">
                <button class="btn btn-info btn-block">Add to cart</button>
            </div>
            <div class="my-1">
                <button class="btn btn-info btn-block">Purchase &amp; checkout</button>
            </div>
        </div>
    </div>
</div>