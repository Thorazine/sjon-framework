<?php
//Create your menu here
?>
<nav>
    <div>
        <?php if(App::checkAuth(App::ROLE_USER)){ ?>
            <ul class="left">
                <li><a <?= App::link('home') ?>>    home      </a></li>
            </ul>
        <?php } ?>

        <ul class="right">
            <?php if(App::checkAuth(App::ROLE_GUEST)){?>
                <li><a <?= App::link('login') ?>>   login     </a></li>
                <li><a <?= App::link('register') ?>>register     </a></li>
            <?php } else { ?>
                <li><a <?= App::link('logout') ?>>  logout    </a></li>
            <?php } ?>
        </ul>
    </div>
</nav>
