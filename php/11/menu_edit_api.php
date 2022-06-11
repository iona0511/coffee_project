<?php require dirname(__DIR__, 2) . '/parts/connect_db.php'; 
header('Content-Type: application/json');
// 這隻API是用來新增資料的，只有功能 沒有頁面

// session_start();

// if (!isset($_SESSION['user']['admin_account'])) {
//     header('Location:/coffee_project/php/09/admin-login.html');
//     exit;
// }


$output=[
    'success' => true,
    'postData' => $_POST,
    'code'=> 0,
    'error'=>'',
    'filenames' => [],
    'testtext' => []
    ];

$menu_sid = isset($_POST['menu_sid']) ? intval($_POST['menu_sid']) : 0;



// 圖片區


$folder = dirname(dirname(__DIR__, 1)) . '/images/11/';
// $folder = dirname(__DIR__, 2) . '/images/11/';

$extMap = [
    'image/jpeg'=>'.jpg',
    'image/png'=>'.png',
    'image/gif'=>'.gif',
];
    // $ext = $extMap[$_FILES['menu_photo']['type']];

    $singlepic= [];
    foreach ($_FILES['menu_photo']['name'] as $k => $f) {
    
        $filename = $f;
        $output['filenames'][] = $filename;    
        array_push($singlepic, $filename);
        move_uploaded_file($_FILES['menu_photo']['tmp_name'][$k], $folder . $filename);
    }
    $menu_photo = implode(",", $singlepic);

    // if(move_uploaded_file($_FILES['menu_photo']['tmp_name'],$folder.$menu_photo)){
    //     $output['success']=true;
    // }
    
    // $output['filename'] = $menu_photo;


// 欄位檢查，後端的檢查

// if(empty($_POST['menu_categories'])){
//     $output['error']='沒有填寫分類';
//     $output['code'] = 400;
//     echo json_encode($output,JSON_UNESCAPED_UNICODE);
//     exit; 
// };
$menu_categories = $_POST['menu_categories'];
// $menu_photo = md5($_FILES['menu_photo']['name'].rand()). $ext;
$menu_name = $_POST['menu_name']??'';
$menu_kcal = $_POST['menu_kcal']??'';
$menu_price_m = $_POST['menu_price_m'];
$menu_nutrition = $_POST['menu_nutrition']??'';




// 兩個問號+ '' 代表 沒有給值就給空字串，為的是不要跳出notice




$sql = "UPDATE `menu` SET `menu_categories`=?, `menu_photo`=?, `menu_name`=?, `menu_kcal`=?, `menu_price_m`=?, `menu_nutrition`=? WHERE `menu_sid`=$menu_sid";

$stmt = $pdo->prepare($sql);

$output['testtext'][0] = $menu_categories;
$output['testtext'][1] = $menu_photo;
$output['testtext'][2] = $menu_name;
$output['testtext'][3] = $menu_kcal;
$output['testtext'][4] = $menu_price_m;
$output['testtext'][5] = $menu_nutrition;


$stmt ->execute([
    $menu_categories,
    $menu_photo,
    $menu_name,
    $menu_kcal,
    $menu_price_m,
    $menu_nutrition,
    ]);
    
    
if($stmt->rowCount()==1){
    $output['success'] = true;
    // 最近新增資料的primary key
    // $output['lastInsertId'] = $pdo->lastInsertId();
    }else{
        $output['error'] = '資料無法新增';
    };
// isset() vs empty()
// isset是判斷有無設定值，只要是用等號設定過，都算是設定，設定為0、空值、空字串或是false也是
// empty不管有無設定 沒有設定就會拿到true（不會跳notice），如果是有設定0、空陣列、空字串或是false 也會拿到true

echo json_encode($output,JSON_UNESCAPED_UNICODE);
// API回應的一律是JSON格式，原則上是透過AJAX和前端溝通