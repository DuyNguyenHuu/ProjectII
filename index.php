<?php
    require_once "session.php";
    require_once "database.php";

    $sql_CTĐT = "SELECT * FROM `monhoc` NATURAL JOIN `chuongtrinhdaotao` WHERE MADAOTAO = 'CTĐT'";
    $result_questionĐT = $mysqli -> query($sql_CTĐT);
    $result_examĐT = $mysqli -> query($sql_CTĐT);
    
    $sql_CTQT = "SELECT * FROM `monhoc` NATURAL JOIN `chuongtrinhdaotao` WHERE MADAOTAO = 'CTQT'";
    $result_questionQT = $mysqli -> query($sql_CTQT);
    $result_examQT = $mysqli -> query($sql_CTQT);

    $sql_CTTN = "SELECT * FROM `monhoc` NATURAL JOIN `chuongtrinhdaotao` WHERE MADAOTAO = 'CTTN'";
    $result_questionTN = $mysqli -> query($sql_CTTN);
    $result_examTN = $mysqli -> query($sql_CTTN);

    $sql_CTTT = "SELECT * FROM `monhoc` NATURAL JOIN `chuongtrinhdaotao` WHERE MADAOTAO = 'CTTT'";
    $result_questionTT = $mysqli -> query($sql_CTTT);
    $result_examTT = $mysqli -> query($sql_CTTT);

    $email = "";
    if (isset($_SESSION["email"]))
        $email = $_SESSION["email"];
    $sql_updateinfor = " SELECT * FROM `dangky` WHERE EMAIL = '$email'";
    $result_updateinfor = $mysqli -> query($sql_updateinfor);
    $result_changepassword = $mysqli -> query($sql_updateinfor);

    $sql_addsubject = "SELECT * FROM `monhoc` NATURAL JOIN `chuongtrinhdaotao` WHERE 1";
    $result_addsubject = $mysqli -> query($sql_addsubject);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngân hàng đề thi</title>
    <link rel="stylesheet" href="style.css" />
    <script src="element.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:400,700&display=swap">

</head>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script>
<script src="element.js"></script>

<body>
    <section class="background">
        <section>
            <?php
            if (!isset($_SESSION["email"]))      
                echo "<a href = \"signin.php\"><button class = 'dangnhap-ki'>Đăng nhập</button></a>";
            else
                echo "<a href = \"signout.php\"><button class = 'dangnhap-ki'>Đăng xuất</button></a>";
            ?>
            <a href = "index.php" style = "text-decoration: none;"><h1 class = "h1" style = "font-size: 3rem;">QUESTIONBANK</h1></a>
        </section>
        <h2>Trường công nghệ thông tin và truyền thông</h2>
    </section>

    <section>
        <form class="search">
            <input type="text" name = "search" placeholder="Nhập mã tìm kiếm">
            <button type = "submit" >Tìm kiếm</button>
        </form>
    </section>
