    <?php 
        //Template Name: Home
        get_header();
    ?>

    <pre>
        <?php
            $products_slide = wc_get_products([
                'limit' => 6,
                'tag' => ['slide'],
            ]);

            function format_products($products){
                $products_final=[];
                foreach($products as $product){
                    $products_final[] = [
                        'name' => $product->get_name(),
                        'preco' => $product->get_price_html(),
                        'link' => $product->get_permalink(),
                        'img' => wp_get_attachment_image_src($product -> get_image_id(), 'slide')[0],
                    ];
                }
                return $products_final;
            }

            $slide = format_products($products_slide);

            print_r($slide);
        ?>
    </pre>
    <?php if(have_posts()) { while(have_posts()){ the_post();?>

                <section class="slide-wrapper">
                    <ul class="slide">
                        <?php foreach($slide as $product) {?>
                            <li class="slide-item">
                                <img src="<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
                                <div class="slide-info">
                                    <span class="slide-preco">
                                        <?= $product['preco']; ?>
                                    </span>
                                    <span class="slide-nome">
                                        <?= $product['name']; ?>
                                    </span>
                                    <a href="<?= $product['link']; ?>" class="slide-link">Ver produto</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </section>

    <?php } } ?>
        
    <?php get_footer();?>