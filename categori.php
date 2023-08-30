 <?php
    include('conection.php');
    include('header.php');

    // update the active page number
    if (!isset($_GET['page'])) {
        $page_number = 1;
    } else {
        $page_number = $_GET['page'];
    }
    $limit = 5;
    // get the initial page number
    $initial_page = ($page_number - 1) * $limit;
    $total_rows = mysqli_num_rows($result);
    // get the required number of pages
    $total_pages = ceil($total_rows / $limit);

    //$page = $_GET['page'] ? $_GET['page'] * 20 : 0;

    $select_from_category = "  SELECT * FROM categories 
    join news 
    on categories.category_id=news.category_id
    where news.category_id=" . $_GET['id']
        . "  limit $initial_page  , $limit ";
    $result = $conn->query($select_from_category);
    ?>

 <main>
     <!-- Whats New Start -->
     <section class="whats-news-area pt-50 pb-20">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8">
                     <div class="row">
                         <div class="col-12">
                             <div class="tab-content" id="nav-tabContent">
                                 <!-- card one -->
                                 <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                     <div class="whats-news-caption">
                                         <div class="row">
                                             <?php if ($result->num_rows > 0) {
                                                    $i = 0;
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                     <!-- Nav Card -->
                                                     <div class="col-lg-6 col-md-6">
                                                         <div class="single-what-news mb-100">
                                                             <div class="what-img">
                                                                 <img src="<?= 'assets/img/' . $row['news_image'] ?>" alt="">
                                                             </div>
                                                             <div class="what-cap">
                                                                 <a href="details.php?id=<?= $row['news_id'] ?>"><?= $row['news_title'] ?></a>

                                                             </div>
                                                         </div>
                                                     </div>
                                             <?php }
                                                } ?>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <!-- End Nav Card -->
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         </div>
     </section>

     <!--Start pagination -->
     <div class="pagination-area pb-45 text-center">
         <div class="container">
             <div class="row">
                 <div class="col-xl-12">
                     <div class="single-wrap d-flex justify-content-center">
                         <nav aria-label="Page navigation example">
                             <ul class="pagination justify-content-start">
                                 <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                 <?php
                                    for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
                                        echo '<li class="page-item active"><a class="page-link" href = "categori.php?id=' 
                                        . $_GET['id'] . '&page=' . $page_number . '"> ' . $page_number .
                                            '</a> </li>';
                                    } ?>
                                 <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                             </ul>
                         </nav>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- End pagination  -->
 </main>


 <?php include('footer.php') ?>