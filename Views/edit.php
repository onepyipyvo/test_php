    <h1 class="mt-5">Edit book</h1>
    <div>
        <form enctype="multipart/form-data" method="post" name="editBook" id="editBook" action="/do_update/" role="form">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTitle">Title</label>
                    <input type="text" name="title" placeholder="Book title" required class="form-control" id="inputTitle" value="<?php echo $data['book']['title']; ?>" minlength="2" manlength="255">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAuthor">Author</label>
                    <select id="inputAuthor" name="author" required class="form-control">
                        <?php
                        foreach ($data['authors'] as $value) {
                            $selected = '';
                            if($value['id'] == $data['book']['author']) {
                                $selected = 'selected';
                            }
                            ?>
                            <option value="<?php echo $value['id']; ?>" <?php echo $selected; ?>><?php echo $value['authname']; ?></option>
                        <?php }; ?>
                    </select>
                </div>
                <div class="form-group col-md-10">
                    <label for="inputDescription">Description</label>
                    <textarea required name="description_b" class="form-control" placeholder="Book description" id="inputDescription" minlength="20" manlength="1000">
                        <?php echo $data['book']['description_b']; ?>
                    </textarea>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group image-preview">
                        <input type="hidden" value="<?php echo Book::IMG_PATH.$data['book']['image_b']; ?>" class="form-control" id="img_path">
                        <input type="hidden" value="<?php echo $data['book']['image_b']; ?>" class="form-control" id="img_prev" name="img_prev">
                        <input type="text" name="image_b" value="<?php echo $data['book']['image_b']; ?>" class="form-control image-preview-filename" disabled="disabled" id="img_name">
                        <span class="input-group-btn">
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" name="image_l" accept="image/png, image/jpeg" />
                    </div>
                </span>
                    </div>
                </div>

                <input type="hidden" value="1" name="update_book">
                <input type="hidden" value="<?php echo $data['book']['id']; ?>" name="id">
            </div>
            <div class="form-group col-md-10" id="messages"></div>
            <button id="submit_edit" class="btn btn-primary">Save book</button>
        </form>
    </div>