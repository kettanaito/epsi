<?php
    /* Template name: Front page */
    get_header();
    page_header('transparent');
    content_begin();
?>
<ul class="showcase full-screen">
    <li>
        <div class="info col-xs-10 col-sm-6 col-lg-5">
            <h1>Гостинная</h1>
            <p>Современное оформление гостинной в стиле модерн для уютных домашних поседелок и встречь с гостями.</p>
            <a class="button button-hollow" href="#">
                <span><i class="fa fa-bars"></i><span class="button-label">Подробнее</span></span>
            </a>
        </div>
        <div class="background" style="background-image: url('http://cdn.home-designing.com/wp-content/uploads/2011/01/open-living-room.jpg')"></div>
    </li>
</ul>
<?php
    content_end();
    get_footer('empty');
?>
