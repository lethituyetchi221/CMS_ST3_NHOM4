<?php
/*
Plugin Name: Group 4
Description: A basic payment plugin for WordPress.
Version: 1.0
*/

function add_payment_page()
{
    add_menu_page('Payment Page', 'Payment Page', 'manage_options', 'payment-page', 'display_payment_page');
}

function save_payment_info($name, $qr_image_url)
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'payments';

    $wpdb->insert(
        $table_name,
        array(
            'recipient_name' => $name,
            'qr_image' => $qr_image_url,
        )
    );

    if ($wpdb->last_error) {
        echo "Lỗi SQL: " . $wpdb->last_error;
    }
}

add_action('admin_menu', 'add_payment_page');

function display_payment_page()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = sanitize_text_field($_POST['recipient_name']);

        if (isset($_FILES['qr_image']) && $_FILES['qr_image']['error'] === 0) {
            $uploaded_file = wp_handle_upload($_FILES['qr_image'], array('test_form' => false));
            if (!is_wp_error($uploaded_file) && isset($uploaded_file['url'])) {
                $qr_image_url = $uploaded_file['url'];
                // Xử lý và lưu thông tin
                save_payment_info($name, $qr_image_url);
            }
        }
    }

    // Hiển thị biểu mẫu cho người dùng
    echo '<div class="wrap">';
    echo '<h2>Payment Page</h2>';
    echo '<form method="post" enctype="multipart/form-data">';
    echo '<label for="qr_image">Hình ảnh QR:</label>';
    echo '<input type="file" id="qr_image" name="qr_image" accept="image/*" required><br>';
    echo '<label for="recipient_name">Tên người nhận:</label>';
    echo '<input type="text" id="recipient_name" name="recipient_name" required><br>';
    echo '<input type="submit" name="submit" value="Lưu">';
    echo '</form>';
    echo '</div>';

    global $wpdb;
    $table_name = $wpdb->prefix . 'payments';
    $payments = $wpdb->get_results("SELECT * FROM $table_name");

    if (!empty($payments)) {
        echo '<h2>Danh sách thanh toán</h2>';
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>Họ tên</th><th>Địa chỉ</th><th>Số điện thoại</th></tr></thead>';
        echo '<tbody>';
        foreach ($payments as $payment) {
            echo '<tr>';
            echo '<td>' . $payment->full_name . '</td>';
            echo '<td>' . $payment->address . '</td>';
            echo '<td>' . $payment->phone_number . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }

    echo '</div>';
}

add_action('admin_menu', 'add_payment_page');
function custom_payment_shortcode()
{
    ob_start();
?>

    <div class="text-center d-block">
        <h1>Thông tin thanh toán</h1>
        <p class="p-0 m-0">Chọn phương thức thanh toán:</p>
        <div class="d-flex justify-content-center">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>Thanh toán khi nhận hàng
                </label>
            </div>
            <div class="form-check" style="margin-left: 15px;">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">Chuyển khoản
                </label>
            </div>
        </div>
        <div id="option1_form">
            <form method="post" action="" class="w-50 d-block m-auto">
                <div class="form-group">
                    <label for="full_name">Họ tên:</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Số điện thoại:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" name="submit_option1" value="Lưu">
                </div>
            </form>
        </div>
        <div id="bank_account_div">
            <?php
            global $wpdb;
            // Lấy thông tin thanh toán từ bảng dữ liệu
            $table_name = $wpdb->prefix . 'payments';
            $payment = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE qr_image IS NOT NULL ORDER BY id DESC LIMIT 1"));
            if ($payment) {
                echo '<p class="p-0 m-0">Tên người nhận: ' . $payment->recipient_name . '</p>';
                echo '<div class="w-25 m-auto h-auto">';
                echo '<img src="' . $payment->qr_image . '" alt="" class="w-100">';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <script>
        var bankAccountDiv = document.getElementById("bank_account_div");
        var cashDiv = document.getElementById("option1_form");
        document.getElementById("radio2").addEventListener("click", function() {
            if (this.value === "option2") {
                bankAccountDiv.style.display = "block";
                cashDiv.style.display = "none";
            } else {
                bankAccountDiv.style.display = "none";
                cashDiv.style.display = "block";
            }
        });
        document.getElementById("radio1").addEventListener("click", function() {
            if (this.value === "option1") {
                bankAccountDiv.style.display = "none";
                cashDiv.style.display = "block";
            } else {
                bankAccountDiv.style.display = "block";
                cashDiv.style.display = "none";
            }
        });
    </script>
    <?php
    //Lưu thông tin vào database
    function save_option1_info($full_name, $address, $phone_number)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'payments';

        $wpdb->insert(
            $table_name,
            array(
                'full_name' => $full_name,
                'address' => $address,
                'phone_number' => $phone_number,
            )
        );

        if ($wpdb->last_error) {
            echo "Lỗi SQL: " . $wpdb->last_error;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_option1'])) {
        $full_name = sanitize_text_field($_POST['full_name']);
        $address = sanitize_text_field($_POST['address']);
        $phone_number = sanitize_text_field($_POST['phone_number']);

        // Thực hiện lưu thông tin vào cơ sở dữ liệu
        save_option1_info($full_name, $address, $phone_number);
    }
    ?>
<?php
    $content = ob_get_clean();
    return $content;
}
add_shortcode('custom_payment', 'custom_payment_shortcode');
