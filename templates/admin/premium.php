<?php
global $YWAR_AdvancedReview;
?>

<style>
    .section{
        margin-left: -20px;
        margin-right: -20px;
        font-family: "Raleway";
    }
    .section h1{
        text-align: center;
        text-transform: uppercase;
        color: #808a97;
        font-size: 35px;
        font-weight: 700;
        line-height: normal;
        display: inline-block;
        width: 100%;
        margin: 50px 0 0;
    }
    .section:nth-child(even){
        background-color: #fff;
    }
    .section:nth-child(odd){
        background-color: #f1f1f1;
    }
    .section-title{
        display: table;
    }
    .section .section-title img{
        display: table-cell;
        vertical-align: middle;
        width: auto;
        margin-right: 15px;
    }

    .section .section-title h2{
        display: table-cell;
        vertical-align: middle;
        padding: 0;
        font-size: 24px;
        font-weight: 700;
        color: #808a97;
        text-transform: uppercase;
    }

    .section .section-title h3 {
        font-size: 14px;
        line-height: 28px;
        margin-bottom: 0;
        display: block;
        padding: 0;
        font-size: 24px;
        font-weight: 700;
        color: #808a97;
        text-transform: uppercase;
    }

    .section p{
        font-size: 13px;
        margin: 25px 0;
    }
    .section ul li{
        margin-bottom: 4px;
    }
    .landing-container{
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
        padding: 50px 0 30px;
    }
    .landing-container:after{
        display: block;
        clear: both;
        content: '';
    }
    .landing-container .col-1,
    .landing-container .col-2{
        float: left;
        box-sizing: border-box;
        padding: 0 15px;
    }
    .landing-container .col-1 img{
        width: 100%;
    }
    .landing-container .col-1{
        width: 55%;
    }
    .landing-container .col-2{
        width: 45%;
    }
    .premium-cta{
        background-color: #808a97;
        color: #fff;
        border-radius: 6px;
        padding: 20px 15px;
    }
    .premium-cta:after{
        content: '';
        display: block;
        clear: both;
    }
    .premium-cta p{
        margin: 7px 0;
        font-size: 14px;
        font-weight: 500;
        display: inline-block;
        width: 60%;
    }
    .premium-cta a.button{
        border-radius: 6px;
        height: 60px;
        float: right;
        background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>upgrade.png) #ff643f no-repeat 13px 13px;
        border-color: #ff643f;
        box-shadow: none;
        outline: none;
        color: #fff;
        position: relative;
        padding: 9px 50px 9px 70px;
    }
    .premium-cta a.button:hover,
    .premium-cta a.button:active,
    .premium-cta a.button:focus{
        color: #fff;
        background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>upgrade.png) #971d00 no-repeat 13px 13px;
        border-color: #971d00;
        box-shadow: none;
        outline: none;
    }
    .premium-cta a.button:focus{
        top: 1px;
    }
    .premium-cta a.button span{
        line-height: 13px;
    }
    .premium-cta a.button .highlight{
        display: block;
        font-size: 20px;
        font-weight: 700;
        line-height: 20px;
    }
    .premium-cta .highlight{
        text-transform: uppercase;
        background: none;
        font-weight: 800;
        color: #fff;
    }

    @media (max-width: 480px){
        .wrap{
            margin-right: 0;
        }
        .section{
            margin: 0;
        }
        .landing-container .col-1,
        .landing-container .col-2{
            width: 100%;
            padding: 0 15px;
        }
        .section-odd .col-1 {
            float: left;
            margin-right: -100%;
        }
        .section-odd .col-2 {
            float: right;
            margin-top: 65%;
        }
    }

    @media (max-width: 320px){
        .premium-cta a.button{
            padding: 9px 20px 9px 70px;
        }

        .section .section-title img{
            display: none;
        }
    }
