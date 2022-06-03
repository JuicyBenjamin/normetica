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
  <div class="video-container">
    <video
          autoplay
          loop
          muted
          src="https://vinterfjell.dk/kea/10_eksamen/normetica/wp-content/uploads/2022/06/splashvideo_test.webm"
        ></video>
  </div>
  <section class="section-produkter-og-services">
    <div class="beskrivelse-container">
      <h2>Find den rigtige behandling til dig og book tid</h2>
      <button>Find behandling</button>
    </div>
    <div class="beskrivelse-container">
      <h2>Find de rigtige produkter til dig</h2>
      <button>Find produkter</button>
    </div>
  </section>
  <section class="section-book-tid">
    <div class="billede-container">
      <img src="" alt="">
    </div> 
  </section>
</main>
<div class="divider"></div>
<?php
get_footer(); ?>