<?php get_header(); ?>
<?php $posts = query_posts([
    'post_type' => ['stocks'],
    'category_name' => $category_name,
    'paged' => get_query_var('paged')
]) ?>

<div class="content">
    <h1 class="title-page">Последние записи</h1>
    <div class="posts-list">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!-- post-mini-->
            <div class="post-wrap">
                <div class="post-thumbnail"><img src="<?php the_post_thumbnail_url(); ?>" alt="Image поста" class="post-thumbnail__image"></div>
                <div class="post-content">
                    <div class="post-content__post-info">
                        <div class="post-date">
                            <?php echo get_the_date(); ?>
                        </div>
                    </div>
                    <div class="post-content__post-text">
                        <div class="post-title">
                            <?php the_title(); ?>
                        </div>
                        <p>
                            <?php the_excerpt(); ?>
                        </p>
                    </div>
                    <div class="post-content__post-control"><a href="<?php the_permalink(); ?>" class="btn-read-post">Читать далее >></a></div>
                </div>
            </div>
            <!-- post-mini_end-->
        <?php endwhile; else : ?>
            <p><?php _e('Ничего не найдено.'); ?></p>
        <?php endif; ?>
    </div>
    <?php the_posts_pagination(); ?>
    <?php wp_reset_query(); wp_reset_postdata(); ?>
</div>
<div class="sidebar">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : endif; ?>
</div>

<?php get_footer(); ?>
