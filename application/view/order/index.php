<div class="container">

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

    <!-- login box on left side -->
    <div class="login-box" style="width: 50%; display: block;">
        <h3>DELIVERY/BILLING ADDRESS</h3>

        <!-- register form --> <!-- registe-->
        <form method="post" action="<?php echo Config::get('URL'); ?>Order/register_address">
            <!--<div class="" style="float: left" >-->
            <!-- the user name input field uses a HTML5 pattern check -->
            Full name:<input type="text" name="username" placeholder=" Full name" require>
            Street:<input type="text" name="delivery-street" placeholder="Street" required />
            House number:<input type="text" name="delivery-housenumber" placeholder="House number" required />
            ZIP:<input type="text" name="delivery-postalcode" placeholder="ZIP" required />
            City:<input type="text" name="delivery-city" placeholder="City" required autocomplete="off" />


            <!-- show the captcha by calling the login/showCaptcha-method in the src attribute of the img tag 
            <img id="captcha" src="<?php echo Config::get('URL'); ?>register/showCaptcha" />
            <input type="text" name="captcha" placeholder="Please enter above characters" required /> -->

            <!-- quick & dirty captcha reloader -->
            <!--<a href="#" style="display: block; font-size: 11px; margin: 5px 0 15px 0; text-align: center"
               onclick="document.getElementById('captcha').src = '<?php echo Config::get('URL'); ?>register/showCaptcha?' + Math.random(); return false">Reload Captcha</a>
            -->
            <!-- </div>-->
            <!-- <div class="" style="float: right" >  -->
            <!-- <h3>Rechnungsadresse</h3>
            Name: <input type="text" name="username" placeholder="username" require>
            Straße: <input type="text"  name="billing-street" placeholder="Straße" required />
            Hausnummer:<input type="text" name="billing-housenumber" placeholder="Hausnummer" required />
            PLZ:<input type="text" name="billing-postalcode" placeholder="PLZ" required />
            Ort:<input type="text" name="billing-city"  placeholder="Stadt" required autocomplete="off" />  -->

            <h3>Payment</h3>

            <label for="cars">Pay with:</label>
            <br>
                <select name="payment-option" id="payment-option" required>
                <option  value="" selected> select ... </option>
            <?php
                    foreach ($this->paymentTypes as $key => $value) {
                    echo "<option  value ='".$value->id."'>".$value->name."</option>";
                    
                    }
            ?>
                </select><br><br>
            <br>
            <br>
            <input type="submit" value="Next" name="to-payment" />
        </form>
    </div>
</div>
<div class="container">
    <p style="display: block; font-size: 11px; color: #999;">
    </p>
</div>

