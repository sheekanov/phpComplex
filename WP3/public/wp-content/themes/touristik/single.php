<?php get_header(); ?>

<div class="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="article-title title-page">
        <?php the_title() ?>
    </div>
    <div class="article-image"><img src="<?php the_post_thumbnail_url(); ?>" alt="Image поста"></div>
    <div class="article-info">
        <div class="post-date"><?php the_date() ?></div>
    </div>
    <div class="article-text">
        <?php the_content() ?>
    </div>
<?php endwhile; else : ?>
    <p><?php _e('Ничего не найдено.'); ?></p>
<?php endif; ?>
    <div class="article-pagination">
        <?php $prevpost = get_previous_post() ?>
        <?php if (!empty($prevpost)) : ?>
        <div class="article-pagination__block pagination-prev-left"><a href="<?php echo get_the_permalink($prevpost);?>" class="article-pagination__link"><i class="icon icon-angle-double-left"></i>Предыдущая статья</a>
            <div class="wrap-pagination-preview pagination-prev-left">
                <div class="preview-article__img"><img src="<?php echo get_the_post_thumbnail_url($prevpost); ?>" class="preview-article__image"></div>
                <div class="preview-article__content">
                    <div class="preview-article__info"><a href="#" class="post-date"><?php echo date('d.m.Y', strtotime($prevpost->post_date)); ?></a></div>
                    <div class="preview-article__text"><?php echo $prevpost->post_title; ?></div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php $nextpost = get_next_post(); ?>
        <?php if (!empty($nextpost)) : ?>
        <div class="article-pagination__block pagination-prev-right"><a href="<?php echo get_the_permalink($nextpost);?>" class="article-pagination__link">Сдедующая статья<i class="icon icon-angle-double-right"></i></a>
            <div class="wrap-pagination-preview pagination-prev-right">
                <div class="preview-article__img"><img src="<?php echo get_the_post_thumbnail_url($nextpost); ?>" class="preview-article__image"></div>
                <div class="preview-article__content">
                    <div class="preview-article__info"><a href="#" class="post-date"><?php echo date('d.m.Y', strtotime($nextpost->post_date)) ?></a></div>
                    <div class="preview-article__text"><?php echo $nextpost->post_title; ?></div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>