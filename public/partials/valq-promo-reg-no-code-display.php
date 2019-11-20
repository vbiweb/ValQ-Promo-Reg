<?php

/**
 * Provide a public-facing view for the plugin shortcode when promocode is not applied
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://visualbi.com
 * @since      1.0.0
 *
 * @package    Valq_Promo_Reg
 * @subpackage Valq_Promo_Reg/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="valq-promo-reg-container">
	<form id="valq-promo-reg-form-no-code" method="GET" action="/power-platform-world-tour/">
		<p class="clearfix">
			<i class="fa fa-tag" aria-hidden="true"></i>
			<input id="valq-promo-reg_promo_code" name="promo-code" class="valq-promo-reg-fields code" placeholder="Promo Code *" value="<?php echo $_GET[ 'promo-code' ]; ?>" required="" aria-required="true" type="text">
			<?php if( $wrong_promo ) : ?>
				<label id="valq-promo-reg_promo_code-error" class="error" for="valq-promo-reg_promo_code">Wrong Promo code entered</label>
			<?php endif; ?>
		</p>
		<p class="clearfix">
			<input id="valq-promo-code_submit" class="valq-promo-code_submit" value="ENTER CODE" type="submit">
		</p>
	</form>
</div>