<?php get_header(); ?>
<div class="container breadcrumb">
    <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
</div>
<?php 
    $products = [];
    if(have_posts()) { while(have_posts()){ the_post();
        $products[] = wc_get_product(get_the_ID());
    }}
    $data = [];
    $data['products'] = handel_format_products($products);
?>
<article class="container products-archive">
    <nav class="filtros">
        <h2>Filtros</h2>
    </nav>
    <main>
        <?php 
            if($data['products']) {
                handel_product_list($data['products']);
                echo get_the_posts_pagination(); 
            }else{ 
        ?>
           
                <p>Nenhum resultado para a sua busca.</p>

        <?php } ?>
        <?php ?>
    </main>
</article>
<?php get_footer(); ?>