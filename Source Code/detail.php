<?php
session_start();
require('db.php');
if(isset($_SESSION['user_role']) && !empty($_SESSION['user_role']) && $_SESSION['user_role'] == "ban") {
    header('location: banned.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NgodingCoy</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body style="background-color:#D9D9D9">
<nav class="navbar navbar-expand-lg" style="background-color:white">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
        <a data-aos="fade-right" data-aos-duration="1000" href="index.php" class="ms-5 navbar-brand logo"><img style="width: 190px; height: 50px;" src="img/logo.png"/></a>
        <ul class="navbar-nav me-auto my-lg-0 col-6 navScroll navbar-nav-scroll d-flex justify-content-between mx-auto" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
                <a href="index.php?kategori=all" aria-current="page" class=" nav-link nav-scroll h3 text-decoration-none mt-2 text-hover" style="color:#FFB800;font-weight:bold;">ALL</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=C" class=" nav-link text-decoration-none mt-2 text-hover"style="color:black;">C</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=PHP" class="nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">PHP</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=Python" class= " nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">Python</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=Java" class=" nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">Java</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=Javascript" class="nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">Javascript</a>
            </li>
        </ul>
        <div class="d-flex me-5">
            <div class="profile d-flex my-auto align-middle"  data-aos="fade-down" data-aos-duration="1000">
                <?php
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
                    <a data-aos="fade-right" data-aos-duration="1000" href="#" class="h2 text-gradient text-decoration-none d-block align-middle glow-on-hover" data-bs-toggle="modal" data-bs-target="#modal_create">Create</a>
                <?php
                } else { ?>
                    <a data-aos="fade-right" data-aos-duration="1000" href="login.php" class="h2 text-gradient text-decoration-none d-block align-middle glow-on-hover">Create</a>
                <?php
                }
                ?>
                <h2 class="">&nbsp;|&nbsp;</h2>
                <?php
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { 
                    $sqlprofile = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
                    $result = $db->query($sqlprofile);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                ?>
                    <a href="profile.php?id_user_profile=<?= $row['id'] ?>"><img class="align-middle rounded-circle " src="<?=$row['profile']?>" style="width: 50px;"/></a>
                    <a  href="profile.php?id_user_profile=<?= $row['id'] ?>" class="align-middle h2 text-body text-decoration-none text-gradient"><?=$row['username']?></a>
                
                <?php
                } else {
                ?>
                    <a href="login.php" class="h2 text-gradient text-decoration-none d-block align-middle glow-on-hover">Log In</a>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    </nav> 
    <?php
    $id_post = $_GET['id_post'];
    $sqlpost = "SELECT id, subject, konten, kategori, CONCAT(DAY(tanggal), ' ', MONTHNAME(tanggal), ' ', YEAR(tanggal)) AS tanggal, LEFT(jam, 5) AS jam, id_user FROM postingan WHERE id = {$id_post}";
    $resultpost = $db->query($sqlpost);
    $rowpost = $resultpost->fetch(PDO::FETCH_ASSOC);
    $id_user = $rowpost['id_user'];
    $sqluser = "SELECT * FROM user WHERE id = $id_user";
    $resultuser = $db->query($sqluser);
    $rowuser = $resultuser->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="mx-auto container mt-3 col-6 pb-3 section" data-aos="fade-up" data-aos-duration="1000" style="box-shadow:3px 3px #FFB800;border-radius:10px">
        <div class="mx-auto d-flex justify-content-between align-middle">
        <div class="d-inline-block">
                <a href="profile.php?id_user_profile=<?= $rowuser['id'] ?>"><img class="rounded-circle" src=<?=$rowuser['profile']?> style="width:60px;height:60px;" class="d-inline-block my-auto"alt=""></a>
                <div class="d-inline-block align-middle ">
                    <a href="profile.php?id_user_profile=<?= $rowuser['id'] ?>" class="fs-3 text-decoration-none" style="color:black"><?= $rowuser['username'] ?> | <?= $rowpost['kategori'] ?></a>
                    <p><?=$rowuser['pekerjaan']?></p>
                </div>
            </div>
            
            <div class="">
                <p class="mt-2"><?= $rowpost['tanggal']?> <?= $rowpost['jam']?></p>
            </div>
        </div>
        <a href="detail.php?id_post=<?= $rowpost['id'] ?>" class="text-decoration-none" style="color:black"><b><?= $rowpost['subject'] ?></b></a>
        <div class="">
            <?= $rowpost['konten'] ?>
        </div>
        <div class="d-flex justify-content-between">
            <div><br>
                <?php
                    $sqljumlahcomment = "SELECT COUNT(*) AS jumlah FROM comment WHERE id_post = {$rowpost['id']}";
                    $resultjumlahcomment = $db->query($sqljumlahcomment);
                    $rowjumlahcomment = $resultjumlahcomment->fetch(PDO::FETCH_ASSOC);

                    $sqljumlahlike = "SELECT COUNT(*) AS jumlah FROM likepost WHERE id_post = {$rowpost['id']}";
                    $resultjumlahlike = $db->query($sqljumlahlike);
                    $rowjumlahlike = $resultjumlahlike->fetch(PDO::FETCH_ASSOC);

                    if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                        $sqlusernow = "SELECT * FROM user WHERE username = ?";
                        $stmtusernow = $db->prepare($sqlusernow);
                        $stmtusernow->execute([$_SESSION['username']]);
                        $rowusernow = $stmtusernow->fetch(PDO::FETCH_ASSOC);
        
                        $sqllike = "SELECT * FROM likepost WHERE id_user = {$rowusernow['id']} AND id_post = {$rowpost['id']}";
                        $resultlike = $db->query($sqllike);
                        $rowlike = $resultlike->fetch(PDO::FETCH_ASSOC);
        
                        if($rowlike) {?>
                            <a href="delete_like_post.php?id_post=<?= $rowpost['id'] ?>" class="d-inline text-body align-middle text-decoration-none" style="font-size: 20px;"><img src="img/red_heart.png" class="align-middle img-hover" style="width:25px;height:25px" alt=""> <?= $rowjumlahlike['jumlah'] ?></a>
                        <?php
                        } else if(!$rowlike) { ?>
                            <a href="create_like_post.php?id_post=<?= $rowpost['id'] ?>" class="d-inline text-body align-middle text-decoration-none" style="font-size: 20px;"><img src="img/heart.png" alt=""  class="align-middle img-hover" style="width:25px;height:25px"> <?= $rowjumlahlike['jumlah'] ?></a>
                        <?php
                        }
                        ?>
                    <?php
                    } else { ?>
                        <a href="login.php" class="d-inline text-body text-decoration-none align-middle" style="font-size: 20px;"><img src="img/heart.png" alt=""  class="align-middle img-hover" style="width:25px;height:25px"> <?= $rowjumlahlike['jumlah'] ?></a>
                    <?php
                    }
                    ?>
                <a href="detail.php?id_post=<?= $rowpost['id'] ?>" class="d-inline align-middle text-decoration-none" style="font-size:20px;color:black"><img src="img/chat-bubble.png" alt=""  class="align-middle img-hover" style="width:25px;height:25px"> <?=$rowjumlahcomment['jumlah'] ?></a>
            </div>
            <?php if(isset($_SESSION['user_role']) && !empty($_SESSION['user_role']) && $_SESSION['user_role'] == "admin") { ?>
            <div class="py-auto">
                <a href="delete_post.php?id_post=<?= $rowpost['id']?>" class="mt-5 text-body text-decoration-none" ><img src="img/x_red.png" style="height:20px;width:20px;" alt="">Delete</a>
            </div>
            <?php } ?>
        </div>
        <br>
        <div type="text" class="align-self-end">
            <?php
            if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
                <form action="create_comment_proses.php" method="post">
            <?php
            } else { ?>
                <form action="login.php" method="post">
            <?php
            }
            ?>
                <div class="row">
                    <div class="d-flex">
                        <input required type="text" name="comment" class="form-control"placeholder="Comment">
                        <input hidden name="id_post" value=<?= $rowpost['id'] ?> />
                        <button type="submit" style="border: 0px; background-color: #FFFFFF;"><img src="img/send.png" style="width:30px; height:20px;"/></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        $sqlcomment = "SELECT id, comment, CONCAT(DAY(tanggal), ' ', MONTHNAME(tanggal), ' ', YEAR(tanggal)) AS tanggal, LEFT(jam, 5) AS jam, id_post, id_user FROM comment WHERE id_post = $id_post";
        $resultcomment = $db->query($sqlcomment);
        while($rowcomment = $resultcomment->fetch(PDO::FETCH_ASSOC)) {
            $id_user_comment = $rowcomment['id_user'];
            $sqlusercomment = "SELECT * FROM user WHERE id = $id_user_comment";
            $resultusercomment = $db->query($sqlusercomment);
            $rowusercomment = $resultusercomment->fetch(PDO::FETCH_ASSOC);
            
            ?>
            <div class="d-flex justify-content-end col-6 pb-2 mx-auto" style="margin-top:10px;">  
            <div class="section p-2 " data-aos="fade-up" data-aos-duration="1000" style="width:90%;box-shadow: 3px 3px #FFB800;border-radius:10px">    
                <div class=" d-flex justify-content-between">
                    <div class="d-inline-block">
                        <img class="rounded-circle"src=<?=$rowusercomment['profile']?> style="width:60px;height:60px;" class="d-inline-block my-auto"alt="">
                        <div class="d-inline-block align-middle ">
                            <a href="#" class="fs-3 text-decoration-none" style="color:black"><?= $rowusercomment['username'] ?></a>
                            <p><?=$rowusercomment['pekerjaan']?></p>
                        </div>
                    </div>
                    
                    <div class="">
                        <p class="mt-2"><?= $rowcomment['tanggal']?> <?= $rowcomment['jam']?></p>
                    </div>
                </div>
                <div><?= $rowcomment['comment'] ?></div>
                <div class="d-flex justify-content-between">
                    <div class="d-block">
                    <?php
                    $sqljumlahlikecomment = "SELECT COUNT(*) AS jumlah FROM likecomment WHERE id_comment = {$rowcomment['id']}";
                    $resultjumlahlikecomment = $db->query($sqljumlahlikecomment);
                    $rowjumlahlikecomment = $resultjumlahlikecomment->fetch(PDO::FETCH_ASSOC);

                    if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                        $sqlusernow = "SELECT * FROM user WHERE username = ?";
                        $stmtusernow = $db->prepare($sqlusernow);
                        $stmtusernow->execute([$_SESSION['username']]);
                        $rowusernow = $stmtusernow->fetch(PDO::FETCH_ASSOC);
        
                        $sqllike = "SELECT * FROM likecomment WHERE id_user = {$rowusernow['id']} AND id_comment = {$rowcomment['id']}";
                        $resultlike = $db->query($sqllike);
                        $rowlike = $resultlike->fetch(PDO::FETCH_ASSOC);
        
                        if($rowlike) {?>
                            <a href="delete_like_comment.php?id_comment=<?= $rowcomment['id'] ?>" class=" text-body mt-0 text-decoration-none" style="font-size: 25px;"><img class="mt-0"src="img/heart_red.png" style="width: 15px;"/><?= $rowjumlahlikecomment['jumlah'] ?></a>
                        <?php
                        } else if(!$rowlike) { ?>
                            <a href="create_like_comment.php?id_comment=<?= $rowcomment['id'] ?>" class=" text-body mt-0 text-decoration-none" style="font-size: 25px;"><img class="mt-0" src="img/heart.png" style="width: 15px;"/><?= $rowjumlahlikecomment['jumlah'] ?></a>
                        <?php
                        }
                        ?>
                        <?php
                        } else { ?>
                            <a href="login.php" class="d-inline text-body text-decoration-none" style="font-size: 25px;"><img src="img/heart.png" style="width: 15px;"/><?= $rowjumlahlikecomment['jumlah'] ?></a>
                        <?php
                        }
                        ?>
                    </div>
                    <?php if(isset($_SESSION['user_role']) && !empty($_SESSION['user_role']) && $_SESSION['user_role'] == "admin") { ?>
                        <div class="d-block">
                            <a class=" text-body text-decoration-none" href="delete_comment.php?id_comment=<?= $rowcomment['id']?>&id_post=<?= $rowpost['id']?>"><img src="img/x_red.png" style="height:20px;width:20px;" alt="">Delete</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
                
            </div>
    <?php
        }
    ?>

    <!--modal postingan  -->
    <div class="modal fade" id="modal_create" style="border: 1px solid;padding: 10px;box-shadow: 5px 10px red;border-radius:10px;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="mx-auto container">
                            <h1>Create Post</h1>
                            <form action="create_post_proses.php" method="post" class="mx-auto my-auto">
                                <div class="mb-4">
                                    <label for="">Subject</label>
                                    <input required type="text" name="subject" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Konten</label>
                                    <textarea required type="text" name="konten" class="form-control" rows="3"></textarea>
                                </div>
                                <label for="">Category</label>
                                    <select name="kategori" class="form-select"><br>
                                        <option value="C">C</option>
                                        <option value="PHP">PHP</option>
                                        <option value="Python">Python</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                    </select>
                                    <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-warning mb-2" style="width: 50%;">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="javascript.js"></script>
</body>
</html>