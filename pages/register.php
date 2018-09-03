<?php

App::pageAuth([App::ROLE_GUEST]);

if (isset($_POST['email'])) {

    $user = User::register($_POST);

    if ($user) {
        App::redirect('home');
    }
}
?>
<div class="container">

    <div class="blockContainer">

        <div class="block w4">
            <h1>
                Register
            </h1>

            <?= User::registerForm(); ?>

        </div>
    </div>
</div>
