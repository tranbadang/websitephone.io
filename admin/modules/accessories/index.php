<?php
    require_once __DIR__. '/../../autoload/autoload.php';

    if(isset($_GET['page']))
    {
        $p = $_GET['page'];
        if($p == 0)$p=1;
    }
    else
    {
        $p = 1;
    }

    $sql = "SELECT product.*,category.name as namecate FROM product LEFT JOIN category on category.id = product.category_id where category.level = 1";
    $total = count($db->fetchsql($sql));
    $acc = $db->fetchJones('product',$sql,$total,$p,10,true);

    if(isset($acc['page']))
    {
        $sotrang = $acc['page'];
        unset($acc['page']);
    }
     if($sotrang < $p)$p = $sotrang;
?>
<?php require_once __DIR__. '/../../layouts/header.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Danh sách sản phẩm
                            <a href="add.php" class="btn btn-success">Thêm mới</a></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sản phẩm</li>
                        </ol>
                    <div class="card mb-4">
             
                        <div class="clearfix"></div>
                        <?php if(isset($_SESSION['success'])) :?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION['success'];unset($_SESSION['success']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['error'])) :?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>

                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 10%;">Stt</th>

                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 15%;">Name</th>

                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Slug</th>

                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 12%;">Danh mục</th>

                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 12%;">Thundar</th>

                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 18%;">Info</th>
                                   
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 17%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1;foreach ($acc as $item): ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['slug'] ?></td>
                                    <td><?php echo $item['namecate'] ?></td>
                                    <td>
                                        <img src="<?php echo uploads() ?>product/<?php echo $item['thundar'] ?>" width="80px" height="80px">
                                    </td>
                                    <td>
                                        <ul>
                                            <li>Giá:<?php echo $item['price'] ?></li>
                                            <li>Số lượng:<?php echo $item['number'] ?></li>
                                        </ul>
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id'] ?>"><i class="fa fa-edit"></i>Sửa</a>
                                        <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i>Xóa</a>
                                    </td>
                                </tr>
                                <?php $stt++; endforeach ?>
                            </tbody>
                        </table>
                            <nav aria-label="Page navigation">
                              <ul class="pagination pullright">
                                <li class="page-item"><a class="page-link" href="?page=<?php echo --$p ?>">Previous</a></li>

                                <?php for($i = 1;$i <= $sotrang;$i++) : ?>

                                <?php 
                                if(isset($_GET['page']))
                                {
                                    $p = $_GET['page'];
                                    if($p == 0)$p=1;
                                }
                                else
                                {
                                    $p = 1;
                                }
                                 if($sotrang < $p)$p = $sotrang;
                                 ?>
                                
                                <li class="page-item <?php echo ($i == $p) ? 'active' : '' ?>">
                                    <a class ="page-link" href="?page= <?php echo $i ; ?>"><?php echo $i; ?></a>
                                </li>

                                <?php endfor; ?>

                                <li class="page-item"><a class="page-link" href="?page=<?php echo ++$p ?>">Next</a></li>
                              </ul>
                            </nav>
                   </div>
<?php require_once __DIR__. '/../../layouts/footer.php'; ?>

