<?php

App::pageAuth([App::ROLE_GUEST]);

if (isset($_POST['email'])) {

    $user = User::login($_POST);

    if ($user) {
        App::redirect('home');
    }
}
?>
<div class="container">

    <div class="blockContainer">

        <div class="block w4">
            <h1>
                LOGIN
            </h1>

            <?= User::loginForm(); ?>

        </div>
    </div>
</div>
