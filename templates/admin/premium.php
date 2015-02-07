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
    .section .section-title img{
        display: inline-block;
        vertical-align: middle;
        width: auto;
        margin-right: 15px;
    }
    .section .section-title h2,
    .section .section-title h3 {
        display: inline-block;
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
                <a href="http://yithemes.com/themes/plugins/yith-woocommerce-advanced-reviews" target="_blank" class="premium-cta-button button btn">
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
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>feature2.png" alt="Attachment List" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>icon2.png" alt="Attachment List" />
                    <h2>MODAL WINDOW</h2>
                    <h3>Premium Feature 1</h3>
                </div>
                <p>Enabling this option, the result of the review filter will be slightly different: the filtered review will be showed in a modal window.</p>
            </div>
        </div>
    </div>
    <div class="section section-odd clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>background2.png) no-repeat #f1f1f1; background-position: 15% 100%">
        <div class="landing-container">
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>icon1.png" alt="Review Title"/>
                    <h2>Load More</h2>
                    <h3>Premium Feature 2</h3>
                </div>
                <p>Do you want to hide some of your reviews? Set how many to show with the relative option, and if you want to let users read the rest of them, choose the load more option.</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>feature1.png" alt="Review Title" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>background3.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>feature3.png" alt="Vote the review" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>icon3.png" alt="Vote the review" />
                    <h2>Vote the review</h2>
                    <h3>Premium feature 3</h3>
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
                    <h3>Premium Feature 4</h3>
                </div>
                <p>This feature allows you to provide users with another piece of information concerning each individual review: it displays the number of users that have appreciated it by expressing their preference for it.</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>feature4.png" alt="Number" />
            </div>
        </div>
    </div>
    <div class="section section-even clear" style="background: url(<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>background5.png) no-repeat #fff; background-position: 85% 100%">
        <div class="landing-container">
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>feature5.png" alt="Filter by rating" />
            </div>
            <div class="col-2">
                <div class="section-title">
                    <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL?>icon5.png" alt="Filter by rating" />
                    <h2>Filter by rating</h2>
                    <h3>Premium feature 5</h3>
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
                    <h3>Premium feature 6</h3>
                </div>
                <p>You can control the answers of the reviews with the options "reply to all", "none" or "only to the administrator of the site".</p>
            </div>
            <div class="col-1">
                <img src="<?php echo YITH_YWAR_ASSETS_IMAGES_URL ?>feature6.png" alt="Filter by rating" />
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
                <a href="http://yithemes.com/themes/plugins/yith-woocommerce-advanced-reviews" target="_blank" class="premium-cta-button button btn">
                    <span class="highlight">UPGRADE</span>
                    <span>to the premium version</span>
                </a>
            </div>
        </div>
    </div>
</div>