<div class="container">
    <div class="row first-row">
        <!-- Column 1 -->
        <div class="col-md-12 text-center">
            <ul class="list-inline sub-nav">
                <li><a href="<?=BASE_URL?>listing/collections">Photo Collection</a></li>
                <li><a>·</a></li>
                <li><a href="<?=LETTERS_URL?>">Letters</a></li>
                <li><a>·</a></li>
                <li><a>Search</a></li>
                <li id="searchForm">
                    <form class="navbar-form" role="search" action="<?=BASE_URL?>search/field/" method="get">
                        <div class="input-group add-on">
                            <input type="text" class="form-control" placeholder="Keywords" name="description" id="description">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row gap-above-med">
        <div class="col-md-12">
            <p class="journal-article-title">JSON details for Albums / Photos successfully updated</p>
            <p class="journal-article-subtitle">Task completed</p>
            <ul>
            <?php foreach ($data as $row) { ?>
                <li><?=$row?></li>
            <?php } ?>
            </ul>
        </div>
    </div>
</div>