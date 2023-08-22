<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= get_bloginfo(); ?> <?php wp_title('|'); ?> </title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php 
    $img_url = get_stylesheet_directory_uri() . '/img';
    $cart_count = WC()->cart->get_cart_contents_count();
?>

<header class="header">
    <a href="/"><img src="<?= $img_url; ?>/handel.svg" alt="Handel"></a>
    <div class="busca">
        <form action="<?php bloginfo('url'); ?>/loja" method="get">
            <input type="text" name="s" id="s" placeholder="Buscar" value="<?php the_search_query() ?>">
            <input type="text" name="post_type" value="product" class="hidden">
            <input type="submit" value="Buscar" id="searchButton">
        </form>
    </div>
    <div class="conta">
        <a href="/minha-conta" class="minha-conta">Minha Conta</a>
        <a href="/carrinho" class="carrinho">
            Carrinho
            <?php if($cart_count) { ?>
                <span class="carrinho-count"><?=$cart_count ?></span>
            <?php } ?>
        </a>
    </div>
</header>