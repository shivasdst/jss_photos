

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
        <div class="col-md-9">
            <ul class="pager">
                <?php if($data->neighbours['prev']) {?> 
                <li class="previous"><a href="<?=BASE_URL?>describe/photo/<?=$data->albumID?>/<?=$data->albumID . '__' . $data->neighbours['prev']?>">&lt; Previous</a></li>
                <?php } ?>
                <?php if($data->neighbours['next']) {?> 
                <li class="next"><a href="<?=BASE_URL?>describe/photo/<?=$data->albumID?>/<?=$data->albumID . '__' . $data->neighbours['next']?>">Next &gt;</a></li>
                <?php } ?>
            </ul>
            <?php $actualID = $viewHelper->getActualID($data->id); ?>
             <div id="viewletterimages" class="image-full-size">
                <img class="img-responsive" src="<?=PHOTO_URL . $data->albumID . '/' . $actualID . '.jpg'?>">
            </div>
            
        </div>            
        <div class="col-md-3">
            <div class="image-desc-full">
                <ul class="list-unstyled">
                    <?=$viewHelper->displayFieldData($data->description)?>
                   <?php if(isset($_SESSION['login'])) {?>
                    <li>
                            <a href="<?=BASE_URL?>edit/photo/<?=$data->albumID?>/<?=$viewHelper->getActualID($data->id)?>" class="btn btn-primary" role="button">Contribute</a>
                    </li>                
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
     <script type="text/javascript" src="<?=PUBLIC_URL?>js/viewer.js"></script>
