
<div class="section" id="contact-section">
    <h2>Contact</h2>
    <div class="contact-bubbles">
        <div class="contact-bubble-right" >
            <p>Questions? Comments?  Wanna Shoot the breeze?</p>
        </div>
        <div class="contact-bubble-left">
            <form action="" id='contact-form' method="POST" data-url="<?php  echo admin_url("admin-ajax.php")?>" >
                <input type="text" name="name" id="name" placeholder="Name:">
                <input type="email" name="email" id="email" placeholder="Email:">
                <textarea name="message" id="message" cols="30" rows="5" placeholder="Message:"></textarea>
                <input type="submit" value="Submit" id="submit">
            </form>
        </div>
        <div class="contact-bubble-right" id="contact-form-response"></div>
    </div>
    
</div>
    



