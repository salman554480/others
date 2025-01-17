<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 4 Offline Example</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/cbffea6533.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Offcanvas navbar</a>
        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-truncate" href="#">Switch account</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Settings</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 text-nowrap">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <main role="main" class="container">
        <div class="row mt-4">
            <div class="col-md-2 sidebar mb-3">
                <div class="label">2025</div>
                <ul>
                    <li class="month-item active">January</li>
                    <li class="month-item">February</li>
                    <li class="month-item">March</li>
                    <li class="month-item">April</li>
                    <li class="month-item">May</li>
                    <li class="month-item">June</li>
                    <li class="month-item">July</li>
                    <li class="month-item">August</li>
                    <li class="month-item">September</li>
                    <li class="month-item">October</li>
                    <li class="month-item">November</li>
                    <li class="month-item">December</li>
                </ul>
            </div>
            <div class="col-md-8 mb-3 px-4">
                <div class="main-card p-2">

                    <!-- Horizontal scroll container for dates -->
                    <div class="date-scroll-container mb-4 ">
                        <!-- Create a date item for each day (1-30) -->
                        <div class="date-item active">1</div>
                        <div class="date-item">2</div>
                        <div class="date-item">3</div>
                        <div class="date-item">4</div>
                        <div class="date-item">5</div>
                        <div class="date-item">6</div>
                        <div class="date-item">7</div>
                        <div class="date-item">8</div>
                        <div class="date-item">9</div>
                        <div class="date-item">10</div>
                        <div class="date-item">11</div>
                        <div class="date-item">12</div>
                        <div class="date-item">13</div>
                        <div class="date-item">14</div>
                        <div class="date-item">15</div>
                        <div class="date-item">16</div>
                        <div class="date-item">17</div>
                        <div class="date-item">18</div>
                        <div class="date-item">19</div>
                        <div class="date-item">20</div>
                        <div class="date-item">21</div>
                        <div class="date-item">22</div>
                        <div class="date-item">23</div>
                        <div class="date-item">24</div>
                        <div class="date-item">25</div>
                        <div class="date-item">26</div>
                        <div class="date-item">27</div>
                        <div class="date-item">28</div>
                        <div class="date-item">29</div>
                        <div class="date-item">30</div>
                    </div>
                    <h5>January 17, 2025</h5>
                    <br>
                    <?php
                    $i = 1;
                    while ($i < 3) {
                    ?>
                    <div class="row bg-white p-3 bg-white mb-3">

                        <div class="col-md-12">
                            <div class="d-flex justify-content-between">
                                <h4>Event Title</h4>
                                <div class="">
                                    <i class="fa fa-microphone text-muted"></i>
                                    <i class="fa fa-pencil text-muted mx-2"></i>
                                    <i class="fa fa-trash text-muted mx-2"></i>
                                    <i class="fa fa-share text-muted "></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted mood-text">Mood: Happy</span>
                                <span class="text-muted mood-text">1:28 PM</span>
                            </div>


                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-wrap">
                                    <span class="badge badge-silver-grey">#Visit to Islamabad</span>
                                    <span class="badge badge-silver-grey">#Happy</span>
                                    <span class="badge badge-silver-grey">#travelling</span>
                                    <span class="badge badge-silver-grey">#work</span>
                                    <span class="badge badge-silver-grey">#adventure</span>
                                    <span class="badge badge-silver-grey">#dinner</span>
                                </div>
                            </div>
                            <div class="text-area">
                                <p>Lorem ipsum dolor sit amet. Et commodi doloreUt quidem et odit libero et iste
                                    incidunt. Ab consectetur voluptate est iste internossit voluptas. Et assumenda
                                    molestiae <strong>Ut officiis qui pariatur impedit et expedita rerum</strong> a
                                    ipsum distinctio. Sit rerum porroEt odit est omnis dolorem ut vero totam sit
                                    nesciunt culpa non beatae iste et galisum sint. </p>
                                <ol>
                                    <li>Ut accusantium laboriosam aut enim iusto aut quam deserunt est voluptas vitae.
                                    </li>
                                    <li>Non omnis consequatur a quaerat suscipit hic porro dicta et fuga voluptatum.
                                    </li>
                                    <li>Hic iusto perspiciatis aut culpa eveniet. </li>
                                    <li>Cum enim voluptas cum voluptas neque. </li>
                                    <li>Eum voluptatibus galisum sit dolore galisum aut voluptas earum. </li>
                                    <li>Non excepturi consequatur est tenetur laboriosam et omnis quod et sint dicta.
                                    </li>
                                </ol>
                                <blockquote cite="https://www.loremipzum.com">Vel atque ipsum est pariatur velit vel
                                    quisquam eaque sed asperiores quae et praesentium dignissimos ex rerum culpa.
                                </blockquote>
                                <pre><code>&lt;!-- Sed consequatur enim non illum commodi. --&gt;<br>&lt;ut&gt;Est provident praesentium et saepe corporis et nostrum ipsam.&lt;/ut&gt;<br>&lt;voluptas&gt;Cum velit dolorem qui inventore sint.&lt;/voluptas&gt;<br>&lt;ut&gt;Aut architecto aliquam.&lt;/ut&gt;<br>&lt;iusto&gt;Aut enim odit.&lt;/iusto&gt;<br></code></pre>
                                <h2>Rem asperiores iusto aut Quis velit? </h2>
                                <p>Id dolores voluptasut quam quo blanditiis omnis. Est ratione repellendusQui amet qui
                                    nostrum quisquam qui vitae dicta qui quae error. Cum eveniet tenetur eos ducimus
                                    similique <a href="https://www.loremipzum.com" target="_blank">Ab voluptas et quis
                                        fugit</a> quo nihil molestiae id itaque nulla est laudantium modi. </p>
                                <h3>Qui maxime reiciendis non quos illum. </h3>
                                <p>Et saepe fugiat <strong>Ut unde et atque aliquid eum quia voluptas</strong> sed
                                    delectus deleniti ut quos nostrum. Sed culpa voluptate <em>Aut voluptates</em> aut
                                    internos architecto. Eum nulla nemo <a href="https://www.loremipzum.com"
                                        target="_blank">Est rerum sed iure commodi sed quos omnis aut ratione
                                        repellat</a> sed iste enim et iure repellendus? </p>
                                <dl>
                                    <dt><dfn>Qui architecto esse. </dfn></dt>
                                    <dd>Hic explicabo exercitationem id alias aspernatur et perferendis fuga? </dd>
                                    <dt><dfn>Sit galisum voluptas qui natus dolores. </dfn></dt>
                                    <dd>Et rerum quod in pariatur iusto. </dd>
                                    <dt><dfn>Non voluptatem sapiente quo consequatur doloremque. </dfn></dt>
                                    <dd>Et praesentium incidunt aut quos amet qui magnam accusantium. </dd>
                                    <dt><dfn>Et consequatur provident aut aliquam odio. </dfn></dt>
                                    <dd>Id internos error At quisquam doloremque aut repellendus odit. </dd>
                                </dl>
                                <h4>Vel assumenda dolorem ut dolorem facilis in iure accusamus. </h4>
                                <p>Et corrupti alias et eveniet laboriosam <strong>Non enim</strong>. Est quia omnis
                                    <em>Quo commodi et fuga earum sed modi quas</em> qui recusandae labore eum quae
                                    dolore 33 veritatis quae.
                                </p>
                                <ul>
                                    <li>Et quia accusantium quo molestiae debitis aut asperiores maiores sit voluptas
                                        corporis. </li>
                                    <li>Est tempore nisi qui quam voluptatem ut voluptas molestiae et ipsum voluptas.
                                    </li>
                                </ul>

                            </div>


                        </div>
                    </div>
                    <!--Row Ending-->
                    <?php
                        $i++;
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-2 sidebar">
                <h5>On this Day</h5>
                <hr>
                <h6>Recordings</h6>
                <div class="audio-player-container">
                    <audio controls>
                        <source src="your-audio-file.mp3" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <div class="audio-player-container">
                    <audio controls>
                        <source src="your-audio-file.mp3" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <div class="audio-player-container">
                    <audio controls>
                        <source src="your-audio-file.mp3" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                </div>

                <hr>
                <h6>Events</h6>

                <div class="quote-container mb-2">
                    <blockquote>
                        "The only limit to our realization of tomorrow is our doubts of today."
                    </blockquote>
                </div>
                <div class="quote-container mb-2">
                    <blockquote>
                        "The only limit to our realization of tomorrow is our doubts of today."
                    </blockquote>
                </div>
                <div class="quote-container mb-2">
                    <blockquote>
                        "The only limit to our realization of tomorrow is our doubts of today."
                    </blockquote>
                </div>
                <div class="quote-container mb-2">
                    <blockquote>
                        "The only limit to our realization of tomorrow is our doubts of today."
                    </blockquote>
                </div>

                <hr>
                <h6>Images</h6>

                <div class="row">
                    <?php
                    $g = 1;
                    while ($g < 10) {
                    ?>
                    <div class="col-4 col-md-4 mb-1 p-1">
                        <img src="https://picsum.photos/200/00?random=<?php echo $g; ?>" class="gallery-img" alt="">
                    </div>
                    <?php
                        $g++;
                    }
                    ?>
                </div>

            </div>
        </div>
    </main>



    <!-- Link to Bootstrap JS (with Popper.js) -->
    <script src="assets/bootstrap/jquery-3.7.1.min.js"></script>
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <script src="assets/bootstrap/popper.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <script src="assets/js/script.js"></script>
</body>

</html>