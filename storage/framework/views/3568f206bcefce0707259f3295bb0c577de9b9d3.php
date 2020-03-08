<footer class="site-footer">
    <div class="footer-top">
        <div class="footer-section row">
            <section class="col-3">
                <h5>OUR COMPANY</h5>
                <ul  class="footer-ul">
                    <?php $__currentLoopData = $footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $footer_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(url('page/'.$footer_item->page_sc_name)); ?>" class=""><?php echo e($footer_item->meta_tags); ?></a>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>

            <section class="col-3">
                <h5>SERVICES</h5>
                <ul class="footer-ul">
                    <li>
                       Post&nbsp;free&nbsp;Question
                    </li>
                    <li>
                        Post&nbsp;free&nbsp;Answer
                    </li>
                    <li>
                       Post&nbsp;free&nbsp;Article
                    </li>
                    <li>
                        Post&nbsp;free&nbsp;Video
                    </li>
                </ul>
            </section>


            <section class="col-3">
                <h5>SOCIAL</h5>
                <h5 style="margin-bottom: 0; padding-bottom: 10px; border-bottom: 2px solid #658488">Connect With Us</h5>
                <ul class="social-link">
                    <li>
                        <a href="http://instagram.com/"><i class="fa fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="http://pinterest.com/"><i class="fa fa-pinterest"></i></a>
                    </li>
                    <li>
                        <a href="http://facebook.com/"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="http://twitter.com/"><i class="fa fa-twitter"></i></a>
                    </li>
                </ul>
                <h5 class="info-bottom">NEED ASSISTANCE?</h5>

                <a href="#" style="color:white; font-size: 16px;">info@tipsmate.com</a>



            </section>
            <section class="col-3 friend">
                <h5 class="center"> BE OUR FRIEND</h5>
                <input type="text" class="sub-email" placeholder="Enter your email here*">
                <button class="subscribe" type="submit">Subscribe Now</button>

                <p style="border-top: 2px solid #658488; padding-top:10px;margin-top:30px;">Copyright ©2020 Gopiko. All rights reserved. </p>

            </section>
        </div>
    </div>

</footer>

<?php /**PATH F:\laravel\tipsmate\resources\views/layouts/footer.blade.php ENDPATH**/ ?>