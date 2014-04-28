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
	     'x_description'   => $stock_num . ' - ' . $charge_reason . ' on RV Purchase from Vogt RV',
	     'x_duplicate_window'   => "30",
	     'x_invoice_num'   => $stock_num,


            )
        );
        $hidden_fields = $sim->getHiddenFieldString();
        $post_url = ($test_mode ? self::SANDBOX_URL : self::LIVE_URL);
        
        $form = '
        <style>
        fieldset {
            overflow: auto;
            border: 0;
            margin: 0;
            padding: 0; }

        fieldset div {
            float: left; }

        fieldset.centered div {
            text-align: center; }

        label {
            color: #183b55;
            display: block;
            margin-bottom: 5px; }

        label img {
            display: block;
            margin-bottom: 5px; }

        input.text {
            border: 1px solid #bfbab4;
            margin: 0 4px 8px 0;
            padding: 6px;
            color: #1e1e1e;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: inset 0px 5px 5px #eee;
            -moz-box-shadow: inset 0px 5px 5px #eee;
            box-shadow: inset 0px 5px 5px #eee; }
        .submit {
            display: block;
            background-color: #76b2d7;
            border: 1px solid #766056;
            color: #3a2014;
            margin: 13px 0;
            padding: 8px 16px;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            border-radius: 12px;
            font-size: 14px;
            -webkit-box-shadow: inset 3px -3px 3px rgba(0,0,0,.5), inset 0 3px 3px rgba(255,255,255,.5), inset -3px 0 3px rgba(255,255,255,.75);
            -moz-box-shadow: inset 3px -3px 3px rgba(0,0,0,.5), inset 0 3px 3px rgba(255,255,255,.5), inset -3px 0 3px rgba(255,255,255,.75);
            box-shadow: inset 3px -3px 3px rgba(0,0,0,.5), inset 0 3px 3px rgba(255,255,255,.5), inset -3px 0 3px rgba(255,255,255,.75); }
        </style>
        <form method="post" action="'.$post_url.'">
                '.$hidden_fields.'
            <fieldset>
                <div>
                    <label>Credit Card Number</label>
                    <input type="text" class="text" size="20" name="x_card_num" value="'.($prefill ? '6011000000000012' : '').'" required></input>
                </div>
                <div>
                    <label>Exp. (MM/YY)</label>
                    <input type="text" class="text" size="8" name="x_exp_date" value="'.($prefill ? '04/17' : '').'" required></input>
                </div>
                <div>
                    <label>CCV</label>
                    <input type="text" class="text" size="4" name="x_card_code" value="'.($prefill ? '782' : '').'" required></input>
                </div>
		  <div>
                    <label>Amount</label>
                    <input type="number" class="text" size="10" value="'.$_GET['charge_amount'].'" disabled></input>
                </div>
            </fieldset>
	     <br><br>
            <fieldset>
                <div>
                    <label>First Name</label>
                    <input type="text" class="text" size="15" name="x_first_name" value="'.($prefill ? 'John' : '').'" required></input>
                </div>
                <div>
                    <label>Last Name</label>
                    <input type="text" class="text" size="14" name="x_last_name" value="'.($prefill ? 'Doe' : '').'" required></input>
                </div>
            </fieldset>
            <fieldset>
                <div>
                    <label>Email Address</label>
                    <input type="text" class="text" name="x_email" value="'.($prefill ? 'bmckamie@vogtrv.com' : '').'" required></input>
                </div>
            </fieldset>
            <fieldset>
                <div>
                    <label>Address</label>
                    <input type="text" class="text" size="26" name="x_address" value="'.($prefill ? '123 Main Street' : '').'" required></input>
                </div>
                <div>
                    <label>City</label>
                    <input type="text" class="text" size="15" name="x_city" value="'.($prefill ? 'Boston' : '').'" required></input>
                </div>
            </fieldset>
            <fieldset>
                <div>
                    <label>State</label>
                    <select name="x_state" size="1" required>
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
                <div>
                    <label>Zip/Post Code</label>
                    <input type="text" class="text" size="9" name="x_zip" value="'.($prefill ? '02142' : '').'" required></input>
                </div>
                <div>
                    <label>Country</label>
			<select name="x_country" size="1" required>
				<option value="US" selected>United States</option>
				<option value="CA">Canada</option>
			</select>
                </div>
            </fieldset>
	     <br><br>
            <fieldset>
                <div>
            		<input type="submit" value="Submit Transaction" class="submit buy">
                </div>
            </fieldset>

        </form>';
        return $form;
    }

}