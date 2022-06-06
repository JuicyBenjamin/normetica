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
    <h1>Velkommen til Normetica's Hårtransplantationer</h1>
  </div>
  <div class="relative-container">
    <div class="video-container">
      <video
            autoplay
            loop
            muted
            src="https://vinterfjell.dk/kea/10_eksamen/normetica/wp-content/uploads/2022/06/splashvideo_test.webm"
          ></video>
    </div>
  </div>
  <section class="section-produkter-og-services">
    <div class="produkter-og-services-container">
      <div class="beskrivelse-container">
        <h2>Find den rigtige behandling til dig og book tid</h2>
        <button>Find behandling</button>
      </div>
      <div class="beskrivelse-container">
        <h2>Find de rigtige produkter til dig</h2>
        <button>Find produkter</button>
      </div>
    </div>
  </section>
  <section class="section-book-tid">
    <div class="billede-container">
      <img src="https://vinterfjell.dk/kea/10_eksamen/normetica/wp-content/uploads/2022/06/lady_stock-scaled.webp" alt="">
    </div> 
    <div class="beskrivelse-container">
      <h2>Find de rigtige produkter til dig</h2>
      <p>Normetica hjælper mænd og kvinder, med at få deres hår tilbage.</p>
      <a class="button" href="tel: +45 31 42 42 62">RING TIL OS I DAG</a>
    </div>
  </section>
</main>
<div class="divider-fp"></div>
<?php
get_footer(); ?>