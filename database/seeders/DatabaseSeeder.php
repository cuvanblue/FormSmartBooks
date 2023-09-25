<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $name = array('Card mạng không dây USB TP-Link TL-WN725N Wireless', 'Laptop Dell Inspiron 14 7425 2-in-1 (AMD Ryzen 5-5625U/Ram 8G/SSD 512G/ 14" FHD)', 'Laptop Dell Latitude 3420 (Core i3-1115G4 | 8GB | 256GB | Intel UHD | 14.0 inch HD| Đen)');
        $brand = array('Dell', 'HP', 'Intel', 'MSI');
        $specs = "`VGA MSI GEFORCE GTX 1660 SUPER VENTUS XS OC
        - Dung lượng bộ nhớ: 6GB GDDR6
        - Core clocks: Boost: 1815MHz
        - Băng thông: 192-bit
        - Kết nối: DisplayPort x 3 (v1.4) / HDMI 2.0b x 1
        - Nguồn yêu cầu: 450W`";
        $description = "`## ** MSI GeForce GTX 1660 SUPER Ventus XS OC 6GB chính hãng giá rẻ**

        ### **Thiết kế**
        Thiết kế quạt tản nhiệt kép mang tính biểu tượng của MSI. Tấm ốp kim loại được thiết kế phay xước mang đến cho bạn thiết kế cao cấp và mượt mà ở lớp vỏ.
        
        ### **Tản nhiệt tối ưu**
        Thế hệ mới nhất của tản nhiệt MSI TWIN FROZR Thermal Design nổi tiếng mang đến công nghệ tiên tiến nhất cho hiệu suất làm mát tuyệt đỉnh. Được trang bị TORX FAN 2.0 mới kết hợp với các cơ chế khí động học đột phá đem lại cho hệ thống PC một hiệu suất ổn định và hoạt động yên tĩnh nhờ nhiệt độ được đảm bảo ở mức thấp nhất.
        
        ### **Đường vân bo mạch**
        Các đường vân bo mạch xen kẽ nhiều lớp tạo nên bảng mạch in hoàn chỉnh trên card .Chúng kết nối tất cả các thành phần quan trọng trên bo mạch và cho phép giao tiếp với tốc độ cực nhanh.
        
        ### **Hiệu suất**
        Tận dụng tối đa card đồ họa của bạn về hiệu suất xử đồ họa và trải nghiệm các tùy chọn tùy chỉnh gần như không giới hạn với phần mềm hỗ trợ đi kèm như: tùy chỉnh thiết lập với Dragon Center, tùy chỉnh ánh sáng với Mystic Light, ép xung xử lý với MSI Afterburner...`";
        $number = 20;
        $categories = array(
            "LAPTOP MỚI",
            "LAPTOP CŨ",
            "LINH KIỆN MÁY IN",
            "THIẾT BỊ MẠNG",
            "LINH KIỆN LAPTOP",
            "SURFACE",
            "MACBOOK",
            "MÁY IN",
            "THIẾT BỊ NGOẠI VI",
            "BÀN GHẾ GAMMING",
            "SẢN PHẨM MỚI",
            "SẢN PHẨM HOT"
        );
        // seed 10 user
        for ($i = 1; $i <= $number / 2; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('secret'),
            ]);
        }
        // seed category
        for ($i = 1; $i <= count($categories); $i++) {
            DB::table('categories')->insert([
                'name' => $categories[$i - 1],
                'child_of' => null,
                'last_modified_by' => $number / 10
            ]);
        }
        // seed 20 san pham, moi loai 3 cai
        for ($i = 1; $i <= $number; $i++) {
            $product_name = $name[rand(0, count($name) - 1)] . Str::random(10);
            DB::table('products')->insert([
                'brand' => $brand[rand(0, count($brand) - 1)],
                'name' => $product_name,
                'title' => $product_name,
                'specification' => $specs,
                'description' => $description,
                'price' => rand(1, 25) * 1000000,
                'quanity' => $number / 5,
                'status' => 'còn hàng',
                'last_modified_by' => $number / 10
            ]);
            DB::table('product_category')->insert([
                'category_id' => rand(1, 4),
                'product_id' => $i,
                'last_modified_by' => $number / 10
            ]);
            for ($j = 1; $j <= $number / 5; $j++) {
                DB::table('product_items')->insert([
                    'product_id' => $i,
                    'status' => 'tốt',
                    'last_modified_by' => $number / 10
                ]);

            }
            for ($j = 1; $j <= $number / 4; $j++) {
                DB::table('images')->insert([
                    'product_id' => $i,
                    'url' => 'img/sanpham' . rand(1, 7) . '.png',
                    'role' => $j == 1 ? 'thumbnail' : 'detail',
                    'last_modified_by' => $number / 10
                ]);

            }
        }
        // chèn thêm sản phẩm mới và hot
        for ($i = 1; $i <= 5; $i++) {
            DB::table('product_category')->insert([
                'category_id' => 12,
                'product_id' => $i,
                'last_modified_by' => $number / 10
            ]);
        }
        for ($i = 6; $i <= 10; $i++) {
            DB::table('product_category')->insert([
                'category_id' => 11,
                'product_id' => $i,
                'last_modified_by' => $number / 10
            ]);
        }
        // 
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}