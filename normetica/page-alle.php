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

get_header();


if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'single' ) && woostify_elementor_has_location( 'single' ) ) {
	$frontend = new \Elementor\Frontend();
	echo $frontend->get_builder_content_for_display( get_the_ID(), true ); // phpcs:ignore
	wp_reset_postdata();
} else {
	?>

	<template>
    <article>
         <h2></h2>

    <div>
		   <img class="produkt-billede" src="" alt="">
        <p class="tekst"></p>
        <p class="pris"></p>
        </div>
        </article>
	</template>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<?php
				while ( have_posts() ) :
					the_post();

					do_action( 'woostify_page_before' );

					get_template_part( 'template-parts/content', 'page' );

					/**
					 * Functions hooked in to woostify_page_after action
					 *
					 * @hooked woostify_display_comments - 10
					 */
					do_action( 'woostify_page_after' );

				endwhile;
				?>
				<h1>Alle Produkter</h1>
<section  class="produkt-container">
</section>
			</main>
		</div>
		<div class="divider"></div>
	<?php

	do_action( 'woostify_sidebar' ); 
}

get_footer(); ?>
<script>
function hej(){
 console.log("hej");
}

hej();
 let opskrifter;
//  let categories;
//  let filterRet;

 const dbUrl = "https://vinterfjell.dk/kea/10_eksamen/normetica/wp-json/wp/v2/produkt";
//  const catUrl = "https://helbo.one/kea/tema_09/passion-wp/wp-json/wp/v2/categories";

 async function getJson(){
     const data = await fetch(dbUrl);
    //  const catdata = await fetch(catUrl);

     opskrifter = await data.json();
    //  categories = await catdata.json();

     console.log(opskrifter);
     visMad();
 }



 function visMad(){
     let temp = document.querySelector("template");
     let container = document.querySelector(".produkt-container");
     container.innerHTML = "";
     opskrifter.forEach(opskrift => {
        //  if (opskrift.categories.includes(parseInt(filterRet))){
         let klon = temp.cloneNode(true).content;
         klon.querySelector("h2").innerHTML = opskrift.title.rendered;
         klon.querySelector("img").src = opskrift.billede.guid;
         klon.querySelector(".tekst").textContent = opskrift.pris;
        //  klon.querySelector("article").addEventListener("click", ()=> {location.href = opskrift.link; })
         container.appendChild(klon);
            //  }
     })

 }

 getJson();
</script>