<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Add Institution</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Add Institution</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Top End ***** -->

    <!-- ***** Page Content Start ***** -->
    <div class="page-bottom">
        <div class="container">
            <div class="row">
                <!-- ***** Contact Text Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h5 class="mbottom-30">Add Institution</h5>
                    <div class="contact-text">
                        <p>We are very eager to talk to you.</p>
                        <p>Talk to us on how to mould you future in your business.</p>
                    </div>
                </div>
                <!-- ***** Contact Text End ***** -->

                <!-- ***** Contact Form Start ***** -->
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <input type="text" placeholder="Institution Name">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <input type="text" placeholder="Registration No.">
                            </div>
                            <div class="col-lg-12">
                                <label for="business_type">Business Type</label>
                            <select id="business_type" name="business_type" class="form-control">          
                                <?php ?>
                            </select> 
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="date-group">Date Established/Incorporated</label>
                                    <div class="row" id="date-group">
                                        <div class="col-lg-3">
                                            <select id="day" name="day" class="form-control">          
                                                <?php include 'modules/snippets/day.php'; ?>
                                            </select> 
                                        </div>
                                        <div class="col-lg-6">
                                            <select id="month" name="month" class="form-control">          
                                                <?php include 'modules/snippets/month.php'; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select id="year" name="year" class="form-control">  
                                                <?php include 'modules/snippets/year.php'; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <input type="tel" placeholder="Office Telephone">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <input type="email" placeholder="Office Email">
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <input type="text" placeholder="Postal Number">
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <input type="text" placeholder="Postal Code">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <input type="text" placeholder="Town">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                    <label for="incorporation_certificate">Certificate of Incorporation</label>
                                    <input type="file" name="incorporation_certificate" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-primary-line">ADD INSTITUTION</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Contact Form End ***** -->
            </div>
        </div>
    </div>
    <!-- ***** Page Content End ***** -->
</section>

