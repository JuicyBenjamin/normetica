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
		<div class="billede-container">
			<img class="produkt-billede" src="" alt="">
		</div>
		<div class="beskrivelse-container">
			<h2></h2>
			<p class="pris"></p>
			<button>Læs Mere</button>
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
		<div class="knapContainer"></div>
		<section class="produkt-container">
		</section>
	</main>
</div>
<div class="divider"></div>

<?php

	do_action( 'woostify_sidebar' ); 
}

get_footer(); ?>
<script>
	document.addEventListener("DOMContentLoaded", getJson);

	let produkter;
	let filter = "alle";

	const dbUrl = "https://vinterfjell.dk/kea/10_eksamen/normetica/wp-json/wp/v2/produkt";
	const catUrl = "https://vinterfjell.dk/kea/10_eksamen/normetica/wp-json/wp/v2/categories";

	async function getJson(){
  	const data = await fetch(dbUrl);
		const catData = await fetch(catUrl);
		produkter = await data.json();
		knapKategori = await catData.json();

		tilfojKnapper();
    visProdukter();
 	}
	
	function tilfojKnapper() {
		let knapContainer = document.querySelector(".knapContainer");
		knapKategori.forEach((kategori) => {
			if (kategori.id === 1) {
				knapContainer.innerHTML += `<button class="valgt filter" data-kategori="${kategori.id}">${kategori.name}</button>`
			} else {
				knapContainer.innerHTML += `<button class="filter" data-kategori="${kategori.id}">${kategori.name}</button>`;
			}
		})
		const btnEvent = () => {
			document.querySelectorAll(".knapContainer button").forEach(btn => {
				btn.addEventListener("click", filtrerProdukter)
			})
		}
		btnEvent()
		return
	}

	function filtrerProdukter() {
			filter = this.dataset.kategori;
			document.querySelector(".valgt").classList.remove("valgt");
			this.classList.add("valgt");
			visProdukter();
	}

	function visProdukter(){
  	let temp = document.querySelector("template");
    let container = document.querySelector(".produkt-container");
    container.innerHTML = "";
    produkter.forEach(produkt => {
    	if (produkt.categories.includes(parseInt(filter)) || filter == "alle") {
				let klon = temp.cloneNode(true).content;
				klon.querySelector("h2").innerHTML = `${produkt.brand} <br> ${produkt.navn}`;
				klon.querySelector("img").src = produkt.billede.guid;
				klon.querySelector(".pris").textContent = produkt.pris;
				klon.querySelector("article").addEventListener("click", ()=> {location.href = produkt.link; })
				container.appendChild(klon);
      }
    })

 }
</script>