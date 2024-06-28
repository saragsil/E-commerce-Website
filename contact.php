<?php require "includes/header.php"; ?>

<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Επικοινωνήστε μαζί μας</h2>
    <!--Section description-->
    <p style="text-align: center; width: 100%; margin-left: auto; margin-right: auto; margin-bottom: 3rem; color: white;">
        Έχεται κάποια απορία; Μην διστάσετε να επικοινωνήσετε μαζί μας απευθείας. Η ομάδα μας θα σας απαντήσει εντός λίγων ωρών για να σας βοηθήσει.
    </p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Το ονομά σας</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="">Το email σας</label>
                            <input type="text" id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="">Θέμα</label>
                            <input type="text" id="subject" name="subject" class="form-control">
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="message">Το μήνυμα σας</label>
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                        </div>
                    </div>
                </div>
                <!--Grid row-->

            </form>

            <div class="text-center text-md-left mt-4">
                <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Αποστολή</a>
            </div>
            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div style="width: 25%; text-align: center; color: white;">
            <ul style="list-style-type: none; padding-left: 0; margin-bottom: 0;">
                <li style="margin-bottom: 1rem;">
                    <i class="fas fa-map-marker-alt fa-2x"></i>
                    <p style="margin: 0; color: white;">Location</p>
                </li>
                <li style="margin-bottom: 1rem;">
                    <i class="fas fa-phone fa-2x" style="margin-top: 1rem;"></i>
                    <p style="margin: 0; color: white;">Phone</p>
                </li>
                <li style="margin-bottom: 1rem;">
                    <i class="fas fa-envelope fa-2x" style="margin-top: 1rem;"></i>
                    <p style="margin: 0; color: white;">dimitrislisgaras@gmail.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>

<?php require "includes/footer.php"; ?>
