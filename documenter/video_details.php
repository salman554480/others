<?php require_once('parts/top.php'); ?>
</head>

<body>
    <?php require_once('parts/navbar.php'); ?>

    <main role="main" class="container-fluid my-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="video-container">
                    <video controls>
                        <source src="https://videos.pexels.com/video-files/4620490/4620490-uhd_2732_1440_25fps.mp4"
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <h4 class="main-title">How I Hacked 810 Million Websites | Wordpress Hacking</h4>
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="author-info mb-2">
                            <img src="https://avatar.iran.liara.run/public/<?php echo $i ?>" alt="Author Image"
                                class="author-img">
                            <div>
                                <span class="author-name">John Doe</span>

                                <div class="video-meta">
                                    <span><strong>1.2M</strong> Follwers</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7 d-flex justify-content-end">
                        <div class="btn-group" role="group" aria-label="Button group example">
                            <!-- Button 1 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-thumbs-up"></i> 38
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-thumbs-down"></i> 38
                            </button>

                            <!-- Button 1 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-share"></i> Share
                            </button>

                            <!-- Button 2 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-download"></i> Download
                            </button>

                            <!-- Button 3 -->
                            <button type="button" class="btn btn-secondary btn-sm">
                                <i class="fas fa-bookmark"></i> Save
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-2">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Magni enim aestimabat pecuniam non modo
                        non contra leges, sed etiam legibus partam. Nec enim ille respirat, ante quam emersit, et catuli
                        aeque caeci, prius quam dispexerunt, ac si ita futuri semper essent. Nec enim ignoras his istud
                        honestum non summum modo, sed etiam, ut tu vis, solum bonum videri. Duo Reges: constructio
                        interrete. Ne amores quidem sanctos a sapiente alienos esse arbitrantur. Ut in geometria, prima
                        si dederis, danda sunt omnia. Hoc mihi cum tuo fratre convenit. </p>

                    <p>Ita, quem ad modum in senatu semper est aliquis, qui interpretem postulet, sic, isti nobis cum
                        interprete audiendi sunt. Sapiens autem semper beatus est et est aliquando in dolore; Nec
                        lapathi suavitatem acupenseri Galloni Laelius anteponebat, sed suavitatem ipsam neglegebat; Non
                        minor, inquit, voluptas percipitur ex vilissimis rebus quam ex pretiosissimis. Hanc in motu
                        voluptatem -sic enim has suaves et quasi dulces voluptates appellat-interdum ita extenuat, ut M.
                        Atque ab his initiis profecti omnium virtutum et originem et progressionem persecuti sunt. Nec
                        enim, dum metuit, iustus est, et certe, si metuere destiterit, non erit; </p>

                    <p>Facile est hoc cernere in primis puerorum aetatulis. Ergo in iis adolescentibus bonam spem esse
                        dicemus et magnam indolem, quos suis commodis inservituros et quicquid ipsis expediat facturos
                        arbitrabimur? Aperiendum est igitur, quid sit voluptas; Non enim, si omnia non sequebatur,
                        idcirco non erat ortus illinc. Quo igitur, inquit, modo? Dic in quovis conventu te omnia facere,
                        ne doleas. Non enim ipsa genuit hominem, sed accepit a natura inchoatum. Ex quo illud efficitur,
                        qui bene cenent omnis libenter cenare, qui libenter, non continuo bene. Cum autem negant ea
                        quicquam ad beatam vitam pertinere, rursus naturam relinquunt. De quibus cupio scire quid
                        sentias. </p>

                    <p>Sed hoc sane concedamus. Bork Num igitur eum postea censes anxio animo aut sollicito fuisse?
                        Atqui reperies, inquit, in hoc quidem pertinacem; Idem fecisset Epicurus, si sententiam hanc,
                        quae nunc Hieronymi est, coniunxisset cum Aristippi vetere sententia. Fortasse id optimum, sed
                        ubi illud: Plus semper voluptatis? Sed quoniam et advesperascit et mihi ad villam revertendum
                        est, nunc quidem hactenus; Epicurei num desistunt de isdem, de quibus et ab Epicuro scriptum est
                        et ab antiquis, ad arbitrium suum scribere? Quodcumque in mentem incideret, et quodcumque
                        tamquam occurreret. Aliis esse maiora, illud dubium, ad id, quod summum bonum dicitis, ecquaenam
                        possit fieri accessio. Nulla profecto est, quin suam vim retineat a primo ad extremum. Nihilne
                        est in his rebus, quod dignum libero aut indignum esse ducamus? </p>




                    <!-- Comment Add Section -->
                    <div class="comment-section">
                        <h6>Add a Comment</h6>
                        <div class="comment-form">
                            <textarea class="form-control" rows="3" placeholder="Write your comment..."></textarea>
                            <button class="btn btn-primary mt-2 btn-sm">Submit Comment</button>
                        </div>
                    </div>

                    <!-- Display Comments Section -->
                    <div class="comment-section">
                        <h6>Recent Comments</h6>

                        <!-- Comment 1 -->
                        <?php
                        $x = 1;
                        while ($x < 4) {
                        ?>
                            <div class="comment">
                                <img src="https://avatar.iran.liara.run/public/<?php echo $x ?>" alt="User Avatar"
                                    class="comment-avatar">
                                <div class="comment-body">
                                    <div class="comment-author">John Doe</div>
                                    <div class="comment-text">This is a very informative video! I learned a lot about web
                                        development concepts. Keep it up!</div>
                                    <div class="comment-meta">
                                        <span class="comment-date">2 hours ago</span> •
                                        <span class="comment-reply"><i class="fas fa-reply"></i> Reply</span>
                                    </div>
                                </div>
                            </div>
                        <?php $x++;
                        } ?>

                        <!-- Add more comments as needed -->
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <h6>Recent Videos</h6>

                <div class="list-group">
                    <!-- Video 1 -->
                    <?php
                    $i = 1;
                    while ($i < 14) {
                    ?>
                        <div class="list-group-item d-flex align-items-center video-item">
                            <img src="https://picsum.photos/360/200?random=<?php echo $i; ?>" alt="Video Thumbnail"
                                class="video-thumbnail">
                            <div class="video-info">
                                <div class="video-title">How to Learn Web Development</div>
                                <div class="video-author">By John Doe</div>
                                <div class="video-views"><i class="fas fa-eye"></i> 1.5K views</div>
                                <div class="video-time"><i class="fas fa-clock"></i> 2 days ago</div>
                            </div>
                        </div>
                    <?php $i++;
                    } ?>


                    <!-- Add more videos as needed -->
                </div>
            </div>
        </div>



    </main>

    <?php require_once('parts/footer.php'); ?>
</body>

</html>