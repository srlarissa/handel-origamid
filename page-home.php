    <?php 
        //Template Name: Home
        get_header();
    
        $products_slide = wc_get_products([
            'limit' => 6,
            'tag' => ['slide'],
        ]);

        $products_new = wc_get_products([
            'limit' => 9,
            'order' => 'date',
            'orderby' => 'DESC',
        ]);

        $products_sales = wc_get_products([
            'limit' => 9,
            'meta_key' => 'total_sales',
            'order' => 'meta_value_num',
            'orderby' => 'DESC',
        ]);


        $data = [];
        $data['slide'] = handel_format_products($products_slide, 'slide');
        $data['lancamentos'] = handel_format_products($products_new, 'medium');
        $data['vendas'] = handel_format_products($products_sales, 'medium');

        $home_id = get_the_ID();
        $categoria_esquerda = get_post_meta($home_id, 'categoria_esquerda', true);
        $categoria_direita = get_post_meta($home_id, 'categoria_direita', true);

        function handel_get_product_category_data($category){
            $cat = get_term_by('slug', $category, 'product_cat');
            $cat_id = $cat->term_id;
            $img_id = get_term_meta($cat_id, 'thumbnail_id', true);
            return[
                'name' => $cat->name,
                'id' => $cat_id,
                'link' => get_term_link($cat_id, 'product_cat'),
                'img' => wp_get_attachment_image_src($img_id, 'slide')[0],
            ];
        }

        $data['categorias'][$categoria_esquerda] = handel_get_product_category_data($categoria_esquerda);
        $data['categorias'][$categoria_direita] = handel_get_product_category_data($categoria_direita);
    
        if(have_posts()) { while(have_posts()){ the_post()
    ;?>

        <ul class="vantagens">
            <li>Frete Grátis</li>
            <li>Troca Fácil</li>
            <li>Até 12x sem júros</li>
        </ul>

        <section class="slide-wrapper">
            <ul class="slide">
                <?php foreach($data['slide'] as $product) {?>
                    <li class="slide-item">
                        <img src="<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
                        <div class="slide-info">
                            <span class="slide-preco">
                                <?= $product['price']; ?>
                            </span>
                            <span class="slide-nome">
                                <?= $product['name']; ?>
                            </span>
                            <a href="<?= $product['link']; ?>" class="btn-link">Ver produto</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </section>

        <section class="container">
            <h1 class="subtitulo">Lançamentos</h1>
            <?php handel_product_list($data['lancamentos']); ?>
        </section>

        <section class="categorias-home">
            <?php foreach($data['categorias'] as $categoria) {?>
                <a href="<?= $categoria['link']; ?>">
                    <img src="<?= $categoria['img']; ?>" alt="<?= $categoria['name'] ?>">
                    <span class="btn-link"><?= $categoria['name']; ?></span>
                </a>
            <?php }?>
        </section>

        <section class="container">
            <h1 class="subtitulo">Mais Vendidos</h1>
            <?php handel_product_list($data['vendas']); ?>
        </section>

    <?php 
        } } 
        
        get_footer();
    ?>