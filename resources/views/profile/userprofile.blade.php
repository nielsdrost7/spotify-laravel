<div id="UserProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Profile</h5>
                <button
                    type="button"
                    aria-label="Close"
                    class="close"
                    data-dismiss="modal"
                >
                    ×
                </button>
            </div>

            <form
                method="POST"
                accept-charset="UTF-8"
                id="showProfileForm"
                enctype="multipart/form-data"
            >
                <div class="modal-body">
                    {{ @csrf_field() }}

                    <div class="modal-body">
                        <div
                            class="alert alert-danger"
                            style="display: none"
                            id="editProfileValidationErrorsBox"
                        ></div>
                        <input id="pfUserId" name="user_id" type="hidden" />
                        <input name="is_active" type="hidden" value="1" />
                        <input
                            type="hidden"
                            name="_token"
                            value="Vx8nrRldDbm1c1tCXwhenn0Xzkb8GqLhnt7GjvIO"
                        />
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="name">Name</label
                                ><span class="required">*</span>
                                <input
                                    id="pfName"
                                    class="form-control"
                                    required=""
                                    name="name"
                                    type="text"
                                />
                            </div>
                            <div class="form-group col-sm-6 d-flex">
                                <div class="col-sm-6 pl-0">
                                    <label for="photo">Profile Image</label>
                                    <label class="edit-profile__file-upload">
                                        Choose your file
                                        <input
                                            id="pfImage"
                                            class="d-none"
                                            name="photo"
                                            type="file"
                                        />
                                    </label>
                                </div>
                                <div
                                    class="
                                        col-sm-3
                                        preview-image-video-container
                                        float-right
                                    "
                                    style="margin-top: 2px"
                                >
                                    <img
                                        id="edit_preview_photo"
                                        class="img-thumbnail"
                                        width="200px;"
                                        src="{{
                                            asset('/img/user-avatar.png')
                                        }}"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="email">Email</label
                                ><span class="required">*</span>
                                <input
                                    id="pfEmail"
                                    class="form-control"
                                    required=""
                                    name="email"
                                    type="text"
                                />
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="phone">Phone</label>
                                <input
                                    id="pfPhone"
                                    class="form-control"
                                    name="phone"
                                    type="text"
                                />
                            </div>
                        </div>
                        <div class="text-right">
                            <button
                                type="submit"
                                class="btn btn-primary"
                                id="btnPrEditSave"
                                data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing..."
                            >
                                Save
                            </button>
                            <button
                                type="button"
                                class="btn btn-light"
                                data-dismiss="modal"
                                style="margin-left: 5px"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
