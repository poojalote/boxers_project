  <?php $this->load->view('boxing/boxing_header.php'); ?>
 
  <!-- ======= Contact Section ======= -->
    <section id="contact" class="section-bg" style="background: url(<?php echo base_url();?>assets/boxing/img/slide/slide-1.jpg);background-size: cover;">
        <section id="" >
          <div class="container" data-aos="fade-up">
            <div class="row">
              <div class="col-lg-12 pt-4 text-center">
                <h2 style="color: white;font-weight: bold;font-size: 40px;">Contact Us</h2>
                
              </div>
              
             
            </div>
          </div>
        </section><!-- End About Section -->
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <p class="text-white">Contact with PCF</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3 class="text-white">Address</h3>
              <address class="text-white">A108 Adam Street, NY 535022, USA</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3 class="text-white">Phone Number</h3>
              <p><a href="tel:+155895548855" class="text-white">+1 5589 55488 55</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3 class="text-white">Email</h3>
              <p><a href="mailto:info@example.com" class="text-white">info@example.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- End Contact Section -->
      <?php $this->load->view('boxing/boxing_footer.php'); ?>