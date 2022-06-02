<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package woostify
 */

get_header(); ?>

<main class="front-page">
  <div class="content">
    <h1 class="stroke-behind">Velkommen til Normetica's Hårtransplantationer</h1>
  </div>
  <div class="video-container">
    <video
          autoplay
          loop
          muted
          src="https://vinterfjell.dk/kea/10_eksamen/normetica/wp-content/uploads/2022/05/forsidevideo.mp4"
        ></video>
  </div>
</main>
<div class="divider"></div>
<?php
get_footer(); ?>