<?php
include('conection.php');
include('header.php');

$sql = "  SELECT * FROM news
join categories on categories.category_id=news.category_id
   order by news.views limit 20";
$result = $conn->query($sql);

$sql2 = "  SELECT * FROM news
join categories on categories.category_id=news.category_id
order by news.views desc limit 5";
$result2 = $conn->query($sql2);

$sql3 = "  SELECT * FROM news
join categories on categories.category_id=news.category_id
order by news.views desc limit 1";
$result3 = $conn->query($sql3);
?>

<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <?php
                        if ($result3->num_rows > 0) {
                            while ($row = $result3->fetch_assoc()) {
                        ?>
                                <div class="trending-top mb-30" style="margin-top: 10px;">
                                    <div class="trend-top-img">
                                        <img src="assets/img/<?= $row['news_image'] ?>" alt="">
                                        <div class="trend-top-cap">
                                            <span><?= $row['category_name'] ?></span>
                                            <h2 class="mr-20" style="font-size:26px;">
                                                <a href="details.php"><?= $row['news_title'] ?></a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">

                                <?php
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <div class="col-lg-4">
                                            <div class="single-bottom mb-35">
                                                <div class="trend-bottom-img mb-30">
                                                    <img src="<?= 'assets/img/' . $row['news_image'] ?>" alt="">
                                                </div>
                                                <div class="trend-bottom-cap">
                                                    <span class="color3"><?= $row['category_name'] ?></span>
                                                    <h4><a href="details.php?id=<?= $row['news_id'] ?>">
                                                            <?= $row['news_title'] ?></a></h4>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">
                        <?php
                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                        ?>
                                <div class="trand-right-single row " style="margin-top: 30px;">
                                    <div class="trand-right-img col-md-4">
                                        <img class="img-fluid" src="<?= 'assets/img/' . $row['news_image'] ?>" alt="">
                                    </div>
                                    <div class="trand-right-cap col-md-8">
                                        <h4><a href="details.php?id=<?= $row['news_id'] ?>">
                                                <?= $row['news_title'] ?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>

                        <?php }
                        } ?>

                        <div class="row">

                            <div class="col-lg-4">



                                <!-- New Poster -->
                                <div class="news-poster d-none d-lg-block">
                                    <img src="assets/img/news/news_card.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



</main>

<?php include('footer.php'); ?>