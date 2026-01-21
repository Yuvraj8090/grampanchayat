<?php 
  include 'header.php';
?>
</header>
<!--=====================
          Content
======================-->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="grid_12">
        <h3>Contacts</h3>
        <div class="map">
          <figure class="">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d24214.807650104907!2d-73.94846048422478!3d40.65521573400813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1395650655094" style="border:0"></iframe>
          </figure>
        </div>
      </div>
      <div class="grid_5">
        <h3 class="head__1">Address:</h3>
        <address class="text3">
          Address Here
        </address>
      </div>
      <div class="grid_4">
        <h3 class="head__1">Phone:</h3>
        <div class="text3">
          +91-9876543210 <br>+91-7896543210
        </div>
      </div>
      <div class="grid_3">
        <h3 class="head__1">E-mail:</h3>
        <div class="text3">
          <a href="mailto:example@email.com">example@email.com</a>
        </div>
      </div>
      <div class="grid_12">
              <form id="contact-form">
                  <div class="contact-form-loader"></div>
                  <fieldset>
                    <label class="name">
                      <input type="text" name="name" placeholder="Name:" required="" />
                     
                    </label>
                   
                    <label class="email">
                      <input type="text" name="email" placeholder="E-mail:" required="" />
                      
                    </label>
                    <label class="phone">
                      <input type="text" name="phone" placeholder="Phone:" required="" />
                    
                    </label>
                   
                    <label class="message">
                      <textarea name="message" placeholder="Message:" required=""></textarea>
                      
                    </label>
                    <div class="clear"></div>
                    <div>
                      <a href="#" class="btn" data-type="submit">Send e-mail</a>
                    </div>
                  </fieldset> 
                </form>   
      </div>
    </div>
  </div>
</section>
<?php 
  include 'footer.php';
?>