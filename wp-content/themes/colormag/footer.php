<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and closing of the #main div.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */
?>

</div><!-- .inner-wrap -->
</div><!-- #main -->

<?php if ( is_active_sidebar( 'colormag_advertisement_above_the_footer_sidebar' ) ) { ?>
	<div class="advertisement_above_footer">
		<div class="inner-wrap">
			<?php dynamic_sidebar( 'colormag_advertisement_above_the_footer_sidebar' ); ?>
		</div>
	</div>
<?php } ?>

<?php do_action( 'colormag_before_footer' ); ?>

<?php
// Add the main total header area display type dynamic class
$main_total_footer_option_layout_class = get_theme_mod( 'colormag_main_footer_layout_display_type', 'type_one' );

$class_name = '';
if ( $main_total_footer_option_layout_class == 'type_two' ) {
	$class_name = 'colormag-footer--classic';
}
?>

<footer id="colophon" class="clearfix <?php echo esc_attr( $class_name ); ?>">
	<?php get_sidebar( 'footer' ); ?>
	<div class="footer-socket-wrapper clearfix">
		<div class="inner-wrap">
			<p style="text-align: center; color: #fff;">© 2021 - Globaldea</p>
			<div class="footer-socket-area">
				<div class="footer-socket-right-section">
					<?php
					if ( get_theme_mod( 'colormag_social_link_activate', 0 ) == 1 ) {
						colormag_social_links();
					}
					?>
				</div>

				<div class="footer-socket-left-section">
					<div class="copyright"><p style="text-align: left;"><a href="https://globaldea.com/confinanciado/" target="_blank" rel="noopener"><img src="http://globaldea.com/wp-content/uploads/2021/06/letsgo-portugal-1-3.png" alt="Wehub"></a></p></div>
				</div>
			</div>
		</div>
	</div>
</footer>

<a href="#masthead" id="scroll-up"><i class="fa fa-chevron-up"></i></a>

