<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url();?></loc>
        <priority>1.0</priority>
    </url>

    <?php if(isset($listings)):?>
    <?php foreach($listings as $listing): ?>
        <url>
            <loc><?php echo site_url('business').'/'.$listing['slug']; ?></loc>
            <priority>0.5</priority>
        </url>
        <?php endforeach; ?>
    <?php endif; ?>


    <?php if(isset($categories)):?>
    <?php foreach($categories as $category): ?>
        <url>
            <loc><?php echo site_url().'/home/category/'.$category['pkey']; ?></loc>
            <priority>0.5</priority>
        </url>
        <?php endforeach; ?>
    <?php endif; ?>


    <?php if(isset($websites)):?>
    <?php foreach($websites as $website): ?>
        <url>
            <loc><?php echo site_url('website').'/'.$website['slug']; ?></loc>
            <priority>0.5</priority>
        </url>
        <?php endforeach; ?>
    <?php endif; ?>


    <?php if(isset($websitePages)):?>
    <?php foreach($websitePages as $websitePage): ?>
        <url>
            <loc><?php echo site_url('website').'/'.$websitePage['slug'].'/'.$websitePage['pkey']; ?></loc>
            <priority>0.5</priority>
        </url>
        <?php endforeach; ?>
    <?php endif; ?>



</urlset>


<?php

//var_dump($websites);
?>