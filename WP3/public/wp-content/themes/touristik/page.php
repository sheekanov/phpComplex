<?php get_header(); ?>
<?php $page = get_page($page_id); ?>
<div class="content">
    <h1 class="title-page">О сервисе</h1>
    <div class="user_content">
        <?php echo $page->post_content; ?>
    </div>
</div>
<div class="sidebar">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : endif; ?>
</div>
<?php get_footer(); ?>
