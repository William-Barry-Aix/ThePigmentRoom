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
    $lipblush_before_url = $resolve_image_url( '_promo_duo_lipblush_before_image', $lipblush_image_url );
    $lipblush_after_url  = $resolve_image_url( '_promo_duo_lipblush_after_image', $lipblush_image_url );
    $work_row1_left_url  = $resolve_image_url( '_promo_duo_work_row1_left', $lipblush_image_url );
    $work_row1_right_url = $resolve_image_url( '_promo_duo_work_row1_right', $lipblush_image_url );
    $work_row2_wide_url  = $resolve_image_url( '_promo_duo_work_row2_wide', $lipblush_image_url );
    $work_row3_left_url  = $resolve_image_url( '_promo_duo_work_row3_left', $lipblush_image_url );
    $work_row3_right_url = $resolve_image_url( '_promo_duo_work_row3_right', $lipblush_image_url );
    $work_row4_left_url  = $resolve_image_url( '_promo_duo_work_row4_left', $lipblush_image_url );
    $work_row4_right_url = $resolve_image_url( '_promo_duo_work_row4_right', $lipblush_image_url );
    $work_row5_square_url = $resolve_image_url( '_promo_duo_work_row5_square', $lipblush_image_url );
    $work_row6_portrait_url = $resolve_image_url( '_promo_duo_work_row6_portrait', $lipblush_image_url );
    $lashlift_before_1_url = $resolve_image_url( '_promo_duo_lashlift_before_1_image', $lashlift_image_url );
    $lashlift_after_1_url  = $resolve_image_url( '_promo_duo_lashlift_after_1_image', $lashlift_image_url );
    $lashlift_before_2_url = $resolve_image_url( '_promo_duo_lashlift_before_2_image', $lashlift_image_url );
    $lashlift_after_2_url  = $resolve_image_url( '_promo_duo_lashlift_after_2_image', $lashlift_image_url );
    $about_image_url = $resolve_image_url( '_promo_duo_about_image', $hero_image_url );
    $about_secondary_image_url = $resolve_image_url( '_promo_duo_about_secondary_image', $about_image_url );
    ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=MuseoModerno:wght@400;500;600;700;800&display=swap');

        .promo-duo-page {
            --promo-bg: #f6eee7;
            --promo-paper: #fff7f0;
            --promo-ink: #221414;
            --promo-accent: #c96b4c;
            --promo-accent-dark: #9a4328;
            --promo-border: rgba(34, 20, 20, 0.14);
            --promo-shadow: 0 22px 48px rgba(34, 20, 20, 0.14);
            background: transparent;
            color: var(--promo-ink);
            font-family: var(--primary-font);
            padding-bottom: 0;
        }

        #colophon {
            margin: 24px 0 0 !important;
        }

        #content {
            margin-bottom: 120px;
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

        .promo-work-intro {
            display: grid;
            gap: 12px;
            text-align: center;
            margin: 0;
            width: 100%;
            max-width: 100%;
        }

        .promo-work-divider {
            width: min(96px, 18vw);
            margin: 20px auto;
            border: 0;
            height: 1px;
            background: #7b391a;
            opacity: 0.95;
        }

        .promo-work-title,
        .promo-work-subtitle,
        .promo-work-tagline {
            margin: 0;
            text-transform: uppercase;
        }

        .promo-work-title {
            font-family: 'Poppins', var(--secondary-font), sans-serif !important;
            letter-spacing: 0.08em;
            font-size: clamp(1.8rem, 3.8vw, 2.8rem);
            line-height: 1;
            color: #4b1a06;
        }

        .promo-work-subtitle {
            font-size: clamp(1rem, 2.1vw, 1.25rem);
            letter-spacing: 0.18em;
            font-weight: 700;
            color: #4b1a06;
        }

        .promo-work-tagline {
            font-size: clamp(0.9rem, 1.8vw, 1.05rem);
            letter-spacing: 0.13em;
            font-weight: 600;
            opacity: 0.9;
            color: #4b1a06;
        }

        .promo-work-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
            color: #7b391a;
        }

        .promo-work-row-title {
            margin: 0;
            text-transform: uppercase;
            font-family: 'Poppins', var(--secondary-font), sans-serif !important;
            font-size: clamp(1.15rem, 2.3vw, 1.5rem);
            letter-spacing: 0.06em;
            white-space: nowrap;
            color: #4b1a06;
        }

        .promo-work-intro h2,
        .promo-work-intro h3 {
            font-family: 'Poppins', var(--secondary-font), sans-serif !important;
        }

        .promo-work-row-text {
            margin: 0;
            font-size: clamp(0.95rem, 1.9vw, 1.1rem);
            letter-spacing: 0.03em;
            white-space: nowrap;
        }

        .promo-work-row-separator {
            flex: 1;
            min-width: 70px;
            height: 1px;
            background: #7b391a;
            opacity: 0.95;
        }

        .promo-work-row-lash {
            align-items: flex-start;
            gap: 16px;
            margin: 36px 0 0;
            --lash-title-height: clamp(1.4rem, 2.4vw, 1.85rem);
        }

        .promo-work-row-lip {
            align-items: flex-start;
            gap: 16px;
            margin: 10px 0 0;
            --lip-title-height: clamp(1.4rem, 2.4vw, 1.85rem);
        }

        .promo-work-row-title-wrap {
            display: grid;
            gap: 2px;
            justify-items: start;
            min-width: max-content;
        }

        .promo-work-row-subtext {
            margin: 0;
            font-size: clamp(0.82rem, 1.7vw, 0.96rem);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-weight: 600;
            white-space: nowrap;
        }

        .promo-work-row-lash .promo-work-row-title {
            line-height: var(--lash-title-height);
        }

        .promo-work-row-subtext-below {
            margin: -20px 0 0;
            width: 100%;
            text-align: left;
        }

        .promo-work-row-lip .promo-work-row-title {
            line-height: var(--lip-title-height);
        }

        .promo-work-row-lash .promo-work-row-text {
            white-space: normal;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: visible;
            max-width: 24ch;
            font-size: clamp(0.5rem, 0.82vw, 0.62rem);
            letter-spacing: 0.01em;
            text-transform: uppercase;
            text-align: left;
            margin-top: 0;
            margin-bottom: 0;
            min-height: var(--lash-title-height);
            line-height: 1.15;
            align-self: flex-start;
        }

        .promo-work-row-lip .promo-work-row-text {
            white-space: normal;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: visible;
            max-width: 24ch;
            font-size: clamp(0.5rem, 0.82vw, 0.62rem);
            letter-spacing: 0.01em;
            text-transform: uppercase;
            text-align: left;
            margin-top: 0;
            margin-bottom: 0;
            min-height: var(--lip-title-height);
            line-height: 1.15;
            align-self: flex-start;
        }

        .promo-work-row-lash .promo-work-row-separator,
        .promo-work-row-lip .promo-work-row-separator {
            position: relative;
            align-self: stretch;
            height: auto;
            background: transparent;
        }

        .promo-work-row-lash .promo-work-row-separator::before,
        .promo-work-row-lip .promo-work-row-separator::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            height: 1px;
            transform: translateY(-50%);
            background: #7b391a;
            opacity: 0.95;
        }

        .promo-work-gallery {
            display: flex;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            gap: 14px;
            margin: 0;
        }

        .promo-work-row + .promo-work-gallery,
        .promo-work-row + .promo-work-lines {
            margin-top: 12px;
        }

        .promo-work-row + .promo-work-gallery {
            margin-bottom: 12px;
        }

        .promo-work-row + .promo-work-lines {
            margin-bottom: 12px;
        }

        .promo-work-shot {
            position: relative;
            margin: 0;
            flex: 1 1 0;
            min-width: 0;
            aspect-ratio: 152 / 202;
            max-width: 100%;
            box-sizing: border-box;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(123, 57, 26, 0.28);
            box-shadow: 0 10px 22px rgba(34, 20, 20, 0.12);
            background: linear-gradient(145deg, #e5c1b2, #c9927b);
        }

        .promo-work-shot img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .promo-work-badge {
            position: absolute;
            top: 8px;
            z-index: 2;
            margin: 0;
            padding: 5px 9px;
            border-radius: 999px;
            background: #7b391a;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.66rem;
            font-weight: 700;
            line-height: 1;
        }

        .promo-work-badge-left {
            left: 8px;
        }

        .promo-work-badge-right {
            right: 8px;
        }

        .promo-work-lines {
            display: grid;
            gap: 14px;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
        }

        .promo-work-intro > .promo-work-lines:last-of-type {
            margin-bottom: 28px;
        }

        .promo-work-line {
            display: flex;
            gap: 14px;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
        }

        .promo-work-line.two-portrait .promo-work-line-shot {
            flex: 1 1 0;
            min-width: 0;
            aspect-ratio: 152 / 202;
        }

        .promo-work-line.two-landscape-small .promo-work-line-shot {
            flex: 1 1 0;
            min-width: 0;
            aspect-ratio: 157 / 130;
        }

        .promo-work-line.one-landscape .promo-work-line-shot {
            width: 100%;
            aspect-ratio: 202 / 152;
        }

        .promo-work-line.one-square {
            justify-content: stretch;
        }

        .promo-work-line.one-square .promo-work-line-shot {
            width: 100%;
            max-width: 100%;
            aspect-ratio: 1 / 1;
        }

        .promo-work-line.one-portrait {
            justify-content: stretch;
        }

        .promo-work-line.one-portrait .promo-work-line-shot {
            width: 100%;
            max-width: 100%;
            aspect-ratio: 152 / 202;
        }

        .promo-work-line-shot {
            position: relative;
            margin: 0;
            max-width: 100%;
            box-sizing: border-box;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(123, 57, 26, 0.28);
            box-shadow: 0 10px 22px rgba(34, 20, 20, 0.12);
            background: linear-gradient(145deg, #e5c1b2, #c9927b);
        }

        .promo-work-line-shot img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .promo-work-cta {
            display: inline-flex;
            justify-self: center;
            align-items: center;
            margin: 16px 0 18px;
            padding: 12px 26px;
            border: 1px solid #7b391a;
            border-radius: 999px;
            background: #7b391a;
            color: #fbeee9;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 700;
            text-decoration: none;
            line-height: 1;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .promo-work-cta:hover,
        .promo-work-cta:focus-visible {
            background: #fbeee9;
            color: #7b391a;
        }

        .promo-about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 18px;
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin: 0;
        }

        .promo-about-photo {
            margin: 0;
            width: 100%;
            aspect-ratio: 161 / 241;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(123, 57, 26, 0.28);
            box-shadow: 0 10px 22px rgba(34, 20, 20, 0.12);
            background: linear-gradient(145deg, #e5c1b2, #c9927b);
        }

        .promo-about-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .promo-about-text {
            margin: 0;
            text-align: left;
            line-height: 1.6;
            font-size: clamp(1rem, 2vw, 1.15rem);
        }

        .promo-about-content-reverse {
            grid-template-columns: 1fr 1fr;
        }

        .promo-about-photo-landscape {
            width: 100%;
            justify-self: stretch;
            aspect-ratio: 189 / 168;
        }

        .promo-about-photo-landscape img {
            width: 100%;
            height: 100%;
        }

        .promo-shop-address {
            display: flex;
            align-items: center;
            gap: 16px;
            width: 100%;
            margin: 0;
        }

        .promo-shop-address-line {
            flex: 1;
            min-width: 40px;
            border: 0;
            border-top: 1px solid #7b391a;
            margin: 0;
            opacity: 0.9;
        }

        .promo-shop-address-text {
            margin: 0;
            text-align: center;
            color: #7b391a;
            line-height: 1.45;
            font-size: clamp(0.98rem, 1.9vw, 1.12rem);
            white-space: nowrap;
        }

        .promo-full-map-section {
            width: 100vw;
            max-width: 100vw;
            margin-left: calc(50% - 50vw);
            margin-right: calc(50% - 50vw);
            padding-top: 0;
            overflow: hidden;
        }

        .promo-full-map-wrap {
            overflow: hidden;
            border: 0;
            border-radius: 0;
            box-shadow: 0 14px 40px rgba(123, 57, 26, 0.12);
            background: #fff;
        }

        .promo-full-map-wrap iframe {
            display: block;
            width: 100%;
            height: 420px;
            border: 0;
            -webkit-filter: none;
            filter: none;
        }

        .promo-footer-insert {
            margin: 0;
            background: var(--promo-bg, #f6eee7);
        }

        .promo-footer-insert > section {
            padding-top: 12px;
            padding-right: 0;
            padding-bottom: 0;
            padding-left: 0;
        }

        .promo-duo-bands {
            border-radius: 22px;
            overflow: hidden;
            box-shadow: var(--promo-shadow);
            border: 1px solid var(--promo-border);
        }

        .promo-duo-band {
            margin: 0;
            padding: clamp(16px, 2.4vw, 24px) clamp(18px, 3vw, 34px);
            text-align: center;
            font-size: clamp(1rem, 2.1vw, 1.18rem);
            line-height: 1.5;
        }

        .promo-duo-band-light {
            background: #fff;
            color: var(--promo-ink);
            font-family: 'MuseoModerno', var(--primary-font), sans-serif;
        }

        .promo-duo-band-dark {
            background: #4e1c06;
            color: #fff;
            font-family: 'Poppins', var(--secondary-font), sans-serif;
        }

        .promo-duo-band-light .promo-duo-band-title {
            font-family: 'MuseoModerno', var(--primary-font), sans-serif;
            color: #4e1c06;
            font-size: clamp(3.4rem, 8.4vw, 6.4rem);
            font-weight: 800;
            font-style: italic;
            line-height: 0.9;
        }

        .promo-duo-band-dark .promo-duo-band-title {
            font-family: 'Poppins', var(--secondary-font), sans-serif;
        }

        .promo-duo-band-title {
            display: block;
            font-family: var(--secondary-font);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: clamp(1.35rem, 3vw, 2rem);
            line-height: 1;
            margin-bottom: 6px;
        }

        .promo-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid var(--promo-border);
            box-shadow: var(--promo-shadow);
        }

        .promo-detail-card {
            margin: 0;
            display: grid;
            grid-template-rows: auto 1fr;
            background: transparent;
            color: var(--promo-ink);
        }

        .promo-detail-card-head {
            padding: 12px 16px;
        }

        .promo-detail-card-title {
            margin: 0;
            font-family: 'MuseoModerno', var(--primary-font), sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: clamp(1.3rem, 2.4vw, 1.9rem);
            line-height: 1.05;
            text-align: center;
        }

        .promo-detail-card-body {
            padding: clamp(20px, 3vw, 32px);
            position: relative;
        }

        .promo-detail-card:first-child .promo-detail-card-body::after {
            content: "";
            position: absolute;
            top: 12px;
            bottom: 12px;
            right: 0;
            width: 1px;
            background: var(--promo-border);
        }

        .promo-detail-card-text {
            margin: 0;
            line-height: 1.6;
            font-size: clamp(0.98rem, 1.9vw, 1.12rem);
            color: #4e1c06;
        }

        .promo-detail-card-title-light {
            background: #fff;
            color: #4e1c06;
            border-bottom: 1px solid var(--promo-border);
        }

        .promo-detail-card-title-dark {
            background: #4e1c06;
            color: #fff;
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
            margin-bottom: 16px;
        }

        .promo-offer,
        .promo-offer .promo-description,
        .promo-offer .promo-price-ribbon,
        .promo-offer .promo-price-now,
        .promo-offer .promo-price-was {
            font-family: 'MuseoModerno', var(--primary-font), sans-serif;
        }

        .promo-offer.reverse .promo-media {
            order: 2;
        }

        .promo-media {
            min-height: 280px;
            background: linear-gradient(145deg, #b26f5c, #6f3a2f);
        }

        .promo-offer-lipblush .promo-media {
            width: 100%;
            min-height: 0;
            aspect-ratio: 180 / 120;
            align-self: start;
        }

        .promo-offer-lashlift .promo-media {
            width: 100%;
            min-height: 0;
            aspect-ratio: 180 / 120;
            align-self: start;
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
            justify-items: end;
        }

        .promo-offer-lashlift .promo-copy {
            text-align: right;
            justify-items: end;
        }

        .promo-title {
            margin: 0;
            font-family: 'MuseoModerno', var(--primary-font), sans-serif;
            font-size: clamp(2rem, 4.1vw, 3.5rem);
            line-height: 0.95;
            text-transform: uppercase;
            color: #4e1c06;
        }

        .promo-description {
            margin: 0;
            font-size: clamp(1rem, 2.2vw, 1.2rem);
            line-height: 1.55;
            max-width: 36ch;
            color: #4e1c06;
        }

        .promo-offer.reverse .promo-description {
            margin-left: auto;
        }

        .promo-offer-lashlift .promo-description {
            margin-left: auto;
            text-align: right;
        }

        .promo-price-ribbon {
            margin: 0;
            width: fit-content;
            background: #4e1c06;
            color: #fff;
            border: 1px solid var(--promo-border);
            border-radius: 16px;
            box-shadow: 0 12px 26px rgba(34, 20, 20, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 14px;
            padding: 12px 20px;
            position: absolute;
            right: -18px;
            bottom: -35px;
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
            text-decoration-color: rgba(255, 255, 255, 0.6);
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

            .promo-offer-lashlift .promo-copy {
                text-align: right;
                justify-items: end;
            }

            .promo-offer-lashlift .promo-description {
                text-align: right;
                margin-left: auto;
            }

            .promo-duo-band {
                text-align: left;
                padding: 14px 16px;
            }

            .promo-price-ribbon {
                max-width: calc(100% - 20px);
                padding: 10px 14px;
                right: 10px;
                bottom: -20px;
            }

            .promo-offer.reverse .promo-price-ribbon {
                left: 10px;
            }

            .promo-detail-grid {
                grid-template-columns: 1fr;
            }

            .promo-detail-card:first-child .promo-detail-card-body::after {
                display: none;
            }

            .promo-work-row {
                flex-wrap: wrap;
                justify-content: center;
            }

            .promo-work-row-separator {
                flex-basis: 100%;
            }

            .promo-work-row-lash {
                flex-wrap: nowrap;
                justify-content: flex-start;
                align-items: flex-start;
                gap: 8px;
            }

            .promo-work-row-lip {
                flex-wrap: nowrap;
                justify-content: flex-start;
                align-items: flex-start;
                gap: 8px;
            }

            .promo-work-row-lash .promo-work-row-separator {
                flex-basis: auto;
                min-width: 34px;
                align-self: stretch;
            }

            .promo-work-row-lip .promo-work-row-separator {
                flex-basis: auto;
                min-width: 34px;
                align-self: stretch;
            }

            .promo-work-gallery {
                gap: 10px;
            }

            .promo-work-line {
                gap: 10px;
            }

            .promo-work-line.one-square .promo-work-line-shot,
            .promo-work-line.one-portrait .promo-work-line-shot {
                width: 100%;
            }

            .promo-about-content {
                gap: 10px;
            }

            .promo-about-content-reverse {
                grid-template-columns: 1fr 1fr;
            }

            .promo-shop-address {
                gap: 10px;
            }

            .promo-shop-address-text {
                white-space: normal;
            }

            .promo-full-map-section {
                padding-top: 0;
            }

            .promo-full-map-wrap iframe {
                height: 280px;
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

            <section class="promo-offer promo-offer-lipblush" aria-label="Offre Lipblush">
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

            <section class="promo-offer promo-offer-lashlift reverse" aria-label="Offre Lash lift coréen">
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

            <section class="promo-duo-bands" aria-label="Informations duo">
                <p class="promo-duo-band promo-duo-band-light">
                    <span class="promo-duo-band-title">LE DUO</span>
                    Le parfait combo pour sublimer votre beauté.
                </p>
                <p class="promo-duo-band promo-duo-band-dark">
                    Choisissez les deux et profitez de votre retouche Lip Blush incluse (valeur de 50 $)
                </p>
            </section>

            <section class="promo-detail-grid" aria-label="Détails des services">
                <article class="promo-detail-card">
                    <div class="promo-detail-card-head promo-detail-card-title-light">
                        <h3 class="promo-detail-card-title">Lipblush</h3>
                    </div>
                    <div class="promo-detail-card-body">
                        <p class="promo-detail-card-text">Technique de maquillage semi permanent qui rehausse la couleur des lèvres, redéfinit les contours et les rend plus uniformes. Un effet bonne mine sans maquillage quotidien.</p>
                    </div>
                </article>
                <article class="promo-detail-card">
                    <div class="promo-detail-card-head promo-detail-card-title-dark">
                        <h3 class="promo-detail-card-title">Corean Lashlift</h3>
                    </div>
                    <div class="promo-detail-card-body">
                        <p class="promo-detail-card-text">Rehaussement de cils nouvelle génération plus doux et plus avancé . Il ouvre le regard, recourbe et colore vos cils naturels en profondeur pour un résultat impeccable à chaque matin.</p>
                    </div>
                </article>
            </section>

            <section class="promo-work-intro" aria-label="Section mon travail">
                <hr class="promo-work-divider" aria-hidden="true">
                <h2 class="promo-work-title">MON TRAVAIL</h2>
                <p class="promo-work-subtitle">ET QUELQUES AVANT/APRÈS</p>
                <p class="promo-work-tagline">DES RÉSULTATS NATURELS, QUI VOUS RESSEMBLENT</p>
                <hr class="promo-work-divider" aria-hidden="true">
                <div class="promo-work-row promo-work-row-lip" aria-label="Sous-section lipblush">
                    <h3 class="promo-work-row-title">lipblush</h3>
                    <p class="promo-work-row-text">des lèvres sublimées au naturel</p>
                    <span class="promo-work-row-separator" aria-hidden="true"></span>
                </div>
                <div class="promo-work-gallery" aria-label="Lipblush avant après">
                    <figure class="promo-work-shot">
                        <span class="promo-work-badge promo-work-badge-left">Avant</span>
                        <?php if ( $lipblush_before_url ) : ?>
                            <img src="<?php echo esc_url( $lipblush_before_url ); ?>" alt="Lipblush avant" loading="lazy">
                        <?php endif; ?>
                    </figure>
                    <figure class="promo-work-shot">
                        <span class="promo-work-badge promo-work-badge-right">Après</span>
                        <?php if ( $lipblush_after_url ) : ?>
                            <img src="<?php echo esc_url( $lipblush_after_url ); ?>" alt="Lipblush après" loading="lazy">
                        <?php endif; ?>
                    </figure>
                </div>
                <div class="promo-work-lines" aria-label="Galerie lipblush complémentaire">
                    <div class="promo-work-line two-portrait">
                        <figure class="promo-work-line-shot">
                            <?php if ( $work_row1_left_url ) : ?>
                                <img src="<?php echo esc_url( $work_row1_left_url ); ?>" alt="Lipblush résultat portrait 1" loading="lazy">
                            <?php endif; ?>
                        </figure>
                        <figure class="promo-work-line-shot">
                            <?php if ( $work_row1_right_url ) : ?>
                                <img src="<?php echo esc_url( $work_row1_right_url ); ?>" alt="Lipblush résultat portrait 2" loading="lazy">
                            <?php endif; ?>
                        </figure>
                    </div>
                    <div class="promo-work-line one-landscape">
                        <figure class="promo-work-line-shot">
                            <?php if ( $work_row2_wide_url ) : ?>
                                <img src="<?php echo esc_url( $work_row2_wide_url ); ?>" alt="Lipblush résultat paysage" loading="lazy">
                            <?php endif; ?>
                        </figure>
                    </div>
                    <div class="promo-work-line two-portrait">
                        <figure class="promo-work-line-shot">
                            <?php if ( $work_row3_left_url ) : ?>
                                <img src="<?php echo esc_url( $work_row3_left_url ); ?>" alt="Lipblush résultat portrait 3" loading="lazy">
                            <?php endif; ?>
                        </figure>
                        <figure class="promo-work-line-shot">
                            <?php if ( $work_row3_right_url ) : ?>
                                <img src="<?php echo esc_url( $work_row3_right_url ); ?>" alt="Lipblush résultat portrait 4" loading="lazy">
                            <?php endif; ?>
                        </figure>
                    </div>
                    <div class="promo-work-line two-portrait">
                        <figure class="promo-work-line-shot">
                            <?php if ( $work_row4_left_url ) : ?>
                                <img src="<?php echo esc_url( $work_row4_left_url ); ?>" alt="Lipblush résultat portrait 5" loading="lazy">
                            <?php endif; ?>
                        </figure>
                        <figure class="promo-work-line-shot">
                            <?php if ( $work_row4_right_url ) : ?>
                                <img src="<?php echo esc_url( $work_row4_right_url ); ?>" alt="Lipblush résultat portrait 6" loading="lazy">
                            <?php endif; ?>
                        </figure>
                    </div>
                    <div class="promo-work-line one-square">
                        <figure class="promo-work-line-shot">
                            <?php if ( $work_row5_square_url ) : ?>
                                <img src="<?php echo esc_url( $work_row5_square_url ); ?>" alt="Lipblush résultat carré" loading="lazy">
                            <?php endif; ?>
                        </figure>
                    </div>
                    <div class="promo-work-line one-portrait">
                        <figure class="promo-work-line-shot">
                            <?php if ( $work_row6_portrait_url ) : ?>
                                <img src="<?php echo esc_url( $work_row6_portrait_url ); ?>" alt="Lipblush résultat portrait final" loading="lazy">
                            <?php endif; ?>
                        </figure>
                    </div>
                </div>
                <div class="promo-work-row promo-work-row-lash" aria-label="Sous-section lash lift coréen">
                    <h3 class="promo-work-row-title">Lash lift coréen</h3>
                    <p class="promo-work-row-text">un regard plus ouvert et expressif</p>
                    <span class="promo-work-row-separator" aria-hidden="true"></span>
                </div>
                <p class="promo-work-row-subtext promo-work-row-subtext-below">+Teinture de cils</p>
                <div class="promo-work-lines" aria-label="Lash lift coréen avant après">
                    <div class="promo-work-line two-landscape-small">
                        <figure class="promo-work-line-shot">
                            <span class="promo-work-badge promo-work-badge-left">Avant</span>
                            <?php if ( $lashlift_before_1_url ) : ?>
                                <img src="<?php echo esc_url( $lashlift_before_1_url ); ?>" alt="Lash lift coréen avant 1" loading="lazy">
                            <?php endif; ?>
                        </figure>
                        <figure class="promo-work-line-shot">
                            <span class="promo-work-badge promo-work-badge-right">Après</span>
                            <?php if ( $lashlift_after_1_url ) : ?>
                                <img src="<?php echo esc_url( $lashlift_after_1_url ); ?>" alt="Lash lift coréen après 1" loading="lazy">
                            <?php endif; ?>
                        </figure>
                    </div>
                    <div class="promo-work-line two-landscape-small">
                        <figure class="promo-work-line-shot">
                            <span class="promo-work-badge promo-work-badge-left">Avant</span>
                            <?php if ( $lashlift_before_2_url ) : ?>
                                <img src="<?php echo esc_url( $lashlift_before_2_url ); ?>" alt="Lash lift coréen avant 2" loading="lazy">
                            <?php endif; ?>
                        </figure>
                        <figure class="promo-work-line-shot">
                            <span class="promo-work-badge promo-work-badge-right">Après</span>
                            <?php if ( $lashlift_after_2_url ) : ?>
                                <img src="<?php echo esc_url( $lashlift_after_2_url ); ?>" alt="Lash lift coréen après 2" loading="lazy">
                            <?php endif; ?>
                        </figure>
                    </div>
                </div>
                <a class="promo-work-cta" href="<?php echo esc_url( home_url( '/reservation/' ) ); ?>">Rendez-vous</a>
            </section>

            <section class="promo-work-intro" aria-label="Section à propos de moi">
                <hr class="promo-work-divider" aria-hidden="true">
                <h2 class="promo-work-title">À PROPOS DE MOI</h2>
                <hr class="promo-work-divider" aria-hidden="true">
                <div class="promo-about-content">
                    <figure class="promo-about-photo">
                        <?php if ( $about_image_url ) : ?>
                            <img src="<?php echo esc_url( $about_image_url ); ?>" alt="Portrait de Lisa" loading="lazy">
                        <?php endif; ?>
                    </figure>
                    <p class="promo-about-text">Moi c’est Lisa, passionnée par la beauté, j’aime aider les femmes à se sentir bien dans leur peau. À travers le Lip Blush et le Lash Lift, mon but est de mettre en valeur votre beauté naturelle.</p>
                </div>
                <div class="promo-about-content promo-about-content-reverse">
                    <p class="promo-about-text">J’accorde beaucoup d’importance à chaque détail pour vous offrir un résultat qui vous ressemble et dans lequel vous vous sentez bien.</p>
                    <figure class="promo-about-photo promo-about-photo-landscape">
                        <?php if ( $about_secondary_image_url ) : ?>
                            <img src="<?php echo esc_url( $about_secondary_image_url ); ?>" alt="Lisa au travail" loading="lazy">
                        <?php endif; ?>
                    </figure>
                </div>
            </section>

            <section class="promo-work-intro" aria-label="Section le studio">
                <hr class="promo-work-divider" aria-hidden="true">
                <h2 class="promo-work-title">LE STUDIO</h2>
                <hr class="promo-work-divider" aria-hidden="true">
                <div class="promo-about-content promo-about-content-reverse">
                    <p class="promo-about-text">Espace partagé entre artistes en maquillage permanent, Je vous reçois dans un local style loft du quartier industriel d'austhic</p>
                    <figure class="promo-about-photo">
                        <?php if ( $about_image_url ) : ?>
                            <img src="<?php echo esc_url( $about_image_url ); ?>" alt="Le studio" loading="lazy">
                        <?php endif; ?>
                    </figure>
                </div>
                <div class="promo-about-content">
                    <figure class="promo-about-photo promo-about-photo-landscape">
                        <?php if ( $about_secondary_image_url ) : ?>
                            <img src="<?php echo esc_url( $about_secondary_image_url ); ?>" alt="Le studio intérieur" loading="lazy">
                        <?php endif; ?>
                    </figure>
                    <p class="promo-about-text">Murs de brique, haut plafonds, sofa. Ici c'est un safe space où vous pouvez communiquer avec aise ce que vous voulez et ce que vous je voulez pas.</p>
                </div>
            </section>

        </div>
    </main>

    <div id="promo-footer-insert" class="promo-footer-insert">
        <div class="promo-duo-wrap">
            <section class="promo-shop-address" aria-label="Adresse du shop">
                <hr class="promo-shop-address-line" aria-hidden="true">
                <p class="promo-shop-address-text">467 Rue de Port-Royal Ouest<br>Montreal</p>
                <hr class="promo-shop-address-line" aria-hidden="true">
            </section>
        </div>

        <section class="promo-full-map-section" aria-label="Carte du shop">
            <div class="promo-full-map-wrap">
                <iframe
                    title="The Pigment Room location map"
                    src="<?php echo esc_url( 'https://www.google.com/maps?q=' . rawurlencode( '467 Rue de Port-Royal Ouest, Montreal, QC' ) . '&z=11&output=embed' ); ?>"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen>
                </iframe>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var footer = document.getElementById('colophon');
            var promoFooterInsert = document.getElementById('promo-footer-insert');

            if (!footer || !promoFooterInsert || footer.contains(promoFooterInsert)) {
                return;
            }

            footer.insertBefore(promoFooterInsert, footer.firstChild);
        });
    </script>

<?php
endwhile;
?>

</div><!-- #primary -->

<?php
get_footer();
