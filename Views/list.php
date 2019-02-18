<div class="row">
    <div class="col-lg-8 col-sm-12">
        <h2>Books</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($data['books'] as $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value['title']; ?>
                        </td>
                        <td><?php $auth = $data['author']->getById($value['author']);
                            echo $auth['authname'];
                            ?></td>
                        <td>
                            <a href="/edit/<?php echo $value['id']; ?>/" title="Edit">Edit</a>
                            <a href="/delete/<?php echo $value['id'] ?>/" title="Delete" class="trash">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</div>
<div class="row">
    <?php include 'Views/pagination.php'; ?>
</div>
