<div class="col-lg-12 col-sm-12 p_nav">
    <?php
        if($data['pages']['page_list'] && count($data['pages']['page_list']) > 1) {
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
                if($data['pages']['show_prev']) {
                ?>
                <li class="page-item"><a class="page-link" href="/list/<?php echo ($data['pages']['page_active'] - 1); ?>">Previous</a></li>
                <?php
            }
            foreach ($data['pages']['page_list'] as $page) {
                ?>
                <li class="page-item <?php if($page == $data['pages']['page_active']) {echo 'active'; }; ?>"><a class="page-link" href="/list/<?php echo $page; ?>"><?php echo $page; ?></a></li>
                <?php
            }
            if($data['pages']['show_next']) {
                ?>
                <li class="page-item"><a class="page-link" href="/list/<?php echo ($data['pages']['page_active'] + 1); ?>">Next</a></li>
                <?php
            }
            ?>
        </ul>
    </nav>
    </div>
<?php
        }