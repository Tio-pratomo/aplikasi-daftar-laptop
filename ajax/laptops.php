<?php
require_once "../modules-function/query-all-product.php";


// fitur pagination
$totalDataPerPage = 5;
$activePage = (isset($_GET["page"])) ? $_GET["page"] : 1;
$dataStart = $totalDataPerPage * $activePage - $totalDataPerPage;
$totalData = is_string(displayAllLaptops("SELECT * FROM laptops WHERE nama LIKE '%{$_GET['keyword']}%'")) ? 0 : count(displayAllLaptops("SELECT * FROM laptops WHERE nama LIKE '%{$_GET['keyword']}%'"));

$totalPage = ceil($totalData / $totalDataPerPage);

$laptops = displayAllLaptops("SELECT * FROM laptops WHERE nama LIKE '%{$_GET['keyword']}%' LIMIT $dataStart, $totalDataPerPage");
?>

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