<?php get_header(); ?>

<div style="text-align: center; padding: 120px 24px;">
    <div style="font-size: 5rem; font-weight: 700; color: var(--yellow); line-height: 1; margin-bottom: 16px;">404</div>
    <h1 style="font-size: 1.6rem; color: var(--ink); margin-bottom: 14px;">Page not found</h1>
    <p style="color: var(--mid-gray); font-size: 1rem; max-width: 380px; margin: 0 auto 32px;">Looks like this page doesn't exist or may have moved. Head back to the homepage or browse the blog.</p>
    <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">Go home</a>
        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="btn btn--outline" style="color: var(--ink); border-color: var(--border);">Read the blog</a>
    </div>
</div>

<?php get_footer(); ?>
