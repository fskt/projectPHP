<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/favicon-32x32.png" sizes="32x32">

    <title>Altair Admin v2.6.0 - Login Page</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url()?>bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/login_page.min.css" />

</head>
<body class="login_page">
	
    <div class="login_page_wrapper">
        <?php echo $message?>
		<div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="register_form">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_a uk-margin-medium-bottom">Create an account</h2>
                <form method="post" action="<?php echo base_url()?>signup.html">
                    <div class="uk-form-row">
                        <label for="register_username">Name</label>
                        <input class="md-input" type="text" id="register_username" name="register_username" required />
                    </div>
                    <div class="uk-form-row">
                        <label for="register_password">Password</label>
                        <input class="md-input" type="password" id="register_password" name="register_password" required />
                    </div>
                    <div class="uk-form-row">
                        <label for="register_password">Company</label>
                        <input class="md-input" type="text" id="register_company" name="register_company" required />
                    </div>
					<div class="uk-form-row">
                        <label for="register_email">E-mail</label>
                        <input class="md-input" type="email" id="register_email" name="register_email" required />
                    </div>
                    <div class="uk-margin-medium-top">
                        <input type="submit" name="submit" class="md-btn md-btn-primary md-btn-block md-btn-large" value="Sign Up">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- common functions -->
    <script src="<?php echo base_url()?>assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="<?php echo base_url()?>assets/js/uikit_custom.min.js"></script>
    <!-- altair core functions -->
    <script src="<?php echo base_url()?>assets/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="<?php echo base_url()?>assets/js/pages/login.min.js"></script>

</body>
</html>