<?php

/**
 * Provide a public-facing view for the plugin shortcode when promocode is applied
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
	<form id="valq-promo-reg-form">
		<input id="valq-promo-reg_product_id" 	name="valq-promo-reg_product_id" 	value="<?php echo $product_id; ?>" type="hidden" />
		<input id="valq-promo-reg_promo_code" 	name="valq-promo-reg_promo_code" 	value="<?php echo $promo_code; ?>" type="hidden" />				

		<input id="valq-promo-reg_hub_pagename" name="valq-promo-reg_hub_pagename" 	value="<?php echo $post->post_title; ?>" type="hidden" />
		<input id="valq-promo-reg_hub_pageurl" 	name="valq-promo-reg_hub_pageurl" 	value="<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" type="hidden" />
		<input id="valq-promo-reg_hub_utk" 		name="valq-promo-reg_hub_utk" 		value="<?php echo $_COOKIE['hubspotutk']; ?>" type="hidden" />
		<input id="valq-promo-reg_hub_ipaddr" 	name="valq-promo-reg_hub_ipaddr" 	value="<?php echo isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']; ?>" type="hidden" />
		<input id="valq-promo-reg_useragent" 	name="valq-promo-reg_useragent" 	value="<?php echo isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''; ?>" type="hidden" />

		<p class="clearfix valq-promo-reg-promocode-container">
			<div id="valq-promo-reg_promocode" class="valq-promo-reg-fields promocode">
				<i class="fa fa-tag" aria-hidden="true"></i>
				<?php echo 'CONGRATULATIONS!! PROMO CODE APPLIED: ' . $promo_code; ?>
				<div class="benefits">
					Summary of benefits:
					<ul>
						<li>15-days free trial of ValQ Enterprise edition worth $1000</li>
						<li>Exclusive 1 hour walkthrough session on building advanced models from scratch in ValQ</li>
						<li>and more...</li>
					</ul>
					Please fill out the form below to avail these benefits.
				</div>
			</div>
		</p>

		<p class="clearfix">
			<i class="fa fa-user-o" aria-hidden="true"></i>
			<input id="valq-promo-reg_fname" name="valq-promo-reg_fname" class="valq-promo-reg-fields fname" placeholder="First Name *" value="" required="" aria-required="true" type="text">
			<input id="valq-promo-reg_lname" name="valq-promo-reg_lname" class="valq-promo-reg-fields lname" placeholder="Last Name *" value="" required="" aria-required="true" type="text">
			<label id="valq-promo-reg_fname-error" class="error" for="valq-promo-reg_fname"></label>
			<label id="valq-promo-reg_lname-error" class="error" for="valq-promo-reg_lname"></label>
		</p>
		<p class="clearfix">
			<i class="fa fa-envelope-o" aria-hidden="true"></i>
			<input id="valq-promo-reg_email" name="valq-promo-reg_email" class="valq-promo-reg-fields email" placeholder="Business Email *" value="" required="" aria-required="true" type="text">
		</p>
		<p class="clearfix">
			<i class="fa fa-phone" aria-hidden="true"></i>
			<input id="valq-promo-reg_phone" name="valq-promo-reg_phone" class="valq-promo-reg-fields phone" placeholder="Phone *" value="" required="" aria-required="true" type="text">
		</p>
		<p class="clearfix">
			<i class="fa fa-building-o" aria-hidden="true"></i>
			<input id="valq-promo-reg_company" name="valq-promo-reg_company" class="valq-promo-reg-fields company" placeholder="Company *" value="" required="" aria-required="true" type="text">
		</p>
		<p class="clearfix valq-promo-reg-select-container">
			<i class="fa fa-users" aria-hidden="true"></i>
			<select id="valq-promo-reg_size" name="valq-promo-reg_size" class="valq-promo-reg-fields size" >
				<option disabled="" selected="" value="0">Select company size... *</option>
				<option value="2-10">2-10</option>
				<option value="2-10">11-50</option>
				<option value="2-10">51-200</option>
				<option value="2-10">201-500</option>
				<option value="2-10">501-1000</option>
				<option value="2-10">1001-5000</option>
				<option value="2-10">5001-10000</option>
			</select>
			<label id="valq-promo-reg_size-error" class="error" for="valq-promo-reg_size"></label>
		</p>
		<p class="clearfix valq-promo-reg-select-container">
			<i class="fa fa-industry" aria-hidden="true"></i>
			<select id="valq-promo-reg_industry" name="valq-promo-reg_industry" class="valq-promo-reg-fields industry" >
				<option disabled="" selected="" value="0">Select Industry... *</option>
				<option value="Capital Markets">Capital Markets</option>
				<option value="Defense &amp; Space">Defense &amp; Space</option>
				<option value="Education Management">Education Management</option>
				<option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
				<option value="Entertainment">Entertainment</option>
				<option value="Financial Services / Banking">Financial Services</option>
				<option value="Food &amp; Beverages">Food and Beverages</option>
				<option value="Gambling &amp; Casinos">Gambling &amp; Casinos</option>
				<option value="Government Relations">Government Relations</option>
				<option value="Wellness and Fitness">Health</option>
				<option value="Health Wellness and Fitness">Health Wellness and Fitness</option>
				<option value="Higher Education">Higher Education</option>
				<option value="Hospital &amp; Health Care">Hospital and HealthCare</option>
				<option value="Hospitality">Hospitality</option>
				<option value="Human Resources">Human Resources</option>
				<option value="Import and Export">Import and Export</option>
				<option value="Individual &amp; Family Services">Individual &amp; Family Services</option>
				<option value="Industrial Automation">Industrial Automation</option>
				<option value="Information Technology and Services">Information Technology and Services</option>
				<option value="Insurance">Insurance</option>
				<option value="Internet">Internet</option>
				<option value="Investment Banking">Investment Banking</option>
				<option value="Investment Management">Investment Management</option>
				<option value="Law Practice">Law Practice</option>
				<option value="Legislative Office">Legislative Office</option>
				<option value="Leisure, Travel &amp; Tourism">Leisure, Travel &amp; Tourism</option>
				<option value="Logistics and Supply Chain">Logistics and Supply Chain</option>
				<option value="Luxury Goods &amp; Jewelry">Luxury Goods and Jewelry</option>
				<option value="Manufacturing - Machinery">Machinery</option>
				<option value="Management Consulting">Management Consulting</option>
				<option value="Manufacturing - Medical Devices">Manufacturing - Medical Devices</option>
				<option value="Maritime">Maritime</option>
				<option value="Market Research">Market Research</option>
				<option value="Marketing and Advertising">Marketing and Advertising</option>
				<option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
				<option value="Medical Practice">Medical Practice</option>
				<option value="Mental Health Care">Mental Health Care</option>
				<option value="Mining &amp; Metals">Mining and Metals</option>
				<option value="Motion Pictures and Film">Motion Pictures and Film</option>
				<option value="Music">Music</option>
				<option value="Newspapers">Newspapers</option>
				<option value="Nonprofit Organization Management">Nonprofit Organization Management</option>
				<option value="Oil &amp; Energy">Oil and Energy</option>
				<option value="Online Media">Online Media</option>
				<option value="Package/Freight Delivery">Package/Freight Delivery</option>
				<option value="Packaging and Containers">Packaging and Containers</option>
				<option value="Paper &amp; Forest Products">Paper and Forest Products</option>
				<option value="Pharmaceuticals">Pharmaceuticals</option>
				<option value="Manufacturing - Plastics">Plastics</option>
				<option value="Political Organization">Political Organization</option>
				<option value="Primary/Secondary Education">Primary/Secondary Education</option>
				<option value="Printing">Printing</option>
				<option value="Program Development">Program Development</option>
				<option value="Public Safety">Public Safety</option>
				<option value="Publishing">Publishing</option>
				<option value="Real Estate">Real Estate</option>
				<option value="Renewables &amp; Environment">Renewables and Environment</option>
				<option value="Research">Research</option>
				<option value="Restaurants">Restaurants</option>
				<option value="Retail">Retail</option>
				<option value="Semiconductors">Semiconductors</option>
				<option value="Sporting Goods">Sporting Goods</option>
				<option value="Sports">Sports</option>
				<option value="Supermarkets">Supermarkets</option>
				<option value="Telecommunications">Telecommunications</option>
				<option value="Textiles">Textiles</option>
				<option value="Tobacco">Tobacco</option>
				<option value="Translation and Localization">Translation and Localization</option>
				<option value="Transportation/Trucking/Railroad">Transportation/Trucking/Railroad</option>
				<option value="Utilities">Utilities</option>
				<option value="Warehousing">Warehousing</option>
				<option value="Wholesale">Wholesale</option>
				<option value="Wine and Spirits">Wine and Spirits</option>
				<option value="Wireless">Wireless</option>
				<option value="Writing and Editing">Writing and Editing</option>
				<option value="Accounting">Accounting</option>
				<option value="Airlines/Aviation">Airlines/Aviation</option>
				<option value="Apparel &amp; Fashion">Apparel and Fashion</option>
				<option value="Automotive">Automotive</option>
				<option value="Aviation &amp; Aerospace">Aviation and Aerospace</option>
				<option value="Financial Industry - Banking">Financial Industry - Banking</option>
				<option value="Biotechnology">Biotechnology</option>
				<option value="Broadcast Media">Broadcast Media</option>
				<option value="Building Materials">Building Materials</option>
				<option value="Business Supplies and Equipment">Business Supplies and Equipment</option>
				<option value="Chemicals">Chemicals</option>
				<option value="Commercial Real Estate">Commercial Real Estate</option>
				<option value="Computer &amp; Network Security">Computer &amp; Network Security</option>
				<option value="Computer Games">Computer Games</option>
				<option value="Computer Hardware">Computer Hardware</option>
				<option value="Computer Networking">Computer Networking</option>
				<option value="Computer Software">Computer Software</option>
				<option value="Construction">Construction</option>
				<option value="Consumer Electronics">Consumer Electronics</option>
				<option value="Consumer Goods">Consumer Goods</option>
				<option value="Consumer Services">Consumer Services</option>
				<option value="Manufacturing - General">Manufacturing - General</option>
				<option value="Railroad Manufacture">Railroad Manufacture</option>
				<option value="E-Learning">E-Learning</option>
				<option value="International Trade and Development">International Trade and Development</option>
				<option value="Philanthropy">Philanthropy</option>
				<option value="Professional Training &amp; Coaching">Professional Training &amp; Coaching</option>
				<option value="Medical Devices">Medical Devices</option>
				<option value="Media Production">Media Production</option>
				<option value="Dairy">Dairy</option>
				<option value="Banking">Banking</option>
				<option value="Furniture">Furniture</option>
				<option value="Civil Engineering">Civil Engineering</option>
				<option value="Design">Design</option>
				<option value="cosmetics">cosmetics</option>
				<option value="No Industry Given">No Industry Given</option>
				<option value="Staffing and Recruiting">Staffing and Recruiting</option>
				<option value="Government Administration">Government Administration</option>
				<option value="Venture Capital &amp; Private Equity">Venture Capital &amp; Private Equity</option>
				<option value="Ranching">Ranching</option>
				<option value="Security and Investigations">Security and Investigations</option>
				<option value="Farming">Farming</option>
				<option value="Fishery">Fishery</option>
				<option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
				<option value="Museums and Institutions">Museums and Institutions</option>
				<option value="Judiciary">Judiciary</option>
				<option value="Architecture and Planning">Architecture &amp; Planning</option>
				<option value="Religious Institutions">Religious Institutions</option>
				<option value="Glass Ceramics &amp; Concrete">Glass Ceramics and Concrete</option>
				<option value="Environmental Services">Environmental Services</option>
				<option value="Facilities Services">Facilities Services</option>
				<option value="Shipbuilding">Shipbuilding</option>
				<option value="International Affairs">International Affairs</option>
				<option value="Individual and Family Services">Individual and Family Services</option>
				<option value="Fund-Raising">Fund-Raising</option>
				<option value="Military">Military</option>
				<option value="Think Tanks">Think Tanks</option>
				<option value="Law Enforcement">Law Enforcement</option>
				<option value="Civic &amp; Social Organization">Civic &amp; Social Organization</option>
				<option value="Events Services">Events Services</option>
				<option value="Recreational Facilities and Services">Recreational Facilities and Services</option>
			</select>
			<label id="valq-promo-reg_industry-error" class="error" for="valq-promo-reg_industry"></label>
		</p>
		<p class="clearfix valq-promo-reg-select-container">
			<i class="fa fa-globe" aria-hidden="true"></i>
			<select id="valq-promo-reg_country" name="valq-promo-reg_country" class="valq-promo-reg-fields country" >
				<option disabled="" selected="" value="0">Select country... *</option>
				<?php
					$countries_obj   = new WC_Countries();
					$countries   = $countries_obj->__get('countries');
					foreach ($countries as $country_code => $country) {
						echo '<option value="'.$country_code.'">'.$country.'</option>';
					}
				?>
			</select>
			<label id="valq-promo-reg_country-error" class="error" for="valq-promo-reg_country"></label>
		</p>
		<div class="valq-promo-reg_terms">
			<div class="terms-text" readonly="">
				<h5 class="terms-header">Terms and Conditions </h5>
				<div style="padding: 10px;background:#ffffff;">
					<p align="center"><strong>Software Evaluation /  Trial Agreement</strong></p>
					<div style="padding:15px;font-size:12px;line-height:1.7em;">
						<p>This "Software Evaluation / Trial Agreement"("this Agreement") is between ValQ LLC with principal place of business at 5920 Windhaven Pkwy. Suite 120 Plano, Texas 75023 (VALQ) and "You" (collectively, the "Parties").</p>
						<p>You agree that this Agreement is like any written negotiated agreement signed by you. By clicking to accept this Agreement, you agree to be bound by its terms and conditions.</p>
						<p>This Agreement expresses the terms and conditions on which you may use for evaluation purposes a <?php echo $trial_days ?> Day Trial version of <?php echo $product->get_title(); ?> ("the Software") that VALQ is making available to you subject to your acceptance of the terms and conditions stated herein.</p>
						<p>Please review the terms and conditions in this Agreement carefully before installing or using the Software.</p>
						<p>By downloading, installing, running or otherwise using the Software, you and/or your company (collectively, "the Evaluator") are accepting and agreeing to the terms of this Agreement. If you are not willing to be bound by this Agreement, do not download, install or use the Software.</p>
						<p>Various copyrights and other intellectual property rights apply to the Software. This Agreement is an evaluation agreement that gives you limited rights to use the software, and not an agreement for sale or for transfer of title. VALQ retains all rights not expressly granted by this Agreement.</p>
						<p>VALQ desires to provide the Software, to the Evaluator for its evaluation purposes for the <?php echo $trial_days ?>-day evaluation period from the date that the Evaluator installs the Software or such other extended period as VALQ may allow at its discretion (the "Evaluation Period"). The Evaluator desires to perform an internal evaluation of the Software for potential use in connection with Evaluator's business or its own personal needs(the "Evaluation").</p>
						<ul style="font-size:12px;line-height:1.7em;">
							<li>GRANT. Subject to the terms and conditions of this Agreement, VALQ hereby grants Evaluator a royalty free, non-exclusive, non-transferable, personal, revocable license to use the Software solely to perform the Evaluation. This Agreement does not include any rights to maintenance or updates.</li>
							<li>LIMITED RIGHTS. You may install the Software on any number of computers. You  acknowledge that the Software contains trade secrets and, in order to protect such trade secrets, You agree not to disassemble, decompile or reverse engineer the Software.</li>
							<li>TERM AND TERMINATION. This Agreement, and all rights granted to Evaluator hereunder, shall terminate (i) automatically without notice upon the expiration of the Evaluation Period, (ii) upon Evaluator's breach of any provision of this Agreement; or (iii) immediately upon VALQ providing written notice to Evaluator.

							After the Evaluation period has ended, You must purchase a license from VALQ in order for the user to have access to all the features and functionality of the Software.  For more information about purchasing a license to use the Software, please contact our Sales team. If Evaluator has not purchased a license of the Software as of the expiration of the Evaluation Period, the Software shall cease to function, and Evaluator may lose access to data made with, or stored on, the Software. Once Evaluator purchases a license of the software (â€œPurchaserâ€?) and uses the set of Activation Codes to make the Software permanent on a computer, the Evaluation period ends and the Software will be permanent on that computer.

							If Purchaser reformats the hard disk or reinstalls Windows on the computer that houses a permanent copy of the Software, the license will become lost permanently and Purchaser will have to reinstall the <?php echo $product->get_title(); ?> using the same key provided to them during purchase of the software. Details are provided in the installation guide

							If Purchaser intends to move the Software license to another computer, the Purchaser must use the instructions provided in the Installation guide to perform the activity.</li>
							<li>TITLE. Title to the Software and all proprietary rights therein shall be and remain the sole and exclusive property of VALQ.</li>
							<li>NO WARRANTY. The software is being supplied on an "as is" basis without warranty of any kind. VALQ makes no warranties regarding the software, express or implied, including but not limited to any implied warranties of merchantability, fitness for a particular purpose, or noninfringement.</li>
							<li>EXCLUSION OF DAMAGES. In no event will VALQ be liable to the Evaluator, Purchaser or any other party for damages of any kind arising from this agreement or the use of the software, whether resulting from tort (including negligence), breach of contract or other form of action, including but not limited to direct, indirect, special, incidental and consequential damages (including lost profits) of any kind, even if advised of the possibility of such damage.</li>
						</ul>
						<p><strong><center>Copyright &copy; <?php echo date("Y"); ?> ValQ LLC. All rights reserved.</center></strong></p>
					</div>
				</div>
			</div>
			<br>
		</div>
		<p class="clearfix">
			<input id="valq-promo-reg_submit" name="valq-promo-reg_submit" class="valq-promo-reg_submit" value="REGISTER NOW" type="submit">
		</p>
		<p class="disclaimer">By clicking on <b>REGISTER NOW</b> you agree to our terms and conditions and you acknowledge having read our <a href="/privacy-policy/">privacy policy</a></p>
	</form>
	<div id="valq-promo-reg_error"></div>
</div>
