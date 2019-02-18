    <h1 class="mt-5">Add book</h1>
    <div>
        <form enctype="multipart/form-data" method="post" name="addBook" id="addBook" action="/add/" role="form">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTitle">Title</label>
                    <input type="text" name="title" placeholder="Book title" required class="form-control" id="inputTitle" minlength="2" maxlength="255">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAuthor">Author</label>
                    <select id="inputAuthor" name="author" required class="form-control">
                        <?php
                        foreach ($data['authors'] as $value) {
                            ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['authname']; ?></option>
                        <?php }; ?>
                    </select>
                </div>
                <div class="form-group col-md-10">
                    <label for="inputDescription">Description</label>
                    <textarea required name="description_b" class="form-control" placeholder="Book description" id="inputDescription" minlength="20" maxlength="1000"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <div class="input-group image-preview">
                        <input type="text" name="image" class="form-control image-preview-filename" disabled="disabled">
                        <span class="input-group-btn">
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" name="image_l" required accept="image/png, image/jpeg" />
                    </div>
                </span>
                    </div>
                </div>
                <input type="hidden" value="1" name="insert_book">
            </div>
            <div class="form-group col-md-10" id="messages"></div>
            <button id="submit" class="btn btn-primary">Add book</button>
        </form>
    </div>