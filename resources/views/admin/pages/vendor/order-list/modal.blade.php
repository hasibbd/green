<!-- Modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span> Order List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                   <table class="table table-bordered data_table" id="seller_order">
                       <thead>
                          <tr>
                              <th>Name</th>
                              <th>Brand</th>
                              <th>Price</th>
                              <th>Stock</th>
                              <th>Order Qty</th>
                              <th>Action</th>
                          </tr>
                       </thead>

                       <tbody>

                       </tbody>
                   </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="sub_btn">Save</button>
                </div>
        </div>
    </div>
</div>
