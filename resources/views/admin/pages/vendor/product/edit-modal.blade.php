<!-- Modal -->
<div class="modal fade" id="edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span> Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_submit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="e_id">
                    <div class="form-group ">
                        <label for="vendor_price">Vendor Price</label>
                        <input type="number" class="form-control" id="e_vendor_price" name="vendor_price"
                               placeholder="Vendor Price" required>
                    </div>

                    <div class="form-group ">
                        <label for="sell_price">Sell Price</label>
                        <input type="number" class="form-control" id="e_sell_price" name="sell_price" placeholder="Sell Price"
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
