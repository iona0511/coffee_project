
            const btn = document.querySelector("#btn");
            const photoContainer = document.querySelector("#photo_container");
            const photoContainer2 = document.querySelector("#photo_container2");
            const avatar = document.form2.elements[0];

            function getData() {
                fetch("class-index-api.php")
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        for (let j = 0; j < data.length; j++) {
                            courseName = document.querySelector(".course_name");
                            course_price =
                                document.querySelector(".course_price");
                            course_level =
                                document.querySelector(".course_level");
                            course_content =
                                document.querySelector(".course_content");
                            course_people =
                                document.querySelector(".course_people");
                            course_material =
                                document.querySelector(".course_material");
                                
                            if (
                                sid ===
                                data[j].course_sid
                            ) {
                                courseName.value = data[j].course_name;
                                course_price.value = data[j].course_price;
                                course_level.value = data[j].course_level;
                                course_content.value = data[j].course_content;
                                course_people.value = data[j].course_people;
                                course_material.value = data[j].course_material;
                                data[j].course_img_s === ""
                                    ? 0
                                    : (photoContainer2.innerHTML = ` <img src="./uploaded/${data[j].course_img_s}" alt="" style="width:200px; " />`);
                            }

                            if (
                                sid ===
                                data[j].course_sid
                            ) {
                                courseName.value = data[j].course_name;
                                course_price.value = data[j].course_price;
                                course_level.value = data[j].course_level;
                                course_content.value = data[j].course_content;
                                course_people.value = data[j].course_people;
                                course_material.value = data[j].course_material;
                                data[j].course_img_s === ""
                                    ? 0
                                    : (photoContainer2.innerHTML = ` <img src="./uploaded/${data[j].course_img_s}" alt="" style="width:200px; " />`);
                            }
                        }
                    });
            }
            getData();
            
            async function sendData() {
                const fd = new FormData(document.form1);

                fd.append("course_sid", sid);
                const r = await fetch("edit-api.php", {
                    method: "POST",
                    body: fd,
                });
                const result = await r.json();
                console.log(result.success);
                if (result.success === true) {
                    window.location.href = "delete-data.html";
                }
            }

            const photoItem = (f) => {
                photoContainer2.style.display = "none";
                return ` <div class="photoItem" style="display: inline-block" data-f="${f}">
                                            <img src="./uploaded/${f}" alt="" />
                                        </div>
                                        `;
            };

            avatar.addEventListener("change", async function () {
                // 上傳表單
                const fd = new FormData(document.form2);
                const r = await fetch("upload-photos-api.php", {
                    method: "POST",
                    body: fd,
                });
                const obj = await r.json();

                // myimg.src = "./uploaded/" + obj.filename;
                if (obj.filename && obj.filename.length) {
                    photoContainer.innerHTML += obj.filename
                        .map((f) => photoItem(f))
                        .join("");
                }
                const photoAr = [];
                document.querySelectorAll(".photoItem").forEach((el) => {
                    photoAr.push(el.getAttribute("data-f"));
                });
                document.form1.course_img_s.value = photoAr;
                console.log(document.form1.course_img_s.value);
            });

            function uploadAvatar() {
                avatar.click(); // 模擬點擊
            }
 