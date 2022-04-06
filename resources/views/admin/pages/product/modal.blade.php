<!-- Modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="mdl_ttl"></span> Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_submit" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="text-center">
                        <img id="previewImg" class="img-thumbnail" src="{{asset('/storage/brand/default.png')}}" alt="photo" style="width: 200px; height: 200px">

                    </div>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="photo">Photo</label> <br>
                        <input type="file" id="photo" name="photo" onchange="previewFile(this);">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_id">Category</label>
                            <select class="form-control" name="category" id="category">
                                <option selected disabled>Select...</option>
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_id">Unit</label>
                            <select class="form-control" name="unit" id="unit">
                                <option selected disabled>Select...</option>
                                @foreach($units as $u)
                                    <option value="{{$u->id}}">{{$u->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="user_id">Brand</label>
                            <select class="form-control" name="brand" id="brand">
                                <option selected disabled>Select...</option>
                                @foreach($brands as $b)
                                    <option value="{{$b->id}}">{{$b->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" name="r_wallet" id="r_wallet" value="1">
                                <label class="custom-control-label" for="r_wallet">Reserve Wallet</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="short_detail">Sort Details</label>
                            <input type="text"  class="form-control" id="short_detail" name="short_detail" placeholder="Sort" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="detail">Details</label>
                            <textarea  class="form-control" name="detail" id="detail" cols="15" rows="5" required></textarea>
                        </div>
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