</style>
<div class="landing">
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    Upgrade to the <span class="highlight">premium version</span>
                    of <span class="highlight">YITH WooCommerce Advanced Reviews</span> to benefit from all features!
                </p>
                <a href="<?php echo $YWAR_AdvancedReview->get_premium_landing_uri(); ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight">UPGRADE</span>
                    <span>to the premium version</span>
                </a>
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>background1.png) no-repeat #fff; background-position: 85% 75%">
        <h1>Premium Features</h1>
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>02.png" alt="Attachment List" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>icon1.png" alt="Attachment List" />
                    <h2>MODAL WINDOW</h2>
                </div>
                <p>Enabling this option, the result of the review filter will be slightly different: the filtered review will be showed in a modal window.</p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>background2.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>icon2.png" alt="Review Title"/>
                    <h2>Load More</h2>
                </div>
                <p>Do you want to hide some of your reviews? Set how many to show with the relative option, and if you want to let users read the rest of them, choose the load more option.</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>01.png" alt="Review Title" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>background3.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>03.png" alt="Vote the review" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>icon3.png" alt="Vote the review" />
                    <h2>Vote the review</h2>
                </div>
                <p>Have you found a review that was particularly good and explicative and that helped you a lot choose a product? Give prominence to it and express your satisfaction or disappointment through the dedicated “upvote” or “downvote” buttons.</p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>background4.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>icon4.png" alt="Number" />
                    <h2>Number</h2>
                </div>
                <p>This feature allows you to provide users with another piece of information concerning each individual review: it displays the number of users that have appreciated it by expressing their preference for it.</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>04.png" alt="Number" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>background5.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>05.png" alt="Filter by rating" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>icon5.png" alt="Filter by rating" />
                    <h2>Filter by rating</h2>
                </div>
                <p>The product you are watching has too many reviews?</p>
                <p>Do not worry, it is possible to filter reviews according to the vote users have given to the product. Thanks to this feature, you will be able to filter and analyse results simply and quickly, without having to scroll the entire list to find what you need.</p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>background4.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>icon6.png" alt="Filter by rating" />
                    <h2>Reply to review</h2>
                </div>
                <p>You can control the answers of the reviews with the options "reply to all", "none" or "only to the administrator of the site".</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>06.png" alt="Filter by rating" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>07-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>07.png" alt="Filter by rating" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>07-icon.png" alt="Filter by rating" />
                    <h2>Manual review approval</h2>
                </div>
                <p>Sometimes you might feel the need to approve manually reviews that your users write for your products.
                This option allows you to filter all reviews, and it will be always up to you to approve them before
                they can be shown to everyone.</p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>08-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>08-icon.png" alt="ENABLE VOTE FOR ALL" />
                    <h2>ENABLE VOTE FOR ALL</h2>
                </div>
                <p>Do you want to prevent users to <b>vote reviews?</b> Set the options following your needs, choosing whether only registered users can vote or anyone can.</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>08.png" alt="ENABLE VOTE FOR ALL" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>09-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>09.png" alt="INAPPROPRIATE REVIEWS" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>09-icon.png" alt="INAPPROPRIATE REVIEWS" />
                    <h2>INAPPROPRIATE REVIEWS</h2>
                </div>
                <p>
                    Among the different reviews your products receive, some of them might be way out of line, or contain
                    gross words. <b>Give your users the freedom to report them as "inappropriate":</b> in this way, after a
                    certain number of markings (that you can choose), the review will be automatically removed from the
                    system. Clear your shop from impolite users.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>10-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>10-icon.png" alt="Filter by rating" />
                    <h2>FEATURED REVIEWS</h2>
                </div>
                <p>
                    <b>Did you like a review so much and you want to highlight it? That's easy to do!</b> Go in the review list
                    and click on the icon of that specific review: this will appear ahead of the other reviews of the
                    product with a slightly different style. Your users will read it for sure!
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>10.png" alt="Filter by rating" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>11-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>11.png" alt="MORE DETAILS" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>11-icon.png" alt="MORE DETAILS" />
                    <h2>MORE DETAILS</h2>
                </div>
                <p>
                    The Reviews custom post type gets <b>richer</b> and <b>grants</b> you many new details about the reviews in a single screen.<br>
                    At a glance, you could see how many people consider the review useful, if this has been reported as inappropriate, if a review is featured, or if the replies are blocked.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>12-bg.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>12-icon.png" alt="REPORT" />
                    <h2>REPORT</h2>
                </div>
                <p>
                    A detailed report that lets you control the <b>information</b> of the reviews for each product. You can
                    easily discover which are the most reviewed products, and which are the best and worst voted.
                </p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>12.png" alt="REPORT" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>13-bg.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>13.png" alt="STOP REPLY" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>13-icon.png" alt="STOP REPLY" />
                    <h2>STOP REPLY</h2>
                </div>
                <p>
                    If you want to prevent the replies for specific reviews, you don't have to block the entire reply
                    system. Go to the Review custom post type and <b>block the replies only for the reviews you want</b>.
                </p>
            </div>
        </div>
    </div>
    <div class="section section-cta section-odd">
        <div class="landing-container">
            <div class="premium-cta">
                <p>
                    Upgrade to the <span class="highlight">premium version</span>
                    of <span class="highlight">YITH WooCommerce Advanced Reviews</span> to benefit from all features!
                </p>
                <a href="<?php echo $YWAR_AdvancedReview->get_premium_landing_uri(); ?>" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight">UPGRADE</span>
                    <span>to the premium version</span>
                </a>
            </div>
        </div>
    </div>
</div>