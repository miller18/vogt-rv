<?php
/**
 * Demonstrates the Direct Post Method.
 *
 * To implement the Direct Post Method you need to implement 3 steps:
 *
 * Step 1: Add necessary hidden fields to your checkout form and make your form is set to post to AuthorizeNet.
 *
 * Step 2: Receive a response from AuthorizeNet, do your business logic, and return
 *         a relay response snippet with a url to redirect the customer to.
 *
 * Step 3: Show a receipt page to your customer.
 *
 * This class is more for demonstration purposes than actual production use.
 *
 *
 * @package    AuthorizeNet
 * @subpackage AuthorizeNetDPM
 */

/**
 * A class that demonstrates the DPM method.
 *
 * @package    AuthorizeNet
 * @subpackage AuthorizeNetDPM
 */
class AuthorizeNetDPM extends AuthorizeNetSIM_Form
{

    const LIVE_URL = 'https://secure.authorize.net/gateway/transact.dll';
    const SANDBOX_URL = 'https://test.authorize.net/gateway/transact.dll';

    /**
     * Implements all 3 steps of the Direct Post Method for demonstration
     * purposes.
     */
    public static function directPostDemo($url, $api_login_id, $transaction_key, $amount = "0.00", $md5_setting = "")
    {
        
        // Step 1: Show checkout form to customer.
        if (!count($_POST) && !count($_GET))
        {
            $fp_sequence = time(); // Any sequential number like an invoice number.
            echo AuthorizeNetDPM::getCreditCardForm($amount, $fp_sequence, $url, $api_login_id, $transaction_key);
        }
        // Step 2: Handle AuthorizeNet Transaction Result & return snippet.
        elseif (count($_POST)) 
        {
            $response = new AuthorizeNetSIM($api_login_id, $md5_setting);
            if ($response->isAuthorizeNet()) 
            {
                if ($response->approved) 
                {
                    // Do your processing here.
                    $redirect_url = $url . '?response_code=1&transaction_id=' . $response->transaction_id; 
                }
                else
                {
                    // Redirect to error page.
                    $redirect_url = $url . '?response_code='.$response->response_code . '&response_reason_text=' . $response->response_reason_text;
                }
                // Send the Javascript back to AuthorizeNet, which will redirect user back to your site.
                echo AuthorizeNetDPM::getRelayResponseSnippet($redirect_url);
            }
            else
            {
                echo "Error -- not AuthorizeNet. Check your MD5 Setting.";
            }
        }
        // Step 3: Show receipt page to customer.
        elseif (!count($_POST) && count($_GET))
        {
            if ($_GET['response_code'] == 1)
            {
                echo "Thank you for your purchase! Transaction id: " . htmlentities($_GET['transaction_id']);
            }
            else
            {
              echo "Sorry, an error occurred: " . htmlentities($_GET['response_reason_text']);
            }
        }
    }
    
    /**
     * A snippet to send to AuthorizeNet to redirect the user back to the
     * merchant's server. Use this on your relay response page.
     *
     * @param string $redirect_url Where to redirect the user.
     *
     * @return string
     */
    public static function getRelayResponseSnippet($redirect_url)
    {
        return "<html><head><script language=\"javascript\">
                <!--
                window.location=\"{$redirect_url}\";
                //-->
                </script>
                </head><body><noscript><meta http-equiv=\"refresh\" content=\"1;url={$redirect_url}\"></noscript></body></html>";
    }
    
