<!-- Modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span> Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_submit" enctype="multipart/form-data">
                <div class="modal-body">
                    <img id="previewImg" class="img-thumbnail" src="{{asset('/storage/brand/default.png')}}" alt="photo" style="width: 150px; height: 100px">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group ">
                            <label for="photo">Photo</label> <br>
                            <input type="file" id="photo" name="photo" onchange="previewFile(this);">
                        </div>
                    <div class="form-group ">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                    </div>
                        <div class="form-group ">
                            <label for="sort">Sort</label>
                            <input type="number" min="1" class="form-control" id="sort" name="sort" placeholder="Sort" required>
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
