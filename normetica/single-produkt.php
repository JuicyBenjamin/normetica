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

<main class="single-produkt-page">
  <div class="single-produkt-container">
    <div class="billede-container">
      <img class="single-produkt-image"></img>
    </div>
    <div class="beskrivelse-container">
      <h1 class="single-produkt-heading"></h1>
      <p class="single-produkt-pris"></p>
      <p class="single-produkt-beskrivelse"></p>
      <button>Køb nu</button>
    </div>
  </div>
</main>
<div class="divider"></div>
<?php
get_footer(); ?>

<script>
	let produkt;

	const dbUrl = "https://vinterfjell.dk/kea/10_eksamen/normetica/wp-json/wp/v2/produkt/"+<?php echo get_the_ID() ?>;

	async function getJson(){
  	const data = await fetch(dbUrl);
		produkt = await data.json();
    visProdukter();
 }

	function visProdukter(){
    document.querySelector(".single-produkt-heading").innerHTML = produkt.title.rendered;
    document.querySelector(".single-produkt-image").src = produkt.billede.guid;
    document.querySelector(".single-produkt-beskrivelse").textContent = produkt.beskrivelse;
    document.querySelector(".single-produkt-pris").textContent = produkt.pris;
  }
	getJson();
</script>