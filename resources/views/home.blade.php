<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#17251e">

    <title>CUTIFY — Your Style, Your Rules</title>

    <meta name="description" content="Temukan gaya rambut terbaikmu bersama CUTIFY. Lihat layanan, harga, dan barber pilihanmu.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #17251e;
            --ink-soft: #23372c;
            --cream: #f4f0e7;
            --paper: #e9e3d6;
            --white: #fffdf7;
            --orange: #e97849;
            --muted: #7c8379;
            --line: rgba(23, 37, 30, .15);
            --font-display: 'Space Grotesk', sans-serif;
            --font-body: 'DM Sans', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        body {
            background: var(--cream);
            color: var(--ink);
            font-family: var(--font-body);
            -webkit-font-smoothing: antialiased;
        }

        body, button, a {
            -webkit-tap-highlight-color: transparent;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        img {
            display: block;
            width: 100%;
        }

        .container {
            width: min(1180px, calc(100% - 64px));
            margin-inline: auto;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2.2px;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: "";
            width: 22px;
            height: 2px;
            background: var(--orange);
        }

        .section-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 36px;
        }

        .section-heading h2 {
            margin-top: 13px;
            font-family: var(--font-display);
            font-size: clamp(34px, 4.4vw, 56px);
            line-height: 1.02;
            letter-spacing: -2.6px;
            font-weight: 700;
        }

        .section-heading p {
            max-width: 310px;
            color: #6e766e;
            font-size: 13px;
            line-height: 1.8;
        }

        /* NAVIGATION */

        .site-header {
            position: relative;
            z-index: 10;
            background: var(--cream);
            border-bottom: 1px solid var(--line);
        }

        .nav {
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            flex-shrink: 0;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 39px;
            height: 39px;
            color: var(--cream);
            background: var(--ink);
            font-family: var(--font-display);
            font-size: 21px;
            font-weight: 700;
            transform: rotate(-4deg);
        }

        .brand-name {
            font-family: var(--font-display);
            font-size: 23px;
            font-weight: 700;
            letter-spacing: -1.2px;
        }

        .brand-name span {
            color: var(--orange);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-links a {
            position: relative;
            color: #4c574e;
            font-size: 12px;
            font-weight: 700;
            transition: color .2s;
        }

        .nav-links a:not(.nav-cta)::after {
            position: absolute;
            right: 0;
            bottom: -7px;
            left: 0;
            height: 2px;
            content: "";
            background: var(--orange);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .2s;
        }

        .nav-links a:not(.nav-cta):hover::after {
            transform: scaleX(1);
        }

        .nav-cta {
            display: inline-flex;
            align-items: center;
            gap: 18px;
            padding: 14px 17px;
            color: var(--cream) !important;
            background: var(--ink);
            transition: background .2s, transform .2s;
        }

        .nav-cta:hover {
            background: var(--orange);
            transform: translateY(-2px);
        }

        .nav-cta span {
            font-size: 18px;
            line-height: 10px;
        }

        .menu-toggle {
            display: none;
            width: 44px;
            height: 44px;
            border: 1px solid var(--line);
            background: transparent;
            color: var(--ink);
            cursor: pointer;
        }

        /* HERO */

        .hero {
            padding: 46px 0 68px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: .93fr 1.07fr;
            align-items: center;
            gap: 56px;
        }

        .hero-copy {
            padding: 20px 0 30px;
        }

        .hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 12px;
            border: 1px solid rgba(23, 37, 30, .16);
            border-radius: 2px;
            color: #465349;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .live-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--orange);
            box-shadow: 0 0 0 4px rgba(233, 120, 73, .13);
        }

        .hero h1 {
            max-width: 600px;
            margin: 27px 0 23px;
            font-family: var(--font-display);
            font-size: clamp(58px, 7.3vw, 92px);
            font-weight: 700;
            letter-spacing: -7px;
            line-height: .91;
        }

        .hero h1 .accent {
            color: var(--orange);
        }

        .hero h1 .outline {
            color: transparent;
            -webkit-text-stroke: 1.5px var(--ink);
        }

        .hero-description {
            max-width: 400px;
            color: #677167;
            font-size: 14px;
            line-height: 1.9;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 13px;
            margin-top: 29px;
        }

        .button-primary {
            display: inline-flex;
            min-height: 54px;
            align-items: center;
            justify-content: center;
            gap: 23px;
            padding: 0 19px;
            border: 1px solid var(--ink);
            color: var(--cream);
            background: var(--ink);
            font-size: 12px;
            font-weight: 800;
            transition: background .2s, border-color .2s, transform .2s;
        }

        .button-primary:hover {
            border-color: var(--orange);
            background: var(--orange);
            transform: translateY(-3px);
        }

        .button-primary span {
            font-size: 19px;
        }

        .button-text {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 15px 7px;
            font-size: 12px;
            font-weight: 800;
        }

        .button-text span {
            color: var(--orange);
            font-size: 18px;
            transition: transform .2s;
        }

        .button-text:hover span {
            transform: translateX(5px);
        }

        .hero-proof {
            display: flex;
            align-items: center;
            gap: 17px;
            margin-top: 45px;
            padding-top: 23px;
            border-top: 1px solid var(--line);
        }

        .proof-number {
            font-family: var(--font-display);
            font-size: 27px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .proof-label {
            margin-top: 3px;
            color: #7b8178;
            font-size: 10px;
            line-height: 1.5;
        }

        .proof-divider {
            width: 1px;
            height: 37px;
            background: var(--line);
        }

        .hero-visual {
            position: relative;
            min-width: 0;
        }

        .hero-image-wrap {
            position: relative;
            height: 555px;
            overflow: hidden;
            background: #28362c;
        }

        .hero-image-wrap::after {
            position: absolute;
            inset: 0;
            content: "";
            background: linear-gradient(
                180deg,
                transparent 45%,
                rgba(12, 20, 15, .7) 100%
            );
            pointer-events: none;
        }

        .hero-image {
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform .7s ease;
        }

        .hero-visual:hover .hero-image {
            transform: scale(1.035);
        }

        .image-label {
            position: absolute;
            z-index: 1;
            right: 22px;
            bottom: 24px;
            left: 22px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
            color: white;
        }

        .image-label small {
            display: block;
            margin-bottom: 7px;
            color: #e5b69e;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .image-label strong {
            font-family: var(--font-display);
            font-size: 24px;
            letter-spacing: -.7px;
        }

        .image-index {
            display: grid;
            place-items: center;
            width: 45px;
            height: 45px;
            border: 1px solid rgba(255,255,255,.55);
            font-family: var(--font-display);
            font-size: 12px;
        }

        .floating-note {
            position: absolute;
            top: 43px;
            left: -28px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 18px;
            color: var(--ink);
            background: var(--white);
            box-shadow: 0 12px 32px rgba(0,0,0,.08);
        }

        .note-icon {
            display: grid;
            place-items: center;
            width: 37px;
            height: 37px;
            color: white;
            background: var(--orange);
            font-size: 19px;
        }

        .floating-note strong {
            display: block;
            font-size: 12px;
        }

        .floating-note small {
            display: block;
            margin-top: 4px;
            color: var(--muted);
            font-size: 10px;
        }

        /* MARQUEE STRIP */

        .ticker {
            overflow: hidden;
            color: var(--cream);
            background: var(--ink);
        }

        .ticker-track {
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 30px;
            min-height: 66px;
            padding: 10px 20px;
        }

        .ticker-item {
            display: inline-flex;
            align-items: center;
            gap: 13px;
            white-space: nowrap;
            font-family: var(--font-display);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .ticker-item span {
            color: var(--orange);
            font-size: 18px;
        }

        /* SERVICES */

        .services {
            padding: 105px 0;
        }

        .text-link {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            padding-bottom: 7px;
            border-bottom: 1px solid var(--ink);
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .text-link span {
            color: var(--orange);
            font-size: 18px;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            border-top: 1px solid var(--line);
            border-left: 1px solid var(--line);
        }

        .service-card {
            position: relative;
            display: flex;
            min-height: 285px;
            flex-direction: column;
            padding: 26px 24px 23px;
            border-right: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            transition: color .25s, background .25s;
        }

        .service-card:hover {
            color: var(--cream);
            background: var(--ink);
        }

        .service-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .service-number {
            color: #90978e;
            font-family: var(--font-display);
            font-size: 12px;
        }

        .service-symbol {
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            border: 1px solid var(--line);
            color: var(--orange);
            font-family: var(--font-display);
            font-size: 18px;
            transition: border-color .25s;
        }

        .service-card:hover .service-symbol {
            border-color: rgba(255,255,255,.3);
        }

        .service-card h3 {
            margin-top: 36px;
            font-family: var(--font-display);
            font-size: 23px;
            letter-spacing: -.8px;
        }

        .service-card p {
            max-width: 285px;
            margin-top: 10px;
            color: #737b71;
            font-size: 12px;
            line-height: 1.8;
            transition: color .25s;
        }

        .service-card:hover p {
            color: #c0c8bd;
        }

        .service-bottom {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 10px;
            margin-top: auto;
            padding-top: 25px;
        }

        .service-price {
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -.8px;
        }

        .service-duration {
            color: #858b82;
            font-size: 10px;
            white-space: nowrap;
        }

        .empty-note {
            grid-column: 1 / -1;
            padding: 30px;
            color: var(--muted);
            font-size: 13px;
        }

        /* ABOUT */

        .about {
            padding: 84px 0;
            color: var(--cream);
            background: var(--ink);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 80px;
        }

        .about-visual {
            position: relative;
            min-height: 420px;
            background: #26382c;
        }

        .about-visual img {
            position: absolute;
            inset: 0;
            height: 100%;
            object-fit: cover;
            opacity: .87;
        }

        .about-stamp {
            position: absolute;
            right: -22px;
            bottom: 25px;
            display: grid;
            place-items: center;
            width: 108px;
            height: 108px;
            border: 7px solid var(--ink);
            border-radius: 50%;
            color: var(--ink);
            background: var(--orange);
            text-align: center;
            transform: rotate(10deg);
        }

        .about-stamp strong {
            font-family: var(--font-display);
            font-size: 19px;
            line-height: 1;
        }

        .about-stamp small {
            margin-top: -13px;
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .about-copy .eyebrow {
            color: #d2d7ce;
        }

        .about-copy h2 {
            margin: 22px 0;
            font-family: var(--font-display);
            font-size: clamp(38px, 5vw, 59px);
            line-height: 1;
            letter-spacing: -3px;
        }

        .about-copy h2 em {
            color: var(--orange);
            font-style: normal;
        }

        .about-copy > p {
            max-width: 440px;
            color: #b5beb3;
            font-size: 13px;
            line-height: 2;
        }

        .about-points {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 30px 0;
            padding-top: 23px;
            border-top: 1px solid rgba(255,255,255,.15);
        }

        .about-point strong {
            display: block;
            font-family: var(--font-display);
            font-size: 16px;
        }

        .about-point span {
            display: block;
            margin-top: 6px;
            color: #a5b0a4;
            font-size: 11px;
            line-height: 1.7;
        }

        .about .button-primary {
            border-color: var(--orange);
            color: var(--ink);
            background: var(--orange);
        }

        .about .button-primary:hover {
            border-color: var(--cream);
            background: var(--cream);
        }

        /* BARBERS */

        .barbers {
            padding: 100px 0;
        }

        .barber-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .barber-card {
            position: relative;
            display: flex;
            min-height: 220px;
            flex-direction: column;
            justify-content: space-between;
            padding: 25px;
            overflow: hidden;
            border: 1px solid var(--line);
            background: rgba(255,255,255,.2);
            transition: background .25s, transform .25s;
        }

        .barber-card:hover {
            background: var(--white);
            transform: translateY(-4px);
        }

        .barber-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .barber-avatar {
            display: grid;
            place-items: center;
            width: 53px;
            height: 53px;
            color: var(--cream);
            background: var(--ink);
            font-family: var(--font-display);
            font-size: 21px;
            font-weight: 700;
        }

        .barber-index {
            color: #939a90;
            font-family: var(--font-display);
            font-size: 12px;
        }

        .barber-card h3 {
            margin-top: 25px;
            font-family: var(--font-display);
            font-size: 21px;
            letter-spacing: -.7px;
        }

        .barber-role {
            display: inline-block;
            margin-top: 7px;
            color: #7b8378;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .barber-arrow {
            position: absolute;
            right: 24px;
            bottom: 25px;
            color: var(--orange);
            font-size: 22px;
        }

        /* CTA */

        .final-cta {
            padding: 0 0 95px;
        }

        .cta-panel {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            padding: 48px;
            overflow: hidden;
            color: var(--cream);
            background: var(--orange);
        }

        .cta-panel::after {
            position: absolute;
            top: -110px;
            right: 150px;
            width: 270px;
            height: 270px;
            border: 1px solid rgba(23,37,30,.2);
            border-radius: 50%;
            content: "";
            box-shadow: 0 0 0 35px rgba(23,37,30,.04),
                        0 0 0 70px rgba(23,37,30,.035);
            pointer-events: none;
        }

        .cta-copy {
            position: relative;
            z-index: 1;
        }

        .cta-copy .eyebrow {
            color: var(--ink);
        }

        .cta-copy h2 {
            max-width: 560px;
            margin-top: 15px;
            color: var(--ink);
            font-family: var(--font-display);
            font-size: clamp(32px, 4vw, 48px);
            line-height: 1.05;
            letter-spacing: -2px;
        }

        .cta-copy p {
            margin-top: 12px;
            color: #4e3b31;
            font-size: 12px;
            line-height: 1.8;
        }

        .cta-panel .button-primary {
            position: relative;
            z-index: 1;
            flex-shrink: 0;
            border-color: var(--ink);
            color: var(--cream);
            background: var(--ink);
        }

        .cta-panel .button-primary:hover {
            border-color: var(--cream);
            color: var(--ink);
            background: var(--cream);
        }

        /* FOOTER */

        .site-footer {
            color: var(--cream);
            background: #111b15;
        }

        .footer-main {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 35px;
            padding: 43px 0;
        }

        .footer-brand .brand-mark {
            color: var(--ink);
            background: var(--orange);
        }

        .footer-brand .brand-name {
            color: var(--cream);
        }

        .footer-brand p {
            max-width: 290px;
            margin-top: 17px;
            color: #a5afa5;
            font-size: 11px;
            line-height: 1.9;
        }

        .footer-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 23px;
            padding-top: 10px;
        }

        .footer-nav a {
            color: #c2c9bf;
            font-size: 11px;
            transition: color .2s;
        }

        .footer-nav a:hover {
            color: var(--orange);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 0;
            border-top: 1px solid rgba(255,255,255,.12);
            color: #89958a;
            font-size: 10px;
        }

        .footer-bottom span:last-child {
            text-align: right;
        }

        /* RESPONSIVE */

        @media (max-width: 950px) {
            .container {
                width: min(100% - 42px, 760px);
            }

            .nav-links {
                gap: 19px;
            }

            .hero-grid {
                grid-template-columns: 1fr 1fr;
                gap: 28px;
            }

            .hero h1 {
                font-size: clamp(55px, 8vw, 75px);
                letter-spacing: -5px;
            }

            .hero-image-wrap {
                height: 475px;
            }

            .floating-note {
                left: -10px;
            }

            .about-grid {
                gap: 45px;
            }

            .about-visual {
                min-height: 370px;
            }

            .service-card {
                padding-inline: 18px;
            }

            .cta-panel {
                padding: 35px;
            }
        }

        @media (max-width: 700px) {
            html {
                scroll-padding-top: 20px;
            }

            .container {
                width: calc(100% - 36px);
            }

            .nav {
                min-height: 72px;
            }

            .brand-name {
                font-size: 21px;
            }

            .menu-toggle {
                display: grid;
                place-items: center;
                flex-shrink: 0;
            }

            .menu-toggle svg {
                width: 22px;
                height: 22px;
            }

            .nav-links {
                position: absolute;
                top: calc(100% + 1px);
                right: 0;
                left: 0;
                display: none;
                align-items: stretch;
                gap: 0;
                padding: 12px 18px 20px;
                border-bottom: 1px solid var(--line);
                background: var(--cream);
            }

            .nav-links.is-open {
                display: flex;
                flex-direction: column;
            }

            .nav-links > a:not(.nav-cta) {
                padding: 15px 2px;
                border-bottom: 1px solid var(--line);
            }

            .nav-cta {
                justify-content: space-between;
                margin-top: 14px;
            }

            .hero {
                padding: 35px 0 43px;
            }

            .hero-grid {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .hero-copy {
                padding: 0;
            }

            .hero h1 {
                max-width: 480px;
                margin-top: 23px;
                font-size: clamp(58px, 14vw, 82px);
                letter-spacing: -5px;
            }

            .hero-description {
                max-width: 450px;
                font-size: 13px;
            }

            .hero-proof {
                margin-top: 29px;
            }

            .hero-image-wrap {
                height: 420px;
            }

            .floating-note {
                top: 20px;
                left: 12px;
                padding: 12px;
            }

            .ticker-track {
                justify-content: flex-start;
                overflow-x: auto;
                scrollbar-width: none;
            }

            .ticker-track::-webkit-scrollbar {
                display: none;
            }

            .ticker-item {
                font-size: 10px;
            }

            .services,
            .barbers {
                padding: 72px 0;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 17px;
                margin-bottom: 26px;
            }

            .section-heading h2 {
                font-size: 42px;
                letter-spacing: -2px;
            }

            .section-heading p {
                font-size: 12px;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .service-card {
                min-height: 235px;
                padding: 22px;
            }

            .service-card h3 {
                margin-top: 26px;
            }

            .service-bottom {
                padding-top: 20px;
            }

            .about {
                padding: 60px 0;
            }

            .about-grid {
                grid-template-columns: 1fr;
                gap: 38px;
            }

            .about-visual {
                min-height: 340px;
                margin-right: 10px;
            }

            .about-copy h2 {
                font-size: 48px;
                letter-spacing: -2.5px;
            }

            .barber-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .barber-card {
                min-height: 185px;
            }

            .final-cta {
                padding-bottom: 65px;
            }

            .cta-panel {
                align-items: flex-start;
                flex-direction: column;
                padding: 29px 24px;
            }

            .cta-copy h2 {
                font-size: 37px;
            }

            .cta-panel::after {
                right: -140px;
            }

            .footer-main {
                flex-direction: column;
                padding: 35px 0;
            }

            .footer-nav {
                gap: 18px;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 8px;
                line-height: 1.7;
            }

            .footer-bottom span:last-child {
                text-align: left;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

    <!-- NAVIGATION -->
    <header class="site-header">
        <div class="container nav">

            <a href="#home" class="brand" aria-label="CUTIFY beranda">
                <span class="brand-mark">C.</span>
                <span class="brand-name">CUTI<span>FY</span></span>
            </a>
            <a href="{{ route('admin.login') }}">
    Login Admin
</a>

            <button
                class="menu-toggle"
                id="menuToggle"
                type="button"
                aria-label="Buka menu navigasi"
                aria-expanded="false"
                aria-controls="navLinks"
            >
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round">
                    <path d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </button>

    
<nav class="nav-links" id="navLinks" aria-label="Navigasi utama">
    <a href="#home">Beranda</a>
    <a href="#layanan">Layanan</a>
    <a href="#tentang">Tentang</a>
    <a href="#barber">Barber</a>

    @if (session()->has('pelanggan_id'))
        <a href="{{ route('booking.index') }}">
            Riwayat Booking
        </a>

        <form action="{{ route('logout') }}" method="POST"
              style="display:inline;">
            @csrf
            <button type="submit"
                    style="border:0; background:transparent;
                           color:inherit; font:inherit;
                           font-size:12px; font-weight:700;
                           cursor:pointer; padding:10px 0;">
                Logout
            </button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endif

   
<a href="{{ route('booking.create') }}" class="nav-cta">
    Temukan Gaya <span>↗</span>
</a>

</nav>

        </div>
    </header>

    <main>

        <!-- HERO -->
        <section class="hero" id="home">
            <div class="container hero-grid">

                <div class="hero-copy">
                    <div class="hero-kicker">
                        <span class="live-dot"></span>
                        Bukan sekadar potong rambut
                    </div>

                    <h1>
                        OWN<br>
                        YOUR<br>
                        <span class="accent">LOOK</span><span class="outline">.</span>
                    </h1>

                    <p class="hero-description">
                        Gaya punya cerita. Temukan potongan yang paling
                        cocok dengan karakter lu, ditangani barber yang
                        ngerti detail.
                    </p>

               
<div class="hero-actions">
    <a href="#layanan" class="button-primary">
        Explore layanan <span>↗</span>
    </a>

    <a href="{{ route('booking.create') }}" class="button-text">
        Booking sekarang <span>→</span>
    </a>
</div>


                    <div class="hero-proof">
                        <div>
                            <div class="proof-number">01<span style="color:var(--orange)">.</span></div>
                            <div class="proof-label">Gaya sesuai<br>karakter lu</div>
                        </div>

                        <div class="proof-divider"></div>

                        <div>
                            <div class="proof-number">02<span style="color:var(--orange)">.</span></div>
                            <div class="proof-label">Detail yang<br>jadi prioritas</div>
                        </div>

                        <div class="proof-divider"></div>

                        <div>
                            <div class="proof-number">03<span style="color:var(--orange)">.</span></div>
                            <div class="proof-label">Look yang<br>lebih percaya diri</div>
                        </div>
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="hero-image-wrap">
                        <img
                            class="hero-image"
                            src="https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=1200&q=85"
                            alt="Suasana interior barbershop modern"
                            fetchpriority="high"
                        >

                        <div class="image-label">
                            <div>
                                <small>THE CUTIFY EXPERIENCE</small>
                                <strong>Made for your identity.</strong>
                            </div>
                            <div class="image-index">01 / 03</div>
                        </div>
                    </div>

                    <div class="floating-note">
                        <div class="note-icon">✳</div>
                        <div>
                            <strong>Your style matters.</strong>
                            <small>Good cut. Better confidence.</small>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- BRAND STRIP -->
        <div class="ticker" aria-label="Keunggulan CUTIFY">
            <div class="ticker-track">
                <div class="ticker-item"><span>✳</span> GOOD HAIR DAYS</div>
                <div class="ticker-item"><span>✳</span> YOUR STYLE YOUR RULES</div>
                <div class="ticker-item"><span>✳</span> DETAILS MATTER</div>
                <div class="ticker-item"><span>✳</span> LOOK SHARP</div>
            </div>
        </div>

        <!-- SERVICES -->
        <section class="services" id="layanan">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <div class="eyebrow">The menu</div>
                        <h2>Find your<br>signature cut.</h2>
                    </div>

                    <p>
                        Dari potongan klasik sampai gaya yang lebih berani.
                        Pilih layanan sesuai kebutuhan dan karakter rambut lu.
                    </p>
                </div>

                <div class="service-grid">
                    @forelse ($layanans as $index => $layanan)
                        <article class="service-card">

                            <div class="service-top">
                                <span class="service-number">
                                    SERVICE / {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <span class="service-symbol">
                                    @if ($index % 3 === 0)
                                        ✳
                                    @elseif ($index % 3 === 1)
                                        /
                                    @else
                                        +
                                    @endif
                                </span>
                            </div>

                            <h3>{{ $layanan->nama_layanan }}</h3>

                            <p>
                                {{ $layanan->deskripsi ?: 'Perawatan dan potongan rambut yang disesuaikan dengan gaya pilihan lu.' }}
                            </p>

                            <div class="service-bottom">
                                <div class="service-price">
                                    Rp{{ number_format((float) $layanan->harga, 0, ',', '.') }}
                                </div>

                                <div class="service-duration">
                                    {{ $layanan->durasi }} menit
                                </div>
                            </div>

                        </article>
                    @empty
                        <div class="empty-note">
                            Belum ada layanan yang tersedia.
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

        <!-- ABOUT -->
        <section class="about" id="tentang">
            <div class="container about-grid">

                <div class="about-visual">
                    <img
                        src="https://images.unsplash.com/photo-1621605815971-fbc98d665033?auto=format&fit=crop&w=1000&q=85"
                        alt="Barber sedang mengerjakan potongan rambut"
                        loading="lazy"
                    >

                    <div class="about-stamp">
                        <strong>STAY<br>SHARP.</strong>
                        <small>EST. CUTIFY</small>
                    </div>
                </div>

                <div class="about-copy">
                    <div class="eyebrow">More than a haircut</div>

                    <h2>
                        Detail kecil.<br>
                        <em>Bedanya besar.</em>
                    </h2>

                    <p>
                        CUTIFY hadir buat lu yang percaya kalau penampilan
                        bukan soal ikut tren doang. Ini soal menemukan
                        gaya yang nyaman, rapi, dan terasa seperti diri lu
                        sendiri.
                    </p>

                    <div class="about-points">
                        <div class="about-point">
                            <strong>Know your style</strong>
                            <span>Pilih gaya yang sesuai karakter dan kebutuhan.</span>
                        </div>

                        <div class="about-point">
                            <strong>Respect the details</strong>
                            <span>Perhatian pada detail di setiap potongan.</span>
                        </div>
                    </div>

                    <a href="#barber" class="button-primary">
                        Kenali tim barber <span>↗</span>
                    </a>
                </div>

            </div>
        </section>

        <!-- BARBERS -->
        <section class="barbers" id="barber">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <div class="eyebrow">Meet the crew</div>
                        <h2>Good hands.<br>Great cuts.</h2>
                    </div>

                    <p>
                        Setiap gaya butuh tangan yang tepat.
                        Kenali tim yang siap membantu lu menemukan look terbaik.
                    </p>
                </div>

                <div class="barber-grid">
                    @forelse ($barbers as $index => $barber)
                        <article class="barber-card">
                            <div class="barber-top">
                                <div class="barber-avatar">
                                    {{ strtoupper(substr($barber->nama_barber, 0, 1)) }}
                                </div>

                                <span class="barber-index">
                                    CREW / {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>

                            <div>
                                <h3>{{ $barber->nama_barber }}</h3>

                                <span class="barber-role">
                                    {{ ['Barber Specialist', 'Style & Fade', 'Hair Artist'][$index % 3] }}
                                </span>
                            </div>

                            <span class="barber-arrow" aria-hidden="true">↗</span>
                        </article>
                    @empty
                        <div class="empty-note">
                            Data barber belum tersedia.
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

        <!-- CTA -->
        <section class="final-cta" id="booking">
            <div class="container">
                <div class="cta-panel">

                    <div class="cta-copy">
                        <div class="eyebrow">Your next look starts here</div>

                        <h2>
                            Fresh cut.<br>
                            Fresh perspective.
                        </h2>

                        <p>
                            Jelajahi layanan CUTIFY dan tentukan gaya
                            yang ingin lu bawa hari ini.
                        </p>
                    </div>

                  
<a href="{{ route('booking.create') }}" class="button-primary">
    Booking sekarang <span>↗</span>
</a>


                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">

            <div class="footer-main">
                <div class="footer-brand">
                    <a href="#home" class="brand">
                        <span class="brand-mark">C.</span>
                        <span class="brand-name">CUTI<span>FY</span></span>
                    </a>

                    <p>
                        Your style, your rules. Tempat buat menemukan
                        potongan yang bukan cuma rapi, tapi juga punya karakter.
                    </p>
                </div>

                <nav class="footer-nav" aria-label="Navigasi footer">
                    <a href="#home">Beranda</a>
                    <a href="#layanan">Layanan</a>
                    <a href="#tentang">Tentang kami</a>
                    <a href="#barber">Tim barber</a>
                </nav>
            </div>

            <div class="footer-bottom">
                <span>
                    © {{ date('Y') }} CUTIFY. All rights reserved.
                </span>

                <span>Designed with character, built for your style.</span>
            </div>

        </div>
    </footer>

    <script>
        (() => {
            const toggle = document.getElementById('menuToggle');
            const nav = document.getElementById('navLinks');

            if (!toggle || !nav) return;

            toggle.addEventListener('click', () => {
                const isOpen = nav.classList.toggle('is-open');

                toggle.setAttribute('aria-expanded', String(isOpen));
                toggle.setAttribute(
                    'aria-label',
                    isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi'
                );
            });

            nav.querySelectorAll('a').forEach((link) => {
                link.addEventListener('click', () => {
                    nav.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.setAttribute('aria-label', 'Buka menu navigasi');
                });
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth > 700) {
                    nav.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        })();
    </script>

</body>
</html>