    /**
     * Generate a sample form for use in a demo Direct Post implementation.
     *
     * @param string $amount                   Amount of the transaction.
     * @param string $fp_sequence              Sequential number(ie. Invoice #)
     * @param string $relay_response_url       The Relay Response URL
     * @param string $api_login_id             Your API Login ID
     * @param string $transaction_key          Your API Tran Key.
     * @param bool   $test_mode                Use the sandbox?
     * @param bool   $prefill                  Prefill sample values(for test purposes).
     *
     * @return string
     */
    public static function getCreditCardForm($amount, $charge_reason, $stock_num, $email, $fp_sequence, $relay_response_url, $api_login_id, $transaction_key, $test_mode = false, $prefill = true)
    {
        $time = time();
        $fp = self::getFingerprint($api_login_id, $transaction_key, $amount, $fp_sequence, $time);
        $sim = new AuthorizeNetSIM_Form(
            array(
            'x_amount'        => $amount,
            'x_fp_sequence'   => $fp_sequence,
            'x_fp_hash'       => $fp,
            'x_fp_timestamp'  => $time,
            'x_relay_response'=> "TRUE",
            'x_relay_url'     => $relay_response_url,
            'x_login'         => $api_login_id,
	     'x_email_customer'        => "TRUE",
	     'x_description'   => $stock_num, 
	     'x_duplicate_window'   => "30",



            )
        );
        $hidden_fields = $sim->getHiddenFieldString();
        $post_url = ($test_mode ? self::SANDBOX_URL : self::LIVE_URL);
        
        $form = '
        
        <form class="credit-application" method="post" action="'.$post_url.'">
                '.$hidden_fields.'
                
                <div class="row">
                
                	<div class="six columns">
	            		<ul>
	            			<li>
	            				<h4>Transaction Information</h4>
            				</li>
	             			<li>
								<div class="field one-half">
									<input class=" text input" type="text" name="x_first_name" id="x_first_name" placeholder="First  Name" required></input>
								</div>
								<div class="field one-half">
									<input class=" text input" type="text" name="x_last_name" id="x_last_name" placeholder="Last  Name" required></input>
								</div>
							</li>
							<li>
								<div class="field one-half">
									<input class=" text input" type="email" name="x_email" id="x_email" placeholder="Email Address" required></input>
								</div>
								<div class="field one-half">
									<input class=" text input" type="phone" name="x_phone" id="x_phone" placeholder="Phone Number" required></input>
								</div>
							</li>
							<li class="field">
								<input class=" text input" type="text" name="x_address" id="x_address" placeholder="Street Address" required></input>
							</li>
							<li>
								<div class="field one-half">
									<input class=" text input" type="text" name="x_city" id="x_city" placeholder="CIty" required></input>
								</div>
								<div class="field one-fourth">
									<div class="picker">
										<select id="x_state" name="x_state" required>
											<option value="#" disabled selected>State</option>
											<option value="">-- UNITED STATES --</option>
											<option value="AL">Alabama</option>
											<option value="AK">Alaska</option>
											<option value="AZ">Arizona</option>
											<option value="AR">Arkansas</option>
											<option value="CA">California</option>
											<option value="CO">Colorado</option>
											<option value="CT">Connecticut</option>
											<option value="DE">Delaware</option>
											<option value="FL">Florida</option>
											<option value="GA">Georgia</option>
											<option value="HI">Hawaii</option>
											<option value="ID">Idaho</option>
											<option value="IL">Illinois</option>
											<option value="IN">Indiana</option>
											<option value="IA">Iowa</option>
											<option value="KS">Kansas</option>
											<option value="KY">Kentucky</option>
											<option value="LA">Louisiana</option>
											<option value="ME">Maine</option>
											<option value="MD">Maryland</option>
											<option value="MA">Massachusetts</option>
											<option value="MI">Michigan</option>
											<option value="MN">Minnesota</option>
											<option value="MS">Mississippi</option>
											<option value="MO">Missouri</option>
											<option value="MT">Montana</option>
											<option value="NE">Nebraska</option>
											<option value="NV">Nevada</option>
											<option value="NH">New Hampshire</option>
											<option value="NJ">New Jersey</option>
											<option value="NM">New Mexico</option>
											<option value="NY">New York</option>
											<option value="NC">North Carolina</option>
											<option value="ND">North Dakota</option>
											<option value="OH">Ohio</option>
											<option value="OK">Oklahoma</option>
											<option value="OR">Oregon</option>
											<option value="PA">Pennsylvania</option>
											<option value="RI">Rhode Island</option>
											<option value="SC">South Carolina</option>
											<option value="SD">South Dakota</option>
											<option value="TN">Tennessee</option>
											<option value="TX" selected>Texas</option>
											<option value="UT">Utah</option>
											<option value="VT">Vermont</option>
											<option value="VA">Virginia</option>
											<option value="WA">Washington</option>
											<option value="WV">West Virginia</option>
											<option value="WI">Wisconsin</option>
											<option value="WY">Wyoming</option>
											<option value="">-- CANADA --</option>
											<option value="AB">Alberta</option>
											<option value="BC">British Columbia</option>
											<option value="MB">Manitoba</option>
											<option value="NB">New Brunswick</option>
											<option value="NF">Newfoundland and Labrador</option>
											<option value="NT">Northwest Territories</option>
											<option value="NS">Nova Scotia</option>
											<option value="NU">Nunavut</option>
											<option value="ON">Ontario</option>
											<option value="PE">Prince Edward Island</option>
											<option value="PQ">Quebec</option>
											<option value="SK">Saskatchewan</option>
											<option value="YT">Yukon Territory</option>											
										</select>
									</div>
								</div>
								<div class="field one-fourth">
									<input class=" text input" type="text" name="x_zip" id="x_zip" placeholder="Zip Code" required></input>
								</div>
							</li>
							<li>
								<div class="field one-half">
									<div class="picker">
										<select id="x_country" name="x_country" required>
											<option value="#" disabled selected>Country</option>
											<option value="US" >United States</option>
											<option value="CA">Canada</option>
										</select>
									</div>
								</div>
								<div class="field one-half">
									<div class="picker">
										<select id="x_invoice_num" name="x_invoice_num" required>
											<option value="#" disabled selected>Salesman Name</option>
											<option value="00">None</option>
											<option value="9">Anderson, David</option>
											<option value="3">Cannon, Colby</option>
											<option value="15">Frausto, Lupe</option>
											<option value="2">Harrell, Race</option>
											<option value="13">McKamie, Brant</option>
											<option value="12">Miller, Anthony</option>
											<option value="6">Moore, Dennis</option>
											<option value="11">Nassiff, Justin</option>
											<option value="5">Neves, JJ</option>
											<option value="8">Robertson, Greg</option>
											<option value="10">Russell, Roland</option>
											<option value="1">Vogt, Aaron</option>
										</select>
									</div>
								</div>
							</li>
							<li class="field">
								<input class=" text input" type="text" name="x_card_num" id="x_card_num" placeholder="Credit Card Number" required></input>
							</li>
							<li>
								<div class="field one-third">
									<input class=" text input" type="text" name="x_exp_date" id="x_exp_date" placeholder="Exp. (MM/YY)" required></input>
								</div>
								<div class="field one-third">
									<input class=" text input" type="text" name="x_card_code" id="x_card_code" placeholder="CCV" required></input>
								</div>
								<div class="field one-third">
									<input class=" input" type="number" name="x_amount" value="'.$_GET['charge_amount'].'" disabled></input>
								</div>
							</li>';

							if ($_GET['refundable'] == 'no') {

							$form .= '<li class="field">
								<label class="checkbox checked" for="x_disclaimer">
									<input name="x_disclaimer" id="x_disclaimer" value="1" type="checkbox" checked="checked" required>
									<span></span> I understand that I am agreeing to purchase this Pre-Owned unit by placing a ' .$_GET['charge_amount'].' deposit.  If I submit a credit application with Vogt RV, and I am unable to qualify for financing through Vogt RV, my deposit of '.$_GET['charge_amount'].' will be refunded in full without penalty.  Otherwise, my deposit is NON-REFUNDABLE.
								</label>
							</li>';

							}
							
							$form .= '<li>
								<input class="blue-btn" type="submit" value="Submit Transaction">
							</li>
						</ul>
		            </div>    	
						
					
					<div class="six columns">
						<h4>Refund Policy</h4>
						<p><strong>RV Deposits</strong><br>
						In the event of any failure by the Purchaser to perform the Purchaser\'s obligations including but not limited to, any failure to take delivery of or to pay the agreed purchase price of the ordered motor vehicle, Vogt RV shall be permitted to retain any amount previously paid by the Purchaser as liquidated damages for the Purchaser\'s default.</p>
					</div>
					<div class="six columns">						
						<h4>Privacy Policy</h4>
						<p>We collect non-public personal information about you as a consumer, customer, or former customer from the following sources:</p>
						<ul>
							<li>Information we receive from you on applications, loan documents, sales documents, or other forms.</li>
							<li>Information about your transactions with our affiliates, others, or us.</li>
							<li>Information we receive from a consumer-reporting agency.</li>
						</ul>
						<p>We do not disclose any non-public personal information about our customers or former customers to anyone, except to our affiliates and as permitted by law.</p>
						<p>We restrict access to non-public personal information about you to those employees who need to know that information to provide products or services to you.  We maintain safeguards, which restrict access to your non-public personal information. </p>
					</div>
				</div>
					
			</div>			

        </form>';
        return $form;
    }

}