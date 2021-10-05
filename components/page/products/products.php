<html>

<head>
    <title>Pagination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php include_once 'data.php'; ?>
    <div class="alert alert-primary" role="alert">
        สินค้าทั้งหมด
    </div>
    <div class="container mt-5">
        <div class="row">
            <?php
            foreach ($result as $data) {

                echo '<div class="col-md-4">
                        <div class="card">
                            <div class="text-center">
                                <br />
                                <img src="./upload/' . $data['imgUrl'] . '"width="200px" height="200px">
                            </div>';
                echo '       <div class="text-center">
                                <br />
                                <h4>' . $data['name'] . '</h4>
                            </div>';
                echo '      <div class="text-center">
                                <span class="text-success">
                                    <h5>ราคา' . $data['price'] . 'บาท</h5>
                                </span>';
                echo '          <h6>วันที่โพสต์:' . $data['regdate'] . '</h6>';
                echo '          <a href="product.php?product_id=' . $data['id_products'] . '" class="btn btn-primary">ดูรายละเอียดเพิ่มเติม</a> 
                            </div>
                            <br />
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
    <br />

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <nav aria-label="Page navigation ">

                    <ul class="pagination">
                        <?php
                        if ($page_counter == 0) {
                            echo "<li class='page-item'><a class='page-link' href=?start='1' class='active'>0</a></li>";
                            for ($j = 1; $j < $paginations; $j++) {
                                echo "<li class='page-item'><a class='page-link' href=?start=$j>" . $j . "</a></li>";
                            }
                        } else {
                            echo "<li class='page-item'><a class='page-link' href=?start=$previous>Previous</a></li>";
                            for ($j = 0; $j < $paginations; $j++) {
                                if ($j == $page_counter) {
                                    echo "<li class='page-item'><a class='page-link' href=?start=$j class='active'>" . $j . "</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href=?start=$j>" . $j . "</a></li>";
                                }
                            }
                            if ($j != $page_counter + 1)
                                echo "<li class='page-item'><a href=?start=$next>Next</a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>






</body>

</html>