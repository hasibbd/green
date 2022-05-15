<!-- Modal -->
<div class="modal fade" id="limit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span>Store Sales Limit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="limit_submit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="user_id_limit">
                    <div class="form-group ">
                        <label for="title">Limit</label>
                        <input type="number" class="form-control" id="limit" name="limit" placeholder="limit" required>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary load" id="sub_btn">Save</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
