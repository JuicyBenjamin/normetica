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
		<h1 class="center">Produkter</h1>
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
	// En event listener som checker at hele siden er loaded og først derefter starter den første funktion getJson
	document.addEventListener("DOMContentLoaded", getJson);

	let produkter;
	let filter = "alle";

	const dbUrl = "https://vinterfjell.dk/kea/10_eksamen/normetica/wp-json/wp/v2/produkt";
	const catUrl = "https://vinterfjell.dk/kea/10_eksamen/normetica/wp-json/wp/v2/categories";

	// Funktion som indhenter JSON data fra wordpress rest api
	// Data der bliver indhentet er alle produkterne og alle kategorierne
	async function getJson(){
  	const data = await fetch(dbUrl);
		const catData = await fetch(catUrl);
		produkter = await data.json();
		knapKategori = await catData.json();

		tilfojKnapper();
    visProdukter();
 	}
	
	// Funktion som tilføjer en knap til filtrering for hver kategori som eksisterer på sitet. 
	// 1) Finder container til knapperne vha queryselector på klassenavnet
	// 2) Et forEach loop, som tilføjer en knap for hver kategori med data-kategori attributten lig kategori id og knappens indhold lig navnet på kategorien
	// 3) Vha en if statement checker den om kategori id er lig 1 (Dette er id'et for alle), da denne skal have en ekstra klasse kaldet "valgt", hvis id'et ikke er 1 gør den ovenstående.
	// 4) Tilføjer en eventlistener på alle knapperne som lytter efter klik, på klik starter den filtrerProdukter funktionen.
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
			// I stedet for at lave en document.querySelector på hver knap til filtrering, bruger vi en document.querySelectorAll som laver en array af alle som matcher.
			// Dette gør vi dels for at minimere gentagne kode, men også så antallet af kategorier kan ændres, uden det vil påvirke funktionaliteten af sitet.
			document.querySelectorAll(".knapContainer button").forEach(btn => {
				btn.addEventListener("click", filtrerProdukter)
			})
		}
		btnEvent()
		return
	}

	// En funktion som ændrer det valgte filter afhængig af hvilken knap som er valgt.
	// Derefter vælger den knappen som har class "valgt" (Det starter med at være knappen alle se evt linje 100) og fjerner den class.
	// Så tilføjer den class "valgt" på den knap som brugeren har trykket på og starter til sidst funktionen visProdukter
	function filtrerProdukter() {
			filter = this.dataset.kategori;
			document.querySelector(".valgt").classList.remove("valgt");
			this.classList.add("valgt");
			visProdukter();
	}

	// Funktionen som viser indholdet af produkter på siden og mere specifikt kun viser indholdet for den valgte kategori.
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