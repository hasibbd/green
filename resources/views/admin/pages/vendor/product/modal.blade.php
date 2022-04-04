<!-- Modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span> Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_submit" enctype="multipart/form-data">
                <div class="modal-body row">
                    <input type="hidden" name="product_id" id="product_id">

                    <div class="form-group col-6">
                        <label for="category">Category</label>
                        <select class="form-control" name="category" id="category">
                            <option selected disabled value="0">Select Category...</option>
                            @foreach($category as $a)
                            <option value="{{$a->id}}">{{$a->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="category">Brand</label>
                        <select class="form-control" name="brand" id="brand">
                            <option selected value="0">All</option>
                            @foreach($brand as $b)
                                <option value="{{$b->id}}">{{$b->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="products">Product</label>
                        <select class="form-control" name="products" id="products">

                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="vendor_price">Vendor Price</label>
                        <input type="number" class="form-control" id="vendor_price" name="vendor_price"
                               placeholder="Vendor Price" required>
                    </div>

                    <div class="form-group col-6">
                        <label for="sell_price">Sell Price</label>
                        <input type="number" class="form-control" id="sell_price" name="sell_price" placeholder="Sell Price"
                               required>
                    </div>
                    <div class="form-group col-6">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantity"
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="sub_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
