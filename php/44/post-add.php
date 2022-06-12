<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>發佈分享</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pa_style.css">
</head>

<body>
    <?php include (dirname(__DIR__, 2)) . "/parts/navbar.php"; ?>
    <div class="container pt-3" style="max-width: 960px;">
        <h3 class="card-title" style="font-weight: bold;">新增文章</h3>
        <form name="main_form" onsubmit="sendData();return false;" novalidate id="main_form">
            <div class="d-flex mb-3">
                <div class="col-2 pr-3">
                    <label for="topic" class="form-label">文章分類</label>
                    <select name="topic" class="form-select" aria-label="Default select example">
                        <option value="1" selected>課程分享</option>
                        <option value="2">商品分享</option>
                        <option value="3">其他分享</option>
                    </select>
                </div>
                <div class="col-10">
                    <label for="title" class="form-label">文章標題</label>
                    <input type="title" class="form-control" id="title" name="title">
                    <div class="form-text red"></div>
                </div>




            </div>
            <button type="button" class="btn btn-primary mb-3" id="upload-btn" onclick="uploadPhotos()">
                分享你的照片
            </button>
            <span style="font-size:12px;color:gray;">(最少一張,最多五張)</span>
            <input type="hidden" name="photos" value="[]" />
            <div id="photo_container" style="display:none;">
                <!-- 上傳照位置 -->
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">文章內容</label>
                <textarea type="text" class="form-control" id="content" name="content" col="30" rows="4"></textarea>
                <div class="form-text red"></div>
            </div>
            <div class="mb-3">
                <label for="tag" class="form-label">標籤</label>
                <div class="wrap mb-3">
                    <div class="search_col">
                        <input type="text" class="form-control f_tag" id="tag" name="tag" placeholder="標籤名稱" autocomplete="off">
                        <!-- 搜尋列 -->
                        <div class="s_result">
                            <!-- 預覽搜尋 -->
                        </div>
                    </div>
                </div>
                <input type="hidden" name="tags" value="[]" />

                <div class="tag-rect pt-1">
                    <!-- 標籤列 -->
                </div>
            </div>


            <button type="submit" class="btn btn-primary mt-2 ">發佈分享</button>
            <div id="info_bar" class="alert alert-success" role="alert" style="display: none;">
                發佈成功
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
        let tagAr = [];


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
                    info_bar.innerText = `分享成功`;
                } else {
                    info_bar.style.opacity = "1";
                    info_bar.classList.remove('alert-success');
                    info_bar.classList.add('alert-danger');
                    info_bar.style.display = "block";
                    info_bar.innerText = `分享失敗 : ${msg.error}。`;
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

            show_msg(result);
        }

        function uploadPhotos() {
            photos.click(); // 模擬點擊
        }

        function removePhotos(event) {
            const f = event.currentTarget.parentNode.dataset.f;


            if (photoAr.indexOf(f) !== -1) {
                photoAr.splice(photoAr.indexOf(f), 1);
            }
            document.main_form.photos.value = JSON.stringify(photoAr);

            event.currentTarget.parentNode.parentNode.remove();

            if (document.main_form.photos.value == "[]") {

                document.querySelector("#photo_container").innerHTML = "";
                document.querySelector("#photo_container").style.display = "none";
            }
        }

        function photoItem(f) {
            return `
                <div class="p-card">
                    <div class="photoItem" style="display: inline-block" data-f="${f}">
                        <img class="up-photo" src="./uploaded/${f}" alt="" />
                        <i class="fa-solid fa-circle-minus" onclick="removePhotos(event);"></i>
                    </div>
                </div>
                `;
        }

        photos.addEventListener("change", async function() {
            if (photos.files.length > 5) {
                alert('最多隻能新增五張圖片');
                return;
            }
            const existPicLength = JSON.parse(document.main_form.photos.value).length;
            // 如果沒上圖片直接return
            if(photos.files.length == 0) return;

            if ((photos.files.length + existPicLength > 5)) {
                alert('最多隻能新增五張圖片');
                return;
            }

            const pData = new FormData(document.form1);

            const r = await fetch("api/uploadPic-api.php", {
                method: "POST",
                body: pData
            });
            const obj = await r.json();

            if (obj.filenames && obj.filenames.length) {
                photo_container.innerHTML += obj.filenames
                    .map((f) => photoItem(f))
                    .join("");
            }
            photoAr = [];
            document.querySelectorAll(".photoItem").forEach((el) => {
                photoAr.push(el.getAttribute("data-f"));
            });
            // 把紀錄的Arr篩回去給hidden input


            document.querySelector("#photo_container").style.display = "flex";
            document.main_form.photos.value = JSON.stringify(photoAr);
        });


        // 動態搜尋預覽
        // input會包含注音選自 compositionend輸入法完成後才會
        async function preview_tag() {

            const v = document.main_form.tag.value;
            if (v < 1) {
                document.querySelector(".s_result").innerHTML = "";
                return;
            }

            const pData = new FormData(document.main_form);
            const r = await fetch("api/preview-tag-api.php", {
                method: "POST",
                body: pData
            });
            const obj = await r.json();

            if (obj.length > 0) {
                const el = document.createElement("div");
                obj.forEach((v, ind) => {
                    el.innerHTML += `
                    <div class="s_col" onclick="render_h_tag(event);">${v['name']}</div>`;
                });
                document.querySelector(".s_result").innerHTML = el.innerHTML;
            }
        }

        document.main_form.tag.addEventListener("input", preview_tag);



        const removeTag = (event) => {
            const f = event.target.innerText;
            event.target.remove();

            if (tagAr.indexOf(f) !== -1) {
                tagAr.splice(tagAr.indexOf(f), 1);
            }
            document.main_form.tags.value = JSON.stringify(tagAr);
        };

        window.addEventListener("click", () => {

            document.querySelector(".search_col").style.width = "20%";

            if (event.target == document.main_form.tag) return;
            if (document.querySelector(".s_result")) {
                document.querySelector(".s_result").innerHTML = "";
            }
        });

        document.main_form.tag.addEventListener("click", async () => {
            event.cancelBubble = true;

            document.querySelector(".search_col").style.width = "28%";

            const v = document.main_form.tag.value;
            if (v < 1) {
                document.querySelector(".s_result").innerHTML = "";
                return;
            }

            const pData = new FormData(document.main_form);
            const r = await fetch("api/preview-tag-api.php", {
                method: "POST",
                body: pData
            });
            const obj = await r.json();

            if (obj.length > 0) {
                const el = document.createElement("div");
                obj.forEach((v, ind) => {
                    el.innerHTML += `<div class="s_col" onclick="render_h_tag(event)">${v['name']}</div>`;
                });
                document.querySelector(".s_result").innerHTML = el.innerHTML;
            }
        });


        function render_h_tag(event) {
            // 判斷是用click來的還是keydown(按enter)來的
            let v = event.target.innerText || document.main_form.tag.value;

            let exist = false;

            // 如果已經有現有標籤
            if (document.querySelector(".h_tag")) {
                document.querySelectorAll(".h_tag").forEach((now_tag) => {
                    if (v == now_tag.innerText) {
                        exist = (v == now_tag.innerText);
                        return
                    }
                });
            }

            // 不存在才render並清空input value
            if (!exist) {
                document.querySelector(".tag-rect").innerHTML += `
                <span class="h_tag" onclick="removeTag(event)">${v}</span>`;
                tagAr.push(v);
                document.main_form.tags.value = JSON.stringify(tagAr);

                document.main_form.tag.value = "";
            }

        }

        document.main_form.tag.addEventListener("keydown", (event) => {

            if (event.key == "Enter") {
                // render h_tag
                render_h_tag(event);
                event.preventDefault();
            }
            document.querySelector("#main_form").setAttribute("onsubmit", "event.preventDefault();sendData();return false;");
        });
    </script>
</body>

</html>