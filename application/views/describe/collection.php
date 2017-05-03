<?php $collectionID = $data[0]["collectionID"];?>

<script>
$(document).ready(function(){

    var processing = false;

    var collectionID = <?php echo  '"' . $collectionID . '"';  ?>;

    function getresult(url) {
        $.ajax({
            url: url,
            type: "GET",
            beforeSend: function(){
                $('#loader-icon').show();
            },
            complete: function(){
                $('#loader-icon').hide();
            },
            success: function(data){
                processing = true;
                // console.log(data);
                var gutter = parseInt(jQuery('.post').css('marginBottom'));
                var $grid = $('#posts').masonry({
                    gutter: gutter,
                    // specify itemSelector so stamps do get laid out
                    itemSelector: '.post',
                    columnWidth: '.post',
                    fitWidth: true
                });
                var obj = JSON.parse(data);
                var displayString = "";
                for(i=0;i<Object.keys(obj).length-1;i++)
                {                    
                    // console.log(obj[i].Event);    
                    // console.log(JSON.parse(obj[i].description).Title);

                    displayString = displayString + '<div class="post">';    
                    displayString = displayString + '<a href="' + <?php echo '"' . BASE_URL . '"'; ?> + 'listing/photos/'+ obj[i].albumID + '" title="View Album">';
                    displayString = displayString + '<div class="fixOverlayDiv">';
                    displayString = displayString + '<img class="img-responsive" src="' + obj[i].Randomimage + '">';
                    displayString = displayString + '<div class="OverlayText">' + obj[i].Photocount + '<br /><small>' + obj[i].Event + '</small> <span class="link"><i class="fa fa-link"></i></span></div>';
                    displayString = displayString + '</div>';
                    displayString = displayString + '<p class="image-desc">';
                    displayString = displayString + '<strong>' + obj[i].Title + '</strong>';    
                    displayString = displayString + "</p>";    
                    displayString = displayString + '</a>'; 
                    displayString = displayString + '</div>';

                }

                var $content = $(displayString); 
                $content.css('display','none');

                $grid.append($content).imagesLoaded(
                    function(){
                        $content.fadeIn(1000);
                        $grid.masonry('appended', $content);
                        processing = false;
                    }
                );                                     

                displayString = "";

                $("#hidden-data").append(obj.hidden);

            },
            error: function(){console.log("Fail");}             
      });
    }
    $(window).scroll(function(){
        if ($(window).scrollTop() == $(document).height() - $(window).height()){
            if($(".lastpage").length == 0){
                var pagenum = parseInt($(".pagenum:last").val()) + 1;
                // console.log(pagenum);
                // alert(base_url+'describe/collection/'+ collectionID + '?page='+pagenum);
                if(!processing)
                {
                    getresult(base_url+'describe/collection/'+ collectionID + '?page='+pagenum);
                }
            }
        }
    });
});     
</script>
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
<div id="grid" class="container-fluid">
    <div id="posts">
<?php 
    $hiddenData = $data["hidden"]; 
    unset($data["hidden"]);
?>    
<?php foreach ($data as $row) { ?>
        <div class="post">
            <a href="<?=BASE_URL?>listing/photos/<?=$row['albumID']?>" title="View Album">
                <div class="fixOverlayDiv">
                    <img class="img-responsive" src="<?=$viewHelper->includeRandomThumbnail($row['albumID'])?>">
                    <div class="OverlayText"><?=$viewHelper->getPhotoCount($row['albumID'])?><br /><small><?=$viewHelper->getDetailByFieldForAlbum($row['albumID'], 'Event')?></small> <span class="link"><i class="fa fa-link"></i></span></div>
                </div>
                <p class="image-desc">
                    <strong><?=$viewHelper->getDetailByFieldForAlbum($row['albumID'], 'Title')?></strong>
                </p>
            </a>
        </div>
<?php } ?>
    </div>
</div>
<div id="hidden-data">
    <?php echo $hiddenData; ?>
</div>
<div id="loader-icon"><img src="<?=STOCK_IMAGE_URL?>loading.gif" /><div>