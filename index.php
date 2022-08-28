<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . "\\modules-function\\query-all-product.php";
require_once __DIR__ . "\\modules-function\\db-connect.php";

// fitur pagination
$totalDataPerPage = 5;
$activePage = (isset($_GET["page"])) ? $_GET["page"] : 1;
$dataStart = $totalDataPerPage * $activePage - $totalDataPerPage;

if (isset($_POST["search"])) {

    $totalData = is_string(displayAllLaptops("SELECT * FROM laptops WHERE nama LIKE '%{$_POST['keyword']}%'")) ? 0 : count(displayAllLaptops("SELECT * FROM laptops WHERE nama LIKE '%{$_POST['keyword']}%'"));

    $totalPage = ceil($totalData / $totalDataPerPage);

    $laptops = displayAllLaptops("SELECT * FROM laptops WHERE nama LIKE '%{$_POST['keyword']}%' LIMIT $dataStart, $totalDataPerPage");
} else {
    $totalData = count(displayAllLaptops("SELECT * FROM laptops"));
    $totalPage = ceil($totalData / $totalDataPerPage);

    $laptops = displayAllLaptops("SELECT * FROM laptops LIMIT $dataStart, $totalDataPerPage ");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laptop</title>

    <!-- CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-11 p-3">
                <h1>Daftar Laptop</h1>
            </div>

            <div class="col-md-1 p-3">
                <a class="btn btn-danger" href="logout.php" role="button">Logout</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 p-3">
                <div class="d-flex justify-content-between mb-3">
                    <form action="" method="POST" class="search">
                        <div class="input-group">
                            <input type="text" name="keyword" id="keyword" class="form-control form-control-sm" placeholder="masukkan keyword" required>
                            <button type="submit" value="cari" name="search" class="btn btn-secondary " aria-describedby="keyword">cari</button>
                            <button class="btn btn-warning ms-2 text-light reset-search">reset pencarian</button>
                        </div>
                    </form>

                    <a class="btn btn-primary mb-3 tambah-barang" href="src/add.php" role="button">Tambah Barang</a>
                </div>

                <div class="live-search">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr class="table-dark text-white">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Produsen</th>
                                <th>Ukuran Layar</th>
                                <th>Gambar</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $numberTable = 1 ?>
                            <?php if (is_array($laptops)) : ?>
                                <?php foreach ($laptops as $laptop) : ?>
                                    <tr>
                                        <td><?= $numberTable; ?></td>
                                        <?php foreach ($laptop as $key => $value) : ?>
                                            <?php if ($laptop["id"] === $laptop[$key]) : ?>
                                                <?php continue; ?>
                                            <?php elseif ($laptop["gambar"] === $laptop[$key]) : ?>
                                                <td><img width="100" src="./public/images/<?= $laptop[$key]; ?>" alt="<?= $laptop[$key]; ?>"></td>
                                            <?php elseif ($laptop["harga"] === $laptop[$key]) : ?>
                                                <td class="price"><?= $laptop[$key]; ?></td>
                                            <?php else : ?>
                                                <td class="text-uppercase"><?= $laptop[$key]; ?></td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <td>
                                            <form action="src/edit.php" method="post">
                                                <input type="hidden" name="laptopID" value="<?= $laptop["id"] ?>">
                                                <button type="submit" class="btn btn-primary edit">edit</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="src/delete.php" method="post">
                                                <input type="hidden" name="delete" value="<?= $laptop["id"] ?>">
                                                <button type="submit" class="btn btn-danger delete">hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $numberTable++ ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?= $laptops; ?>
                            <?php endif; ?>
                        </tbody>

                    </table>

                    <!-- pagination -->
                    <div class="row">
                        <div class="col-md-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <?php if ($activePage > 1) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $activePage - 1; ?>">Previous</a>
                                        </li>
                                    <?php else : ?>
                                        <li class="page-item">
                                            <a class="page-link disabled">Previous</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                        <?php if ($i == $activePage) : ?>
                                            <li class="page-item active" aria-current="page"><a class="page-link" href="?page=<?= $i ?>"><?= $i; ?></a></li>
                                        <?php else : ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i; ?></a></li>
                                        <?php endif; ?>
                                    <?php endfor; ?>

                                    <?php if ($activePage == $totalPage || $totalData === 0) : ?>
                                        <li class="page-item">
                                            <a class="page-link disabled">Next</a>
                                        </li>
                                    <?php else : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $activePage + 1; ?>">Next</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteRow(elements) {
            if (elements.length === 0) {
                return;
            } else {
                elements.forEach((element) => {
                    element.addEventListener('click', function(ev) {
                        ev.preventDefault()
                        Swal.fire({
                            title: 'Yakin ingin menghapus data?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ya',
                            cancelButtonText: 'batal',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.parentElement.submit()
                            }
                        })
                    })
                })
            }
        }
    </script>

    <script>
        function displayCurrencyIDR(elements = []) {
            elements.forEach((element) => {
                element.innerText = Number(element.innerText).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                })
            })
        }
    </script>

    <script>
        function liveSearch(inputUser, container) {
            inputUser.addEventListener("input", async function() {
                const urlParams = new URLSearchParams()
                urlParams.append("keyword", inputUser.value)

                const request = new Request(`ajax/laptops.php?${urlParams.toString()}`, {
                    method: "GET"
                });

                try {
                    const result = await fetch(request).then(response => response.text())
                    container.innerHTML = result;

                } catch (error) {
                    console.log(error.message)
                }

            })
        }
    </script>

    <script>
        deleteRow(document.querySelectorAll('.delete'))
        displayCurrencyIDR(document.querySelectorAll(".price"))

        // click reset submit
        document.querySelector(".reset-search").addEventListener("click", function(event) {
            event.preventDefault()
            window.location.href = "index.php"
        })

        // live-search
        liveSearch(
            document.querySelector("#keyword"),
            document.querySelector(".live-search")
        )
    </script>

</body>

</html>