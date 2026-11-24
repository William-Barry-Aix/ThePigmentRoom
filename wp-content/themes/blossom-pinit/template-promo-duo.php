<?php
/**
 * Template Name: Landing Promo Duo
 * Template Post Type: page
 *
 * @package Blossom_Pin
 */

get_header();

while ( have_posts() ) :
    the_post();

    $hero_fallback = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '';

    $resolve_image_url = static function ( $meta_key, $fallback = '' ) {
        $value = get_post_meta( get_the_ID(), $meta_key, true );

        if ( empty( $value ) ) {
            return $fallback;
        }

        if ( is_numeric( $value ) ) {
            $url = wp_get_attachment_image_url( (int) $value, 'full' );
            if ( $url ) {
                return $url;
            }
        }

        if ( filter_var( $value, FILTER_VALIDATE_URL ) ) {
            return $value;
        }

        return $fallback;
    };

    $hero_image_url     = $resolve_image_url( '_promo_duo_hero_image', $hero_fallback );
    $lipblush_image_url = $resolve_image_url( '_promo_duo_lipblush_image' );
    $lashlift_image_url = $resolve_image_url( '_promo_duo_lashlift_image' );
    ?>

    <style>
        .promo-duo-page {
            --promo-bg: #f6eee7;
            --promo-paper: #fff7f0;
            --promo-ink: #221414;
            --promo-accent: #c96b4c;
            --promo-accent-dark: #9a4328;
            --promo-border: rgba(34, 20, 20, 0.14);
            --promo-shadow: 0 22px 48px rgba(34, 20, 20, 0.14);
            background:
                radial-gradient(circle at 12% 8%, rgba(201, 107, 76, 0.16), transparent 48%),
                radial-gradient(circle at 88% 24%, rgba(154, 67, 40, 0.12), transparent 45%),
                var(--promo-bg);
            color: var(--promo-ink);
            font-family: var(--primary-font);
            padding-bottom: 72px;
        }

        .promo-duo-wrap {
            width: min(1080px, calc(100% - 32px));
            margin: 0 auto;
            display: grid;
            gap: 42px;
        }

        .promo-hero {
            position: relative;
            min-height: clamp(280px, 52vw, 520px);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--promo-shadow);
            background: linear-gradient(145deg, #d9a18e, #5e2c1f);
        }

        .promo-hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(18, 8, 8, 0.05), rgba(18, 8, 8, 0.5));
        }

        .promo-hero-media {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
        }

        .promo-hero-title {
            position: absolute;
            z-index: 2;
            left: 24px;
            right: 24px;
            bottom: 24px;
            margin: 0;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            font-family: var(--secondary-font);
            font-size: clamp(2rem, 6vw, 4rem);
            line-height: 0.95;
            text-wrap: balance;
        }

        .promo-kicker {
            text-align: center;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.24em;
            font-size: clamp(0.85rem, 1.7vw, 1.05rem);
            font-weight: 700;
        }

        .promo-offer {
            position: relative;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border: 1px solid var(--promo-border);
            border-radius: 28px;
            overflow: visible;
            background: var(--promo-paper);
            box-shadow: var(--promo-shadow);
        }

        .promo-offer.reverse .promo-media {
            order: 2;
        }

        .promo-media {
            min-height: 280px;
            background: linear-gradient(145deg, #b26f5c, #6f3a2f);
        }

        .promo-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .promo-copy {
            padding: clamp(24px, 4vw, 44px);
            display: grid;
            align-content: center;
            gap: 14px;
        }

        .promo-offer.reverse .promo-copy {
            text-align: right;
        }

        .promo-title {
            margin: 0;
            font-family: var(--secondary-font);
            font-size: clamp(2rem, 4.1vw, 3.5rem);
            line-height: 0.95;
            text-transform: uppercase;
        }

        .promo-description {
            margin: 0;
            font-size: clamp(1rem, 2.2vw, 1.2rem);
            line-height: 1.55;
            max-width: 36ch;
        }

        .promo-offer.reverse .promo-description {
            margin-left: auto;
        }

        .promo-price-ribbon {
            margin: 0;
            width: fit-content;
            background: var(--promo-paper);
            color: var(--promo-ink);
            border: 1px solid var(--promo-border);
            border-radius: 16px;
            box-shadow: 0 12px 26px rgba(34, 20, 20, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 14px;
            padding: 12px 20px;
            position: absolute;
            right: -18px;
            bottom: 14px;
            z-index: 3;
        }

        .promo-offer.reverse .promo-price-ribbon {
            right: auto;
            left: -18px;
        }

        .promo-price-now {
            font-size: clamp(1.6rem, 5vw, 2.4rem);
            font-weight: 800;
            line-height: 1;
        }

        .promo-price-was {
            font-size: clamp(1rem, 2.4vw, 1.2rem);
            opacity: 0.75;
            text-decoration: line-through;
            text-decoration-thickness: 2px;
            text-decoration-color: rgba(34, 20, 20, 0.45);
        }

        @media only screen and (max-width: 900px) {
            .promo-duo-wrap {
                gap: 30px;
                width: min(1080px, calc(100% - 20px));
            }

            .promo-offer,
            .promo-offer.reverse {
                grid-template-columns: 1fr;
            }

            .promo-offer.reverse .promo-media {
                order: 0;
            }

            .promo-offer.reverse .promo-copy,
            .promo-offer.reverse .promo-description {
                text-align: left;
                margin-left: 0;
            }

            .promo-price-ribbon {
                max-width: calc(100% - 20px);
                padding: 10px 14px;
                right: 10px;
                bottom: 10px;
            }

            .promo-offer.reverse .promo-price-ribbon {
                left: 10px;
            }
        }
    </style>

    <main id="main" class="site-main promo-duo-page">
        <div class="promo-duo-wrap">
            <section class="promo-hero" aria-label="Question promo duo">
                <?php if ( $hero_image_url ) : ?>
                    <div class="promo-hero-media" style="background-image: url('<?php echo esc_url( $hero_image_url ); ?>');"></div>
                <?php endif; ?>
                <h1 class="promo-hero-title">Plutôt cils ou lèvres ?</h1>
            </section>

            <p class="promo-kicker">JUSTE À TEMPS POUR LES FÊTES</p>

            <section class="promo-offer" aria-label="Offre Lipblush">
                <div class="promo-media">
                    <?php if ( $lipblush_image_url ) : ?>
                        <img src="<?php echo esc_url( $lipblush_image_url ); ?>" alt="Lipblush" loading="lazy">
                    <?php endif; ?>
                </div>
                <div class="promo-copy">
                    <h2 class="promo-title">Lipblush</h2>
                    <p class="promo-description">des lèvres délicatement rosées au contour défini</p>
                </div>
                <p class="promo-price-ribbon" aria-label="Prix Lipblush">
                    <span class="promo-price-now">450$</span>
                    <span class="promo-price-was">550$</span>
                </p>
            </section>

            <section class="promo-offer reverse" aria-label="Offre Lash lift coréen">
                <div class="promo-media">
                    <?php if ( $lashlift_image_url ) : ?>
                        <img src="<?php echo esc_url( $lashlift_image_url ); ?>" alt="Lash lift coréen" loading="lazy">
                    <?php endif; ?>
                </div>
                <div class="promo-copy">
                    <h2 class="promo-title">Lash lift coréen</h2>
                    <p class="promo-description">un regard ouvert et des cils qui semblent plus longs</p>
                </div>
                <p class="promo-price-ribbon" aria-label="Prix Lash lift coréen">
                    <span class="promo-price-now">90$</span>
                    <span class="promo-price-was">110$</span>
                </p>
            </section>
        </div>
    </main>

<?php
endwhile;
?>

</div><!-- #primary -->

<?php
get_footer();
