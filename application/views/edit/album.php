<?php $albumDetails = $data['albumDetails']; unset($data['albumDetails']);?>


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
    <div class="row first-row">        
        <div class="col-md-12">
            <div>
                <form  method="POST" class="form-horizontal" role="form" id="updateData" action="<?=BASE_URL?>data/updateAlbumJson" onsubmit="return validate()">
                    <?=$viewHelper->displayDataInForm($albumDetails->description)?>
                </form>                
            </div>
        </div>
    </div>    
</div>

<div id="grid" class="container-fluid">
    <div id="posts">
<?php foreach ($data as $row) { ?>
        <div class="post">
            <?php $actualID = $viewHelper->getActualID($row->id); ?>
            <a href="<?=BASE_URL?>describe/photo/<?=$row->albumID . '/' . $row->id?>" title="View Details">
                <img src="<?=PHOTO_URL . $row->albumID . '/thumbs/' . $actualID . '.jpg'?>">
                <?php
                    $caption = $viewHelper->getDetailByField($row->description, 'Caption');
                    if ($caption) echo '<p class="image-desc"><strong>' . $caption . '</strong></p>';
                ?>
            </a>
        </div>
<?php } ?>
    </div>
</div>

<script type="text/javascript" src="<?=PUBLIC_URL?>js/addnewfields.js"></script>
<script type="text/javascript" src="<?=PUBLIC_URL?>js/validate.js"></script>