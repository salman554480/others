<div class="container-fluid text-center">
    <div class="row">
        <!-- Creator 1 -->
        <?php
        $x = 1;
        while ($x < 7) {
        ?>
        <div class="col-md-2 mb-4">
            <div class="card">
                <img src="https://avatar.iran.liara.run/public/<?php echo $x ?>" class="card-img-top" alt="Creator 1">
                <div class="card-body">
                    <h5 class="card-title">Creator Name 1</h5>
                    <p class="card-text">5M Subscribers</p>
                </div>
            </div>
        </div>
        <?php $x++;
        } ?>
    </div>
</div>