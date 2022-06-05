<?php
require __DIR__ . '/part/connect_db.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增文章</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include __DIR__ . "/part/nav.php";
    ?>
    <div class="container">
        <h3 class="card-title text-primary" style="font-weight: bold;">新增文章</h3>
        <form name="main_form" onsubmit="sendData();return false;" novalidate>
            <div class="mb-3">
                <label for="title" class="form-label">文章標題</label>
                <input type="title" class="form-control" id="title" name="title">
                <div class="form-text red"></div>
            </div>
            <div class="mb-3">
                <label for="topic" class="form-label">文章分類</label>
                <select name="topic" class="form-select w-25" aria-label="Default select example">
                    <option value="1" selected>課程分享</option>
                    <option value="2">商品分享</option>
                    <option value="3">其他分享</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary mb-3" id="upload-btn" onclick="uploadPhotos()">
                上傳多張照片
            </button>
            <input type="hidden" name="photos" value="[]" />
            <div id="photo_container" style="display:none;">
                <!-- 上傳照位置 -->
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">文章內容</label>
                <textarea type="text" class="form-control" id="content" name="content" col="30" rows="6"></textarea>
                <div class="form-text red"></div>
            </div>
            <div class="mb-3">
                <label for="tag" class="form-label">HashTag</label>
                <input type="text" class="form-control" id="tag" name="tag">
                <div class="form-text red"></div>
            </div>

            <button type="submit" class="btn btn-primary mb-3">發文</button>
            <div id="info_bar" class="alert alert-success" role="alert" style="display: none;">
                發文成功
            </div>
        </form>

        <form name="form1" style="display: none">
            <input type="file" name="photos[]" accept="image/png, image/jpeg" multiple />
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        const photos = document.form1.elements[0];
        const container = document.querySelector(".container");
        const p_container = document.querySelector("#photo_container");
        let photoAr = [];


        container.addEventListener("click", (event) => {
            info_bar.style.opacity = "0";
        });

        async function sendData() {
            function show_msg(msg) {
                if (msg['success']) {
                    info_bar.style.opacity = "1";
                    info_bar.classList.remove('alert-danger');
                    info_bar.classList.add('alert-success');
                    info_bar.style.display = "block";
                } else {
                    info_bar.style.opacity = "1";
                    info_bar.classList.remove('alert-success');
                    info_bar.classList.add('alert-danger');
                    info_bar.style.display = "block";
                    info_bar.innerText = `發文失敗 : ${msg.error}。`;
                }
            }

            const fd = new FormData(document.main_form);
            const info_bar = document.querySelector('#info_bar');
            info_bar.style.display = 'none';

            const r = await fetch('api/post-add-api.php', {
                method: 'POST',
                body: fd,
            });
            const result = await r.json();
            console.log(result);

            show_msg(result);

        }

        function uploadPhotos() {
            photos.click(); // 模擬點擊
        }

        function delete_pic(event) {
            const f = event.currentTarget.parentNode.dataset.f;

            if (photoAr.indexOf(f) !== -1) {
                photoAr.splice(photoAr.indexOf(f) , 1);
            }
            document.main_form.photos.value = JSON.stringify(photoAr);
            console.log(photoAr);
            event.currentTarget.parentNode.parentNode.remove();
        }

        function photoItem(f) {
            return `
                <div class="p-card">
                    <div class="photoItem" style="display: inline-block" data-f="${f}">
                        <img class="up-photo" src="./uploaded/${f}" alt="" />
                        <i class="fa-solid fa-circle-minus" onclick="delete_pic(event);"></i>
                    </div>
                </div>
                `;
        }

        photos.addEventListener("change", async function() {
            if(photos.files.length >5){
                alert('最多隻能新增五張圖片'); 
                return; 
            }
            
            const pData = new FormData(document.form1);
            const r = await fetch("api/uploadPic-api.php", {
                method: "POST",
                body: pData
            });
            const obj = await r.json();
            console.log(obj);

            if (obj.filenames && obj.filenames.length) {
                photo_container.innerHTML += obj.filenames
                    .map((f) => photoItem(f))
                    .join("");
            }
            document.querySelectorAll(".photoItem").forEach((el) => {
                photoAr.push(el.getAttribute("data-f"));
            });
            document.querySelector("#photo_container").style.display="flex";
            document.main_form.photos.value = JSON.stringify(photoAr);
        });
    </script>
</body>

</html>