<script>

	
	jQuery( ".module-title > span" ).each(function() {
		
		var categoria = jQuery(this).html();
		//console.log(categoria);
		if(categoria === 'StartUp')
			{
				jQuery(this).addClass('start');
				jQuery(".tg-post-categories > a:contains(StartUp)").addClass('start-up');
				
			}
		else if(categoria === 'Empreendedorismo')
			{
				jQuery(this).addClass('emp');
				jQuery(".tg-post-categories > a:contains(Empreendedorismo)").addClass('empreendedorismo');
				
			}
		else if(categoria === 'Fundos de investimento')
			{
				jQuery(this).addClass('fundos');
				jQuery(".tg-post-categories > a:contains(Fundos de investimento)").addClass('fundo-investimento');
				
			}
		else if(categoria === 'Imobiliário')
			{
				jQuery(this).addClass('imbol');
				jQuery(".tg-post-categories > a:contains(Imobiliário)").addClass('imboliario');
				
			}
		else if(categoria === 'Investimentos')
			{
				jQuery(this).addClass('inves');
				jQuery(".tg-post-categories > a:contains(Investimentos)").addClass('inves');
				
			}
		else if(categoria === 'E-commerce &amp; Marketing Digital')
			{
				jQuery(this).addClass('ecom');
				jQuery(".tg-post-categories > a:contains(E-commerce & Marketing Digital)").addClass('e-commerce');
				
			}
		else if(categoria === 'Viver em Portugal')
			{
				jQuery(this).addClass('portugal');
				jQuery(".tg-post-categories > a:contains(Viver em Portugal)").addClass('viver-portugal');
				
			}
		else if(categoria === 'E-learning')
			{
				jQuery(this).addClass('learn');
				jQuery(".tg-post-categories > a:contains(E-learning)").addClass('e-learning');
				
			}
		else if(categoria === 'Entrevistas Exclusivas')
			{
				jQuery(this).addClass('learn');
				jQuery(".tg-post-categories > a:contains(Entrevistas Exclusivas)").addClass('entrevistas');
				
			}
	});
	
	
	jQuery("section.elementor-section.elementor-top-section").each(function() {
        var id = jQuery(this).data('id');
        if(id === '78e815e' )
			{
				jQuery(this).addClass('destaques');
				
			}
		else if(id === '9f011f6')
			{
				jQuery(this).addClass('start_ups');
			}
		else if(id === '4e29f71')
			{
				jQuery(this).addClass('empreen');
			}
		else if(id === '392a2ed')
			{
				jQuery(this).addClass('fundo_inves');
			}
		else if(id === 'a3f67e0')
			{
				jQuery(this).addClass('imbo');
			}
		else if(id === '2994a1e')
			{
				jQuery(this).addClass('invest');
			}
		else if(id === '0c6261e')
			{
				jQuery(this).addClass('e_commer');
			}
		else if(id === '1a11453')
			{
				jQuery(this).addClass('viver_port');
			}
		else if(id === '2f16c42')
			{
				jQuery(this).addClass('e_learn');
			}
		else if(id === 'd78c817')
			{
				jQuery(this).addClass('enter');
			}
		
	});
	
	var con = jQuery(".start_ups .tg-module-wrapper.tg-module-grid .tg_module_grid .tg-module-info .tg-post-categories");
	//console.log(con.length);
	
	jQuery(".start_ups .tg-module-wrapper.tg-module-grid .tg_module_grid .tg-module-info .tg-post-categories > a").each(function() {
		var cat = jQuery(this).html();
		if(cat === 'StartUp')
			{
				jQuery(this).css('display', 'inline-block');
				
			}
		else if(cat === 'Empreendedorismo')
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cat === 'E-commerce &amp; Marketing Digital')
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cat === 'Entrevistas Exclusivas')
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cat.includes("Fundos de investimento"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cat.includes("Portugal"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cat.includes("Sem categoria"))
			{
				jQuery(this).css('display', 'none');
				
			}
	});
	
	jQuery(".empreen .tg_module_block .tg-module-thumb .tg-post-categories > a").each(function() {
		var cats = jQuery(this).html();
		//console.log(cats);
		if(cats === 'Empreendedorismo')
			{
				jQuery(this).css('display', 'inline-block');
				
			}
		else if(cats === 'StartUp')
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Viver em portugal"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("E-commerce &amp; Marketing Digital"))
			{
				jQuery(this).css('display', 'none');
				
			}
	});
	
	
	jQuery(".fundo_inves .tg_module_block .tg-module-thumb .tg-post-categories > a").each(function() {
		var cats = jQuery(this).html();
		if(cats === 'Empreendedorismo')
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Fundos de investimento"))
			{
				jQuery(this).css('display', 'inline-block');
				
			}
		else if(cats.includes("E-learning"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Portugal"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Viver em portugal"))
			{
				jQuery(this).css('display', 'none');
				
			}
	});
	
	jQuery(".imbo .tg_module_block .tg-module-thumb .tg-post-categories > a").each(function() {
		var cats = jQuery(this).html();
		if(cats === 'Imobiliário')
			{
				jQuery(this).css('display', 'inline-block');
				
			}
		else if(cats.includes("Viver em portugal"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Investimentos"))
			{
				jQuery(this).css('display', 'none');
				
			}
	});
	
	jQuery(".invest .tg-module-wrapper.tg-module-grid .tg_module_grid .tg-module-info .tg-post-categories > a").each(function() {
		var cats = jQuery(this).html();
		if(cats === 'Imobiliário')
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Viver em portugal"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Portugal"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Investimentos"))
			{
				jQuery(this).css('display', 'inline-block');
				
			}
		
	});
	
	//
	jQuery(".e_commer .tg-module-wrapper.tg-module-grid .tg_module_grid .tg-module-info .tg-post-categories > a").each(function() {
		var cats = jQuery(this).html();
		if(cats.includes("E-commerce &amp; Marketing Digital"))
			{
				jQuery(this).css('display', 'inline-block');
				
			}
		else if(cats.includes("StartUp"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Viver em portugal"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Empreendedorismo"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("E-learning"))
			{
				jQuery(this).css('display', 'none');
				
			}	
	});
	
	//e_learn
	
	jQuery(".e_learn .tg_module_block .tg-module-thumb .tg-post-categories > a").each(function() {
		var cats = jQuery(this).html();
		if(cats === 'Empreendedorismo')
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("E-commerce &amp; Marketing Digital"))
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("E-learning"))
			{
				jQuery(this).css('display', 'inline-block');
				
			}	
	});
	
	
	jQuery(".enter .tg-module-wrapper.tg-module-grid .tg_module_grid .tg-module-info .tg-post-categories > a").each(function() {
		var cats = jQuery(this).html();
		if(cats === 'StartUp')
			{
				jQuery(this).css('display', 'none');
				
			}
		else if(cats.includes("Entervistas Excluivas"))
			{
				jQuery(this).css('display', 'block');
				
			}	
			
	});
	
	
	jQuery(".buddypress-wrap.extended-default-reg").addClass("col-md-8 col-xs-12");
	
	jQuery( ".submit > #signup_submit" ).before( "<p>Ao clicar em 'criar conta' abaixo, você concorda em permitir que a Globaldea armazene e processe as informações pessoais enviadas acima para fornecer o conteúdo solicitado.</p>" );
	
	
	
	
	
		
</script>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