<main class="font">
    <header>
        <div>
            <div>
                <?php
                    $sql_dangky = "SELECT * FROM `dangky` WHERE EMAIL = '$email'";
                    $result_dangky = $mysqli -> query($sql_dangky);

                    if (mysqli_num_rows($result_dangky) > 0){
                        while ($row = mysqli_fetch_assoc($result_dangky)){
                            if($row["VAITRO"]){
                                echo "<div class = 'dropdown'>
                                <button class='dropbtn'>DANH MỤC</button>
                                <div id='myDropdown' class='dropdown-content'>
                                    <a href = '#' onclick='displayform(`addquestion`);'>Thêm câu hỏi</a>
                                    <a href = '#' onclick='displayform(`editquestion`);'>Chỉnh sửa câu hỏi</a>
                                    <a href = '#' onclick='displayform(`addexam`);'>Thêm đề thi</a>
                                </div>
                            </div>";
                            }
                            else{
                                echo "<div class = 'dropdown'>
                                <button class='dropbtn'>DANH MỤC</button>
                                <div id='myDropdown' class='dropdown-content'>
                                </div>
                            </div>";
                            }
                        }
                    }
                ?>

                <div class = "dropdown">
                    <button class="dropbtn">CHƯƠNG TRÌNH ĐẠI TRÀ</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href = "#" onclick="displayform('questionCTĐT');">Câu hỏi</a>
                        <a href = "#" onclick="displayform('examCTĐT');">Đề thi</a>
                    </div>
                </div>

                <div class = "dropdown">
                    <button class="dropbtn">CHƯƠNG TRÌNH QUỐC TẾ</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href = "#" onclick="displayform('questionCTQT');">Câu hỏi</a>
                        <a href = "#" onclick="displayform('examCTQT');">Đề thi</a>
                    </div>
                </div>

                <div class = "dropdown">
                    <button class="dropbtn">CHƯƠNG TRÌNH TÀI NĂNG</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href = "#" onclick="displayform('questionCTTN');">Câu hỏi</a>
                        <a href = "#" onclick="displayform('examCTTN');">Đề thi</a>
                    </div>
                </div>

                <div class = "dropdown">
                    <button class="dropbtn">CHƯƠNG TRÌNH TIÊN TIẾN</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href = "#" onclick="displayform('questionCTTT');">Câu hỏi</a>
                        <a href = "#" onclick="displayform('examCTTT');">Đề thi</a>
                    </div>
                </div>

                <?php
                if (isset($_SESSION["email"]))
                    echo "
                    <div class = 'dropdown'>
                        <button class='dropbtn' style='width: 159%;'>Tài khoản: ".$_SESSION["email"]."</button>
                        <div id='myDropdown' class='dropdown-content'>
                            <a href = '#' onclick='displayform(`updateinfor`);'> Cập nhật thông tin</a>
                            <a href = '#' onclick='displayform(`changepassword`);'>Thay đổi mật khẩu</a>
                            <a href = 'signout.php'>Đăng xuất</a>
                        </div>
                    </div>
                    ";
                else
                    echo "<a href = 'signin.php'><button style = ' margin: auto' class=\"nutbam\">Tài khoản: </button></a>";
                ?>
            </div>
        </div>
    </header>

    <div  style= "display:none;" id="questionCTĐT" class="addform">
        <aside>
            <fieldset class="fieldset">
                <legend>Môn học</legend>
                <form class="form-group" method ='POST' style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                    <input type="text" name = "searchquestionCTĐT" placeholder="Nhập mã tìm kiếm"><br>
                    <?php
                        if (mysqli_num_rows($result_questionĐT) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_questionĐT))
                                if ($row["MADAOTAO"] != $prev)
                                    echo "<label><input id='' type='radio' name='question' value='".$row["MAMONHOC"]."'>".$row["MAMONHOC"]." - ".$row["TENMONHOC"]."</label><br>";
                        }
                    ?>
                    <button type = "submit" class = "btn btn-primary" name = "searchquestion">Tìm kiếm</button><br>
                </form>
            </fieldset>
        </aside>
        <content>
            <?php
                if (isset($_POST['searchquestion'])){
                    echo "<script>display('questionCTĐT');</script>";
                    
                    $search = $_POST['searchquestionCTĐT'];
                    $choose = "";
                    if(isset($_POST['question'])){
                        $choose = $_POST['question'];
                    }
                    $sql_searchquestion = " SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan`
                                            WHERE MADAOTAO = 'CTĐT' AND MAMONHOC = '$search' OR MAMONHOC = '$choose'";
                    $result_searchquestion = $mysqli -> query($sql_searchquestion);
                    if (mysqli_num_rows($result_searchquestion) > 0){
                        $prev = "";
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result_searchquestion)){
                            if ($row["MADANG"] == "CHOOSEONE"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            elseif($row["MADANG"] == "CHOOSEMANY"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            else{
                                $count++;
                                echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                        <input type='text' name = 'answer' placeholder='Điền đáp án'>";
                            }

                        }
                    }
                }
                else{
                    $sql_question = "SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan` WHERE MADAOTAO = 'CTĐT'";
                    $result_question = $mysqli -> query($sql_question);

                    if (mysqli_num_rows($result_question) > 0){
                        $prev = "";
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result_question)){
                            if ($row["MADANG"] == "CHOOSEONE"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            elseif($row["MADANG"] == "CHOOSEMANY"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            else{
                                $count++;
                                echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                        <input type='text' name = 'answer' placeholder='Điền đáp án'><br>";
                            }

                        }
                    }
                }
            ?>
        </content>
    </div>

    <div  style= "display:none;" id="examCTĐT" class="addform">
        <aside>
            <fieldset class="fieldset">
                <legend>Môn học</legend>
                <form class="form-group" method ='POST' style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                <input type="text" name = "searchexamCTĐT" placeholder="Nhập mã tìm kiếm"><br>
                <?php
                    if (mysqli_num_rows($result_examĐT) > 0){
                        $prev = "";
                        while ($row = mysqli_fetch_assoc($result_examĐT))
                            if ($row["MADAOTAO"] != $prev)
                                echo "<label><input id='' type='radio' name='exam' value='".$row["MAMONHOC"]."'>".$row["MAMONHOC"]." - ".$row["TENMONHOC"]."</label><br>";
                    }
                ?>
                <button type = "submit" class= "btn btn-primary" name = 'searchexam'>Tìm kiếm</button><br>
            </fieldset>
        </aside>
        <content id="exam">
            <?php
                if(isset($_POST['searchexam'])){
                    echo "<script>display('examCTĐT');</script>";
                    
                    $searchexam = $_POST['searchexamCTĐT'];
                    $chooseexam = "";
                    if(isset($_POST['exam'])){
                        $chooseexam = $_POST['exam'];
                    }
                    $sql_exam = "SELECT * FROM `dethi` NATURAL JOIN `monhoc-giaovien` NATURAL JOIN `monhoc`
                                WHERE MADAOTAO = 'CTĐT' AND MAMONHOC = '$searchexam' OR MAMONHOC = '$chooseexam'";
                    $result_exam = $mysqli -> query($sql_exam);
                    if (mysqli_num_rows($result_exam) > 0){
                        $prevmadethi = "";
                        $prevmamonhoc = "";
                        while ($row = mysqli_fetch_assoc($result_exam)){
                            if(($row['MADETHI'] != $prevmadethi) OR ($row['MAMONHOC'] != $prevmamonhoc)){
                                echo "<nav class='viewdethi'>
                                      <form method = 'POST'>
                                      <label>Giảng viên: ".$row["TENGIANGVIEN"]."</label><br>
                                      <input type = 'hidden' name = 'magiangvien' value ='".$row["MAGIANGVIEN"]."'>
                                      <label>Môn học: ".$row["TENMONHOC"]."</label><br>
                                      <input type = 'hidden' name = 'mamonhoc' value ='".$row["MAMONHOC"]."'>
                                      <label>Mã đề thi: ".$row["MADETHI"]."</label><br>
                                      <input type = 'hidden' name = 'madethi' value ='".$row["MADETHI"]."'>
                                      <label>Thời gian thi: ".$row["THOIGIANTHI"]." phút</label><br>
                                      <button type = 'submit' class = 'btn btn-primary'name = 'xemchitiet'>Xem chi tiết</button><br><br>
                                      </form>
                                      </nav>";
                                $prevmadethi = $row['MADETHI'];
                                $prevmamonhoc = $row['MAMONHOC'];
                            }
                        }
                    }
                    
                }
                else{
                    if(isset($_POST['xemchitiet'])){
                        echo "<script>display('examCTĐT');</script>";
                        $sql_eachexam = "SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan` NATURAL JOIN `dethi` NATURAL JOIN `dethi-cauhoi`
                                        WHERE MADAOTAO = 'CTĐT' AND MAMONHOC = '".$_POST['mamonhoc']."' AND MADETHI = '".$_POST['madethi']."'";
                        $result_eachexam = $mysqli -> query($sql_eachexam);
                        if (mysqli_num_rows($result_eachexam) > 0){
                            $prev = "";
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($result_eachexam)){
                                if ($row["MADANG"] == "CHOOSEONE"){
                                    if ($row["MACAUHOI"] != $prev){
                                        $count++;
                                        echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                                <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                                $prev = $row["MACAUHOI"];
                                        }
                                    else{
                                        echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                        $prev = $row["MACAUHOI"];
                                    }
                                }
                                elseif($row["MADANG"] == "CHOOSEMANY"){
                                    if ($row["MACAUHOI"] != $prev){
                                        $count++;
                                        echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                                <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                                $prev = $row["MACAUHOI"];
                                        }
                                    else{
                                        echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                        $prev = $row["MACAUHOI"];
                                    }
                                }
                                else{
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <input type='text' name = 'answer' placeholder='Điền đáp án'><br>";
                                }
    
                            }
                            echo "<button type='button' class = 'btn btn-success' onclick='toPdf()'>Export to PDF</button>";
                        }

                    }
                    else {
                        if(isset($_POST['xemtatca'])){
                            echo "<script>display('examCTĐT');</script>";
                            $sql_allexam = "SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan` NATURAL JOIN `dethi` NATURAL JOIN `dethi-cauhoi`
                                            WHERE MADAOTAO = 'CTĐT' AND MAMONHOC = '".$_POST['mamonhoc']."' AND MADETHI = '".$_POST['madethi']."'";
                            $result_allexam = $mysqli -> query($sql_allexam);
                            
                            if (mysqli_num_rows($result_allexam) > 0){
                                $prev = "";
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($result_allexam)){
                                    if ($row["MADANG"] == "CHOOSEONE"){
                                        if ($row["MACAUHOI"] != $prev){
                                            $count++;
                                            echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                                    <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                                    $prev = $row["MACAUHOI"];
                                            }
                                        else{
                                            echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                        }
                                    }
                                    elseif($row["MADANG"] == "CHOOSEMANY"){
                                        if ($row["MACAUHOI"] != $prev){
                                            $count++;
                                            echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                                    <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                                    $prev = $row["MACAUHOI"];
                                            }
                                        else{
                                            echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                        }
                                    }
                                    else{
                                        $count++;
                                        echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                                <input type='text' name = 'answer' placeholder='Điền đáp án'><br>";
                                    }
        
                                }
                                echo "<button type='button' class = 'btn btn-success' onclick='toPdf()'>Export to PDF</button>";
                            }
                            
    
                        }
                        else{
                        $sql_allexam = "SELECT * FROM `dethi` NATURAL JOIN `monhoc-giaovien` NATURAL JOIN `monhoc`
                        WHERE MADAOTAO = 'CTĐT'";
                        $result_allexam = $mysqli -> query($sql_allexam);
                        if (mysqli_num_rows($result_allexam) > 0){
                            $prevmadethi = "";
                            $prevmamonhoc = "";
                            while ($row_all = mysqli_fetch_assoc($result_allexam)){
                                if(($row_all['MADETHI'] != $prevmadethi) OR ($row_all['MAMONHOC'] != $prevmamonhoc)){
                                    echo "<nav class='viewdethi'>
                                          <form method = 'POST'>
                                          <label>Giảng viên: ".$row_all["TENGIANGVIEN"]."</label><br>
                                          <input type = 'hidden' name = 'magiangvien' value ='".$row_all["MAGIANGVIEN"]."'>
                                          <label>Môn học: ".$row_all["TENMONHOC"]."</label><br>
                                          <input type = 'hidden' name = 'mamonhoc' value ='".$row_all["MAMONHOC"]."'>
                                          <label>Mã đề thi: ".$row_all["MADETHI"]."</label><br>
                                          <input type = 'hidden' name = 'madethi' value ='".$row_all["MADETHI"]."'>
                                          <label>Thời gian thi: ".$row_all["THOIGIANTHI"]." phút</label><br>
                                          <button type = 'submit' class='btn btn-primary' name = 'xemtatca'>Xem chi tiết</button><br><br>
                                          </form>
                                          </nav>";
                                    $prevmadethi = $row_all['MADETHI'];
                                    $prevmamonhoc = $row_all['MAMONHOC'];
                                }
                            }
                        }
                    }
                    }
                }  
            ?>
            </form>
        </content>
    </div>

    <div  style= "display:none;" id="questionCTQT" class="addform">
        <aside>
            <fieldset class="fieldset">
                <legend>Môn học</legend>
                <form class="form-group" method ='POST' style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                    <input type="text" name = "searchquestionCTQT" placeholder="Nhập mã tìm kiếm"><br>
                    <?php
                        if (mysqli_num_rows($result_questionQT) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_questionQT))
                                if ($row["MADAOTAO"] != $prev)
                                    echo "<label><input id='' type='radio' name='question' value='".$row["MAMONHOC"]."'>".$row["MAMONHOC"]." - ".$row["TENMONHOC"]."</label><br>";
                        }
                    ?>
                    <button type = "submit" class = 'btn btn-primary'name = "search1">Tìm kiếm</button><br>
                </form>
            </fieldset>
        </aside>
        <content>
            <?php
                if (isset($_POST['search1'])){
                    echo "<script>display('questionCTQT');</script>";
            
                    $search = $_POST['searchquestionCTQT'];
                    $choose = $_POST['question'];

                    $sql_searchquestion = " SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan`
                                            WHERE MADAOTAO = 'CTQT' AND MAMONHOC = '$search' OR MAMONHOC = '$choose'";
                    $result_searchquestion = $mysqli -> query($sql_searchquestion);
                    if (mysqli_num_rows($result_searchquestion) > 0){
                        $prev = "";
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result_searchquestion)){
                            if ($row["MADANG"] == "CHOOSEONE"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            elseif($row["MADANG"] == "CHOOSEMANY"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            else{
                                $count++;
                                echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                        <input type='text' name = 'answer' placeholder='Điền đáp án'>";
                            }

                        }
                    }
                }
                else{
                    $sql_question = "SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan` WHERE MADAOTAO = 'CTQT'";
                    $result_question = $mysqli -> query($sql_question);

                    if (mysqli_num_rows($result_question) > 0){
                        $prev = "";
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result_question)){
                            if ($row["MADANG"] == "CHOOSEONE"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            elseif($row["MADANG"] == "CHOOSEMANY"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            else{
                                $count++;
                                echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                        <input type='text' name = 'answer' placeholder='Điền đáp án'><br>";
                            }

                        }
                    }
                }
            ?>  
        </content>   
    </div>

    <div  style= "display:none;" id="examCTQT" class="addform">
        <aside>
            <fieldset class="fieldset">
                <legend>Môn học</legend>
                <form class="form-group" method ='POST' style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                    <input type="text" name = "searchexamCTQT" placeholder="Nhập mã tìm kiếm"><br>
                    <?php
                        if (mysqli_num_rows($result_examQT) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_examQT))
                                if ($row["MADAOTAO"] != $prev)
                                    echo "<label><input id='' type='radio' name='question' value=''>".$row["MAMONHOC"]." - ".$row["TENMONHOC"]."</label><br>";
                        }
                    ?>
                    <button type = "submit" class = 'btn btn-primary'name = "search2">Tìm kiếm</button><br>
                    </form>
            </fieldset>
        </aside>
    </div>

    <div  style= "display:none;" id="questionCTTN" class="addform">
        <aside>
            <fieldset class="fieldset">
                <legend>Môn học</legend>
                <form class="form-group" method ='POST' style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                    <input type="text" name = "searchquestionCTTN" placeholder="Nhập mã tìm kiếm"><br>
                    <?php
                        if (mysqli_num_rows($result_questionTN) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_questionTN))
                                if ($row["MADAOTAO"] != $prev)
                                    echo "<label><input id='' type='radio' name='question' value='".$row["MAMONHOC"]."'>".$row["MAMONHOC"]." - ".$row["TENMONHOC"]."</label><br>";
                        }
                    ?>
                    <button type = "submit" class = 'btn btn-primary' name = "search2">Tìm kiếm</button><br>
                </form>
            </fieldset>
        </aside>
        <content>
            <?php
                if (isset($_POST['search2'])){
                    echo "<script>display('questionCTTN');</script>";
            
                    $search = $_POST['searchquestionCTTN'];
                    $choose = $_POST['question'];

                    $sql_searchquestion = " SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan`
                                            WHERE MADAOTAO = 'CTTN' AND MAMONHOC = '$search' OR MAMONHOC = '$choose'";
                    $result_searchquestion = $mysqli -> query($sql_searchquestion);
                    if (mysqli_num_rows($result_searchquestion) > 0){
                        $prev = "";
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result_searchquestion)){
                            if ($row["MADANG"] == "CHOOSEONE"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            elseif($row["MADANG"] == "CHOOSEMANY"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            else{
                                $count++;
                                echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                        <input type='text' name = 'answer' placeholder='Điền đáp án'>";
                            }

                        }
                    }
                }
                else{
                    $sql_question = "SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan` WHERE MADAOTAO = 'CTTN'";
                    $result_question = $mysqli -> query($sql_question);

                    if (mysqli_num_rows($result_question) > 0){
                        $prev = "";
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result_question)){
                            if ($row["MADANG"] == "CHOOSEONE"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            elseif($row["MADANG"] == "CHOOSEMANY"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            else{
                                $count++;
                                echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                        <input type='text' name = 'answer' placeholder='Điền đáp án'><br>";
                            }

                        }
                    }
                }
            ?>   
        </content>   
    </div>

    <div  style= "display:none;" id="examCTTN" class="addform">
        <aside>
            <fieldset class="fieldset">
                <legend>Môn học</legend>
                <form class="form-group" method ='POST' style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                <input type="text" name = "searchexamCTTN" placeholder="Nhập mã tìm kiếm">
                <?php
                    if (mysqli_num_rows($result_examTN) > 0){
                        $prev = "";
                        while ($row = mysqli_fetch_assoc($result_examTN))
                            if ($row["MADAOTAO"] != $prev)
                                echo "<label><input id='' type='radio' name='question' value=''>".$row["MAMONHOC"]." - ".$row["TENMONHOC"]."</label><br>";
                    }
                ?>
                <button type = "submit" class = 'btn btn-primary' name = "search3">Tìm kiếm</button><br>
                </form>
            </fieldset>
        </aside>
    </div>

    <div  style= "display:none;" id="questionCTTT" class="addform">
        <aside>
            <fieldset class="fieldset">
                <legend>Môn học</legend>
                <form method = 'POST'  style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                    <input type="text" name = "searchquestionCTTT" placeholder="Nhập mã tìm kiếm"><br>
                    <?php
                        if (mysqli_num_rows($result_questionTT) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_questionTT))
                                if ($row["MADAOTAO"] != $prev)
                                    echo "<label><input id='' type='radio' name='question' value='".$row["MAMONHOC"]."'>".$row["MAMONHOC"]." - ".$row["TENMONHOC"]."</label><br>";
                        }
                    ?>
                    <button type = "submit" name = "search3">Tìm kiếm</button><br>
                </form>
            </fieldset>
        </aside>
        <content>
            <?php
                if (isset($_POST['search3'])){
                    echo "<script>display('questionCTTT');</script>";
            
                    $search = $_POST['searchquestionCTTT'];
                    $choose = $_POST['question'];

                    $sql_searchquestion = " SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan`
                                            WHERE MADAOTAO = 'CTTT' AND MAMONHOC = '$search' OR MAMONHOC = '$choose'";
                    $result_searchquestion = $mysqli -> query($sql_searchquestion);
                    if (mysqli_num_rows($result_searchquestion) > 0){
                        $prev = "";
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result_searchquestion)){
                            if ($row["MADANG"] == "CHOOSEONE"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            elseif($row["MADANG"] == "CHOOSEMANY"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            else{
                                $count++;
                                echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                        <input type='text' name = 'answer' placeholder='Điền đáp án'>";
                            }

                        }
                    }
                }
                else{
                    $sql_question = "SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan` WHERE MADAOTAO = 'CTTT'";
                    $result_question = $mysqli -> query($sql_question);

                    if (mysqli_num_rows($result_question) > 0){
                        $prev = "";
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result_question)){
                            if ($row["MADANG"] == "CHOOSEONE"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            elseif($row["MADANG"] == "CHOOSEMANY"){
                                if ($row["MACAUHOI"] != $prev){
                                    $count++;
                                    echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            else{
                                $count++;
                                echo "  <label>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                        <input type='text' name = 'answer' placeholder='Điền đáp án'><br>";
                            }

                        }
                    }
                }
            ?>   
        </content>   
    </div>

    <div  style= "display:none;" id="examCTTT" class="addform">
        <aside>
            <fieldset class="fieldset">
                <legend>Môn học</legend>
                <form method = 'POST'  style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                <input type="text" name = "searchexamCTTT" placeholder="Nhập mã tìm kiếm">
                <?php
                    if (mysqli_num_rows($result_examTT) > 0){
                        $prev = "";
                        while ($row = mysqli_fetch_assoc($result_examTT))
                            if ($row["MADAOTAO"] != $prev)
                                echo "<label><input id='' type='radio' name='question' value=''>".$row["MAMONHOC"]." - ".$row["TENMONHOC"]."</label><br>";
                    }
                ?>
                <button type = "submit" name = "search3">Tìm kiếm</button><br>
                </form>
            </fieldset>
        </aside>
    </div>

    <div style= "display:none;" id="addquestion" class="addform">
        <?php
            $sql_addquestion = "SELECT * FROM `monhoc` NATURAL JOIN `chuongtrinhdaotao` NATURAL JOIN `monhoc-giaovien` 
                                WHERE EMAIL = '$email'";
            $result_addquestioncourses = $mysqli -> query($sql_addquestion);
            $result_addquestionsubjects = $mysqli -> query($sql_addquestion);
        ?>
        <aside>
            <fieldset class="fieldset">
            <legend>Thêm câu hỏi</legend>
            <form class="form-group" method ='POST' style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                <label>Chọn chương trình: </label>
                <select class="form-select" id ="courses" name = "courses" onchange = "displayMonSelect('#addquestion')">
                    <?php
                        if (mysqli_num_rows($result_addquestioncourses) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_addquestioncourses))
                                if ($row["MADAOTAO"] != $prev){
                                    if($_POST["courses"] == $row['MADAOTAO']) {
                                        echo $_POST["courses"] ." - ". $row['MADAOTAO'] . "<br>";
                                        echo "<option value='$row[MADAOTAO]' selected>$row[TENDAOTAO]</option>";
                                    } else {
                                        echo "<option value='$row[MADAOTAO]'>$row[TENDAOTAO]</option>";
                                    }
                                    $prev = $row['MADAOTAO'];
                                }    
                        }
                    ?>
                </select></br>
                    
                <label>Chọn môn học: </label>
                <select class="form-select" id ="subjects" name = "subjects">
                    <option>Chọn môn học</option>
                    <?php
                        if (mysqli_num_rows($result_addquestionsubjects) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_addquestionsubjects))
                                if ($row["MAMONHOC"] != $prev){
                                    if($_POST["subjects"] == $row['MAMONHOC']) {
                                        echo $_POST["subjects"] ." - ". $row['MAMONHOC'] . "<br>";
                                        echo "<option class='$row[MADAOTAO]' value ='$row[MAMONHOC]' selected>$row[MAMONHOC]-$row[TENMONHOC]</option>";
                                    } else {
                                        echo "<option class='$row[MADAOTAO]' value ='$row[MAMONHOC]'>$row[MAMONHOC]-$row[TENMONHOC]</option>";
                                    }
                                    $prev = $row['MAMONHOC'];
                                }    
                        }

                        if (!isset($_POST["subjects"])) 
                            echo "<script>
                                displayMonSelect('#addquestion');
                            </script>";
                    ?>
                    
                </select></br>
            
                <label>Chọn dạng câu hỏi: </label>
                <select class="form-select" id ="dangcauhoi" name ="dangcauhoi">
                    <?php
                        $sql_dangcauhoi = "SELECT * FROM `dangcauhoi` WHERE 1";
                        $result_dangcauhoi = $mysqli -> query($sql_dangcauhoi);

                        if (mysqli_num_rows($result_dangcauhoi) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_dangcauhoi))
                                if ($row["MADANG"] != $prev){
                                    echo "<option value = '$row[MADANG]'>$row[TENDANG]</option>";
                                    $prev = $row[MADANG];
                                }    
                        }
                    ?>
                </select></br>
                <label>Mã câu hỏi: </label>
                <input class="form-control"  type="text" name = "macauhoi" placeholder="Nhập mã câu hỏi"/><br>
                <label>Nội dung câu hỏi: </label>
                <textarea class="form-control"  name = "noidungcauhoi" placeholder="Nhập nội dung câu hỏi"></textarea><br>
                <label>Số lượng đáp án: </label>
                <input class="form-control" type = "number" name="soluong" placeholder="Nhập số lượng đáp án"><br>
                <label>Chọn mức độ: </label>
                <select class="form-select" name = 'mucdo'>
                    <?php
                        $sql_mucdo = "SELECT * FROM `mucdo` WHERE 1";
                        $result_mucdo = $mysqli -> query($sql_mucdo);

                        if (mysqli_num_rows($result_mucdo) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_mucdo))
                                if ($row["MAMUCDO"] != $prev){
                                    echo "<option value = '$row[MAMUCDO]'>$row[TENMUCDO]</option>";
                                    $prev = $row[MAMUCDO];
                                }    
                        }
                    ?>
                </select></br>
                <button class="btn btn-primary" type = 'submit' name = 'add'>Thêm</button>
            </form>
        </aside>
        <content>
            <?php
                if (isset($_POST['add'])){
                    echo "<script>display('addquestion')</script>";
                    $sql_checkquestion = "SELECT COUNT(*) FROM `cauhoi` WHERE MACAUHOI = '".$_POST['macauhoi']."' AND MADAOTAO = '".$_POST['courses']."'
                                                            AND MAMONHOC = '".$_POST['subjects']."'";
                    $result_checkquestion = $mysqli -> query($sql_checkquestion);
                    $result = $result_checkquestion->fetch_array();
                    if($result[0] == 0){
                        $sql_add = "INSERT INTO `cauhoi`(MACAUHOI, MADAOTAO, MAMONHOC, MADANG, NOIDUNGCAUHOI, MAMUCDO)
                                    VALUES ('".$_POST['macauhoi']."','".$_POST['courses']."','".$_POST['subjects']."','".$_POST['dangcauhoi']."',
                                    '".$_POST['noidungcauhoi']."','".$_POST['mucdo']."')";
                        $mysqli -> query($sql_add);  
                        echo "Nội dung câu hỏi ".$_POST['macauhoi'].": ".$_POST['noidungcauhoi']."<br><br>";
                        if ($_POST['dangcauhoi']=="CHOOSEONE" OR $_POST['dangcauhoi']=="CHOOSEMANY"){
                            $countform = $_POST['soluong'];
                            $macauhoi = $_POST['macauhoi'];
                            $subjects = $_POST['subjects'];
                            $courses = $_POST['courses'];
                            echo "<form method='POST'>";
                            for($countanswer = 0; $countanswer < $_POST['soluong']; $countanswer++){
                                echo "<label>Mã đáp án: </label>
                                      <input type = 'text' name = 'answercode".$countanswer."' placeholder='Điền mã đáp án'><br>
                                      <label>Nội dung đáp án: </label>
                                      <input type = 'text' name = 'answer".$countanswer."' placeholder='Điền đáp án'><br>
                                      <label>Trạng thái đáp án: </label>
                                      <input type = 'range' name = 'truefalse".$countanswer."' min='0' max='1'><br><br>
                                      <input type = 'hidden' name='count' value='$countform'>
                                      <input type = 'hidden' name='macauhoi' value='$macauhoi'>
                                      <input type = 'hidden' name='courses' value='$courses'>
                                      <input type = 'hidden' name='subjects' value='$subjects'>";
                            }
                            echo "<button type = 'submit' name = 'themdapan'>Cập nhật</button>";
                            echo "</form>";
                        }
                        else{
                            $macauhoi = $_POST['macauhoi'];
                            echo "<form method ='POST'>
                                  <label>Đáp án: </label><br>
                                  <input type = 'text' name = 'answer' placeholder='Điền đáp án'><br>
                                  <button type = 'submit' name = 'addfill'>Thêm</button>
                                  <input type = 'hidden' name='macauhoi' value='$macauhoi'>
                                  </form>";
                        }
                    }
                    else echo "<script>alert('Cập nhật không thành công do mã câu hỏi đã tồn tại!');window.location.href = 'index.php';</script>";
                }
                if(isset($_POST['themdapan'])){
                    for($cout = 0; $cout < $_POST['count']; $cout++){
                        $sql_addanswer = "INSERT INTO `cauhoi-dapan`(MACAUHOI, MADAPAN, NOIDUNGDAPAN, TRANGTHAI)
                                        VALUES ('".$_POST['macauhoi']."','".$_POST['answercode'.$cout]."','".$_POST['answer'.$cout]."','".$_POST['truefalse'.$cout]."')";
                        $mysqli -> query($sql_addanswer);
                    }
                    echo "<script>display('addquestion');alert('Cập nhật thành công!');</script>";
                }
                if(isset($_POST['addfill'])){
                    $sql_addfill = "INSERT INTO `cauhoi-dapan`(MACAUHOI, NOIDUNGDAPAN, TRANGTHAI)
                                    VALUES ('".$_POST['macauhoi']."', '".$_POST['answer']."', '1')";
                    $mysqli -> query($sql_addfill);
                    echo "<script>display('addquestion');alert('Cập nhật thành công!');</script>";
                }
            ?>
        </content>
    </div>

    <div style= "display:none;" id="addexam" class="addform">
        <?php
            $sql_addexam = "SELECT * FROM `monhoc` NATURAL JOIN `chuongtrinhdaotao` NATURAL JOIN `monhoc-giaovien` 
                            WHERE EMAIL = '$email'";
            $result_addexamcourses = $mysqli -> query($sql_addexam);
            $result_addexamsubjects = $mysqli -> query($sql_addexam);
        ?>
        <aside>
            <fieldset class="fieldset">
            <legend>Thêm đề thi</legend>
            <form class="form-group" method ='POST' style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                <label>Chọn chương trình: </label>
                <select id='courses' name ='courses' onchange = "displayMonSelect('#addexam')">
                    <?php
                        if (mysqli_num_rows($result_addexamcourses) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_addexamcourses))
                                if ($row["MADAOTAO"] != $prev){
                                    if ($_POST['courses'] == $row['MADAOTAO']) {
                                        echo "<option value='$row[MADAOTAO]' selected>$row[TENDAOTAO]</option>";
                                    } else {
                                        echo "<option value='$row[MADAOTAO]'>$row[TENDAOTAO]</option>";
                                    }
                                    $prev = $row['MADAOTAO'];
                                }    
                        }
                    ?>
                </select></br>
                <label>Chọn môn học: </label>
                <select id='subjects' name ='subjects'>
                    <option>Chọn môn học</option>
                    <?php
                        if (mysqli_num_rows($result_addexamsubjects) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_addexamsubjects))
                                if ($row['MAMONHOC'] != $prev){
                                    if ($_POST['subjects'] == $row['MAMONHOC']) {
                                        echo "<option class='$row[MADAOTAO]' value ='$row[MAMONHOC]' selected>$row[MAMONHOC]-$row[TENMONHOC]</option>";
                                    } else {
                                        echo "<option class='$row[MADAOTAO]' value ='$row[MAMONHOC]'>$row[MAMONHOC]-$row[TENMONHOC]</option>";
                                    }
                                    $prev = $row['MAMONHOC'];
                                }    
                        }

                        if (!isset($_POST['subjects'])) {
                            echo "<script>
                                displayMonSelect('#addexam');
                            </script>";
                        }
                    ?>
                    
                </select></br>
                <button type = 'submit' class="btn btn-primary" name ='addexam'>Thêm</button>
            </form>
        </aside>
        <content>
            <?php
                if(isset($_POST['addexam'])){
                    echo "<script>display('addexam')</script>";
                    $madaotao = $_POST['courses'];
                    $mamonhoc = $_POST['subjects'];
                    $sql_giangvien = "SELECT * FROM `monhoc-giaovien` NATURAL JOIN `monhoc` WHERE MADAOTAO = '$madaotao' AND MAMONHOC = '$mamonhoc'";
                    $result_giangvien = $mysqli -> query($sql_giangvien);
                    echo "<form method ='POST'>
                          <label?>Chọn giáo viên: </label>
                          <select id='teachers' name = 'teachers'>";  
                        if (mysqli_num_rows($result_giangvien) > 0){
                        $prev = "";
                        while ($row = mysqli_fetch_assoc($result_giangvien))
                            if ($row['MAGIANGVIEN'] != $prev){
                                echo "<option value ='$row[MAGIANGVIEN]'>$row[TENGIANGVIEN]</option>";
                                $prev = $row['MAGIANGVIEN'];
                            }    
                        }
                    echo "</select><br><br>
                          <input type = 'hidden' name = 'madaotao' value = '$madaotao'>
                          <input type = 'hidden' name = 'mamonhoc' value = '$mamonhoc'>

                          <label>Mã đề thi: </label>
                          <input type = 'text' name = 'madethi' placeholder='Nhập mã đề thi'><br><br>

                          <label>Thời gian: </label>
                          <input type = 'number' name = 'thoigian' placeholder='Nhập thời gian'><br><br>
                          <label>Danh sách câu hỏi: </label><br><br>";
                    $sql_cauhoi = "SELECT * FROM `cauhoi` NATURAL JOIN `dangcauhoi`
                                   NATURAL JOIN `mucdo` WHERE MADAOTAO = '$madaotao' AND MAMONHOC = '$mamonhoc'";
                    $result_cauhoi = $mysqli -> query($sql_cauhoi);
                    if (mysqli_num_rows($result_cauhoi) > 0){
                        $prev = "";
                        while ($row = mysqli_fetch_assoc($result_cauhoi))
                            if ($row['MACAUHOI'] != $prev){
                                echo "<input type ='checkbox' name='$row[MACAUHOI]' value=''>
                                      <label for ='$row[MACAUHOI]'>$row[MACAUHOI]($row[TENMUCDO]): $row[NOIDUNGCAUHOI]</label>
                                      ($row[TENDANG])<br><br>";
                                $prev = $row['MACAUHOI'];
                            }    
                        }
                    echo "<button type = 'submit' name ='checkexam'>Thêm đề thi</button>
                          </form>";
                }
                if (isset($_POST['checkexam'])){
                    echo "<script>display('addexam')</script>";
                    $sql_savedethi = "INSERT INTO dethi(MADETHI, MADAOTAO, MAMONHOC, MAGIANGVIEN, THOIGIANTHI)
                            VALUES ('".$_POST['madethi']."','".$_POST['madaotao']."','".$_POST['mamonhoc']."','".$_POST['teachers']."','".$_POST['thoigian']."')";
                    $mysqli -> query($sql_savedethi);
                    $sql_checkexam = "SELECT * FROM `cauhoi` NATURAL JOIN `dangcauhoi`
                                      NATURAL JOIN `mucdo` WHERE MADAOTAO = '".$_POST['madaotao']."' AND MAMONHOC = '".$_POST['mamonhoc']."'";
                    $result_checkexam = $mysqli -> query($sql_checkexam);
                    if (mysqli_num_rows($result_checkexam) > 0){
                        while ($row_check = mysqli_fetch_assoc($result_checkexam)){
                            if (isset($_POST[$row_check['MACAUHOI']])) {
                                echo "<script>display('addexam')</script>";
                                $sql_savequestion = "INSERT INTO `dethi-cauhoi`(MADETHI, MACAUHOI)
                                                     VALUES ('".$_POST['madethi']."','".$row_check['MACAUHOI']."')";
                                $mysqli -> query($sql_savequestion);
                            }
                        }
                    }
                    echo "<script>alert('Cập nhật thành công');display('addexam');</script>";
                }
            ?>
        </content>
    </div>

    <div style= "display:none;" id="editquestion" class="addform">
        <?php
            $sql_editquestion = "SELECT * FROM `monhoc` NATURAL JOIN `chuongtrinhdaotao` NATURAL JOIN `monhoc-giaovien` 
                                 WHERE EMAIL = '$email'";
            $result_editquestioncourses = $mysqli -> query($sql_editquestion);
            $result_editquestionsubjects = $mysqli -> query($sql_editquestion);
        ?>
        <?php
            if(isset($_POST['suacauhoi'])) {
                $macauhoi = $_POST['macauhoi'];
                $sql_getQuestion = "SELECT * FROM `cauhoi-dapan` WHERE `MACAUHOI` = '$macauhoi'";
                $sql_fixQuestion = "UPDATE `cauhoi` SET `NOIDUNGCAUHOI`='".$_POST['cauhoi']."' WHERE `MACAUHOI` = '$macauhoi'";

                $process_fixQuestion = $mysqli -> query($sql_fixQuestion);
                $process_getQuestion = $mysqli -> query($sql_getQuestion);
                if (mysqli_num_rows($process_getQuestion) > 0){
                    while ($row = mysqli_fetch_assoc($process_getQuestion))
                    {
                        if($row['MADAPAN']=='') {
                            $sql_update = "UPDATE `cauhoi-dapan` SET `NOIDUNGDAPAN`='".$_POST["answer"]."' WHERE  `MACAUHOI`='".$row['MACAUHOI']."'";
                            $mysqli->query($sql_update);
                        } else {
                            $sql_update = "UPDATE `cauhoi-dapan` SET `NOIDUNGDAPAN`='".$_POST["answer".$row['MADAPAN']]."',`TRANGTHAI`='".$_POST["truefalse".$row['MADAPAN']]."' WHERE `MADAPAN`='".$row["MADAPAN"]."' AND `MACAUHOI`='".$row['MACAUHOI']."'";
                            $mysqli->query($sql_update);
                        }
                    }
                }
                echo "<script>
                    display('editquestion');
                </script>";
            }
        ?>
        <aside>
            <fieldset class="fieldset">
            <legend>Sửa câu hỏi</legend>
            <form class="form-group" method ='POST' style='padding: 0.5em; border:1px solid black;background: aliceblue;'>
                <label>Chọn chương trình: </label>
                <select id='courses' name ='courses' onchange = "displayMonSelect('#editquestion')">
                    <?php
                        if (mysqli_num_rows($result_editquestioncourses) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_editquestioncourses))
                                if ($row["MADAOTAO"] != $prev){
                                    if ($_POST['courses'] == $row['MADAOTAO']) {
                                        echo "<option value='$row[MADAOTAO]' selected>$row[TENDAOTAO]</option>";
                                    } else {
                                        echo "<option value='$row[MADAOTAO]'>$row[TENDAOTAO]</option>";
                                    }
                                    $prev = $row['MADAOTAO'];
                                }    
                        }
                    ?>
                </select></br>
                <label>Chọn môn học: </label>
                <select id='subjects' name ='subjects'>
                    <option>Chọn môn học</option>
                    <?php
                        if (mysqli_num_rows($result_editquestionsubjects) > 0){
                            $prev = "";
                            while ($row = mysqli_fetch_assoc($result_editquestionsubjects))
                                if ($row['MAMONHOC'] != $prev){
                                    if ($_POST['subjects'] == $row['MAMONHOC']) {
                                        echo "<option class='$row[MADAOTAO]' value ='$row[MAMONHOC]' selected>$row[MAMONHOC]-$row[TENMONHOC]</option>";
                                    } else {
                                        echo "<option class='$row[MADAOTAO]' value ='$row[MAMONHOC]'>$row[MAMONHOC]-$row[TENMONHOC]</option>";
                                    }
                                    $prev = $row['MAMONHOC'];
                                }    
                        }

                        if (!isset($_POST['subjects'])) {
                            echo "<script>
                                displayMonSelect('#editquestion');
                            </script>";
                        }
                    ?>
                    
                </select></br>
                <button type = 'submit' class="btn btn-primary" name ='editquestion'>Thêm</button>
            </form>
        </aside>
        <content style='margin-top:1em;margin-right:1em;'>
            <?php
                if(isset($_POST['editquestion'])){
                    echo "<script>display('editquestion')</script>";
                    $madaotao = $_POST['courses'];
                    $mamonhoc = $_POST['subjects'];
                    $sql_edit = "SELECT * FROM `cauhoi` NATURAL JOIN `cauhoi-dapan` 
                                 WHERE MADAOTAO='$madaotao' AND MAMONHOC='$mamonhoc'";
                    $result_edit = $mysqli -> query($sql_edit);

                    if (mysqli_num_rows($result_edit) > 0){
                        $prev = "";
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result_edit)){
                            if ($row["MADANG"] == "CHOOSEONE"){
                                if ($row["MACAUHOI"] != $prev){
                                    if ($count > 0) echo "</form>";
                                    $count++;
                                    echo "  <form method='POST' style='padding: 0.5em;background:aliceblue;border:1px solid black;margin: 0.5em;'>
                                            <button  type='button' class='btn btn-primary fix' data-toggle='modal' data-target='#exampleModal'>
                                                Sửa câu hỏi
                                            </button><br>
                                            <button  type='submit' class='btn btn-success fix1' style='display:none;' name='suacauhoi'>
                                                Xác nhận
                                            </button>
                                            <input type='hidden' name='macauhoi' value='".$row['MACAUHOI']."'>
                                            <label class='displayques'>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <textarea class='fixques form-control' style='display:none' name='cauhoi'>".$row['NOIDUNGCAUHOI']."</textarea>
                                            <label class='displayques'><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>
                                            <div style='width:70%;margin-left:15%;'>
                                            <input class='fixques form-control' style='display:none'  type = 'text' name = 'answercode".$row['MADAPAN']."' value='".$row['MADAPAN']."' readonly>
                                            <input class='fixques form-control' style='display:none'  type = 'text' name = 'answer".$row['MADAPAN']."' value='".$row['NOIDUNGDAPAN']."' placeholder='nội dung đáp án'>
                                            <input class='fixques' style='display:none' type = 'range' name = 'truefalse".$row['MADAPAN']."' value='".$row['TRANGTHAI']."' min='0' max='1'></div>";
                                            
                                            $prev = $row["MACAUHOI"];

                                    }
                                else{
                                    echo "  <label  class='displayques'><input id='' type='radio' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>
                                    <div style='width:70%;margin-left:15%;'><input class='fixques form-control' style='display:none;'  type = 'text' name = 'answercode".$row['MADAPAN']."' value='".$row['MADAPAN']."' readonly>
                                            <input class='fixques form-control' style='display:none;'  type = 'text' name = 'answer".$row['MADAPAN']."' value='".$row['NOIDUNGDAPAN']."' placeholder='nội dung đáp án'>
                                            <input class='fixques' style='display:none' type = 'range' name = 'truefalse".$row['MADAPAN']."' value='".$row['TRANGTHAI']."' min='0' max='1'></div>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            elseif($row["MADANG"] == "CHOOSEMANY"){
                                if ($row["MACAUHOI"] != $prev){
                                    if ($count > 0) echo "</form>";
                                    $count++;
                                    echo "  <form method='POST' style='padding: 0.5em;background:aliceblue;border:1px solid black;margin: 0.5em;'>
                                            <button type='button' class='btn btn-primary fix' data-toggle='modal' data-target='#exampleModal'>
                                                Sửa câu hỏi
                                            </button><br>
                                            <button  type='submit' class='btn btn-success fix1' style='display:none;' name='suacauhoi'>
                                                Xác nhận
                                            </button>
                                            <input type='hidden' name='macauhoi' value='".$row['MACAUHOI']."'>
                                            <label class='displayques'>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                            <textarea class='fixques form-control' style='display:none' name='cauhoi'>".$row['NOIDUNGCAUHOI']."</textarea>
                                            <label class='displayques'><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>
                                            <div style='width:70%;margin-left:15%;'>
                                            <input class='fixques form-control' style='display:none'  type = 'text' name = 'answercode".$row['MADAPAN']."' value='".$row['MADAPAN']."' readonly>
                                            <input class='fixques form-control' style='display:none'  type = 'text' name = 'answer".$row['MADAPAN']."' value='".$row['NOIDUNGDAPAN']."' placeholder='nội dung đáp án'>
                                            <input class='fixques' style='display:none' type = 'range' name = 'truefalse".$row['MADAPAN']."' value='".$row['TRANGTHAI']."' min='0' max='1'></div>";
                                            $prev = $row["MACAUHOI"];
                                    }
                                else{
                                    echo "  <label  class='displayques'><input id='' type='checkbox' name='dapan' value=''>".$row["NOIDUNGDAPAN"]."</label><br>
                                    <div style='width:70%;margin-left:15%;'><input class='fixques form-control' style='display:none;'  type = 'text' name = 'answercode".$row['MADAPAN']."' value='".$row['MADAPAN']."' readonly>
                                            <input class='fixques form-control' style='display:none;'  type = 'text' name = 'answer".$row['MADAPAN']."' value='".$row['NOIDUNGDAPAN']."' placeholder='nội dung đáp án'>
                                            <input class='fixques' style='display:none' type = 'range' name = 'truefalse".$row['MADAPAN']."' value='".$row['TRANGTHAI']."' min='0' max='1'></div>";
                                    $prev = $row["MACAUHOI"];
                                }
                            }
                            else{
                                if ($count > 0) echo "</form>";
                                $count++;
                                echo "  <form method='POST' style='padding: 0.5em;background:aliceblue;border:1px solid black;margin: 0.5em;'>
                                        <button type='button' class='btn btn-primary fix' data-toggle='modal' data-target='#exampleModal'>
                                            Sửa câu hỏi
                                        </button><br>
                                        <button  type='submit' class='btn btn-success fix1' style='display:none;' name='suacauhoi'>
                                                Xác nhận
                                            </button>
                                        <input type='hidden' name='macauhoi' value='".$row['MACAUHOI']."'>
                                        <textarea class='fixques form-control' style='display:none' name='cauhoi'>".$row['NOIDUNGCAUHOI']."</textarea>
                                        <label class='displayques'>Câu".$count.": ".$row['NOIDUNGCAUHOI']."</label><br>
                                        <input class='fixques form-control' style='display:none;' type='text' name = 'answer' value='".$row['NOIDUNGDAPAN']."' placeholder='Điền đáp án'><br>
                                        <input class='displayques' type='text' placeholder='Điền đáp án'><br>
                                        </form>";
                            }

                        }
                    }

                }
            ?>
        </content>
    </div>

    <nav style= "display:none;" id="updateinfor" class="addform">
            <?php
                if (mysqli_num_rows($result_updateinfor) > 0){
                    $prev = "";
                    while ($row = mysqli_fetch_assoc($result_updateinfor))
                        if ($row["EMAIL"] != $prev)
                            echo "  <form class='add-update' method = 'POST' action = 'updateinfor.php'>
                                        <h1>Cập nhật thông tin</h1>

                                        <label>Họ tên: </label>
                                        <input type='text' name = 'hoten' value='$row[TENHIENTHI]' placeholder=''/><br>
                
                                        <label>MSSV: </label>
                                        <input type='number' name = 'mssv' value='$row[MSSV]' placeholder=''/><br>
                
                                        <label>Lớp: </label>
                                        <input type='text' name = 'lop' value='$row[CLASS]' placeholder=''/<br><br>
                
                                        <label>Khóa: </label>
                                        <input type='number' name = 'khoa' value='$row[COURSE]' placeholder=''/><br>
                
                                        <label>Email: </label>
                                        <input type ='text' name = 'email' value='$row[EMAIL]' disable><br>
                
                                        <label>Mật khẩu: </label>
                                        <input type ='text' name = 'password' value='$row[PASSWORD]' disable><br>
                
                                        <label>Vai trò: </label>
                                        <input type ='text' name = 'vaitro' value='$row[VAITRO]' disable><br>
                
                                        <button type = 'submit'>Cập nhật</button>
                                    </form>
                            ";
                            
                }
            ?>
    </nav>

    <nav style= "display:none;" id="changepassword" class="addform">
        <?php
            if (mysqli_num_rows($result_changepassword) > 0){
                $prev = "";
                while ($row = mysqli_fetch_assoc($result_changepassword))
                    if ($row["EMAIL"] != $prev)
                        echo "  <form class='add-update' method = 'POST' action = 'changepassword.php'>
                                    <h1>Thay đổi mật khẩu</h1>

                                    <label>Mật khẩu cũ: </label>
                                    <input type='text' name = 'oldpass' placeholder=''/><br>

                                    <label>Mật khẩu mới: </label>
                                    <input type='text' name = 'newpass' placeholder=''/><br>

                                    <label>Nhập lại mật khẩu: </label>
                                    <input type='text' name = 'againnewpass' placeholder=''/><br>

                                    <button type = 'submit'>Cập nhật</button>
                                </form>
                            ";
            }    
        ?>           
    </nav>
</main>
</body>
</html>