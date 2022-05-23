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
                       <div class="card">
                           <div class="card-header text-right">
                               @if(Auth::user()->role == 2)
                                   <input type="hidden" name="order_no" id="o_no">
                                   <button class="btn btn-sm btn-primary" onclick="DeliverAll()">Deliver All</button>
                               @endif
                           </div>
                           <div class="card-body">
                               <input type="hidden" name="id" id="id">
                               <table class="table table-bordered " id="seller_order">
                                   <thead>
                                   <tr>
                                       <th>Name</th>
                                       <th>Brand</th>
                                       <th>Price</th>
                                       <th>Stock</th>
                                       <th>Order Qty</th>
                                       @if(Auth::user()->role == 2)
                                           <th>Action</th>
                                       @endif
                                   </tr>
                                   </thead>

                                   <tbody>

                                   </tbody>
                               </table>
                           </div>
                       </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="sub_btn">Save</button>
                </div>
        </div>
    </div>
</div>
