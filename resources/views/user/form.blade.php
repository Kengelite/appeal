<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    @include('../menu/menu_nav_user')
    @include('../menu/menu_user')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>แบบสอบถาม</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h1 class="card-title">แบบสอบถาม ข้อที่ <span style="color:#012970;"
                                        id="number-choice">1</span></h1>
                                <p style="font-size: 1rem;" id="quiz_show">
                                    {{ $quiz->quiz_name }}
                                </p>
                                <div id="quiz_content">
                                    <div class="input-group mb-3">

                                        @if ($quiz->type_name === 'input')
                                        <span class="input-group-text" id="basic-addon1">คำตอบ : </span>
                                        <input type="text" class="form-control" id="answer" placeholder="..."
                                            aria-label="Answer" aria-describedby="basic-addon1">
                                        <div class="ms-3">
                                            <button class="btn btn-success" id="submitForm"> ส่งคำตอบ </button>
                                        </div>
                                        @elseif ($quiz->type_name === 'select')
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">เลือกคำตอบ : </span>
                                            <select class="form-select" id="answer">
                                                <option value="option1">Option 1</option>
                                                <option value="option2">Option 2</option>
                                                <option value="option3">Option 3</option>
                                            </select>
                                            <div class="ms-3">
                                                <button class="btn btn-success" id="submitForm"> ส่งคำตอบ </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- <p>This quiz does not require an answer form.</p> -->
                                @endif
                            </div>
                        </div>
                    </div><!-- End Top Selling -->
                </div>
            </div><!-- End Left side columns -->

        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/assets/vendor/quill/quill.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <!-- <script src="assets/js/main.js"></script> -->
    <script>
    $(document).ready(function() {
        $('#submitForm').on('click', function(e) {
            e.preventDefault(); // ป้องกันการโหลดหน้าใหม่

            // เก็บข้อมูลฟอร์มในรูปแบบของอ็อบเจ็กต์
            var formData = {
                answer: $('#answer').val()
            };

            // ส่งข้อมูลผ่าน AJAX
            $.ajax({
                type: 'post',
                url: '/nextform', // URL ที่ต้องการส่งข้อมูลไป
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // ใช้เพื่อส่ง CSRF token
                },
                success: function(response) {
                    // แสดงผลลัพธ์เมื่อสำเร็จ
                    console.log(response);

                    // อัปเดตฟอร์มใหม่ตามประเภทของ quiz ถัดไป
                    $('#quiz_show').html(response.quiz.quiz_name)
                    let quizbtnsubmit =
                        '<div class="ms-3"><button class="btn btn-success" id="submitForm"> ส่งคำตอบ </button></div>';

                    var quizContent = '';

                    if (response.quiz.type_name === 'input') {
                        quizContent += '<div class="input-group mb-3">' +
                            '<span class="input-group-text" id="basic-addon1">คำตอบ : </span>' +
                            '<input type="text" class="form-control" id="answer" placeholder="..." aria-label="Answer" aria-describedby="basic-addon1">' +
                            '</div>';
                    } else if (response.quiz.type_name === 'select') {
                        // console.log("hello")
                        quizContent += '<div class="input-group mb-3">' +
                            '<span class="input-group-text" id="basic-addon1">เลือกคำตอบ : </span>' +
                            '<select class="form-select" id="answer">' +
                            '<option value="option1">Option 1</option>' +
                            '<option value="option2">Option 2</option>' +
                            '<option value="option3">Option 3</option>' +
                            '</select>' +
                            quizbtnsubmit+
                            '</div>';
                    }

                   
                    // อัปเดตเนื้อหาของ #quiz_content
                    $('#number-choice').html(parseInt($('#number-choice').html()) + 1)
                    $('#quiz_content').html(quizContent);
                },
                error: function(xhr, status, error) {
                    // แสดงข้อผิดพลาดเมื่อมีปัญหา
                    console.log(error)
                    alert('เกิดข้อผิดพลาดในการส่งคำตอบ');
                }
            });
        });
    });
    </script>
</body>

</html>