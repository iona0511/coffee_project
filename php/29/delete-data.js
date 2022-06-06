
const wrap = document.querySelector(".wrap");
const classIndexApi =
    "http://localhost/coffee-course/class-index-api.php";
const deleteApi = "http://localhost/coffee-course/delete-api.php";
const style = document.querySelector(".style");
const search = document.querySelector(".search");
const sort = document.querySelector("#sort");


function priceAsc(a, b) {
    return a.course_price - b.course_price;
}
function priceDesc(a, b) {
    return b.course_price - a.course_price;
}
function levelAsc(a, b) {
    return a.course_level - b.course_level;
}
function levelDesc(a, b) {
    return b.course_level - a.course_level;
}

// 資料/畫面生成

function getData(flag) {

    fetch(classIndexApi, {
        method: "POST",
       
    })
        .then((response) => {
            return response.json();
        })
        
        .then((data) => {
            
            sort.addEventListener("change", function () {
                if (sort.value === "priceAsc") {
                    data.sort(priceAsc);
                } else if (sort.value === "priceDesc") {
                    data.sort(priceDesc);
                } else if (sort.value === "levelAsc") {
                    data.sort(levelAsc);
                } else if (sort.value === "levelDesc") {
                    data.sort(levelDesc);
                }
                content();
            });
        function content (){
            wrap.innerHTML = ''
            for (let i = 0; i < data.length; i++) {
                const trs = document.createElement("tr");
                trs.dataset.index = data[i].course_name;
                trs.className = "trs";
                wrap.appendChild(trs);
                
                trs.innerHTML = `
                <td>${data[i].course_sid}</td>
                 <td scope="row" class="pic">
                <img src="./uploaded/${data[i].course_img_s}" alt="" />
            </td>
            <td>${data[i].course_name}</td>
            <td class="course_level">${data[i].course_level}</td>
            <td>NT$${data[i].course_price}</td>
            <td><a href="edit-data.html"><i class="fa-solid fa-pen-to-square" onclick="editDataA(${data[i].course_sid})"></i></a></td>
            <td><a href=""><i class="fa-solid fa-trash-can" onclick="deleteData(${data[i].course_sid})"></i></a></td>`;
             
        
                courseLevel =
                    document.querySelectorAll(".course_level");
                if (data[i].course_level === "1") {
                    courseLevel[i].innerHTML = "入門";
                }
                if (data[i].course_level === "2") {
                    courseLevel[i].innerHTML = "中級";
                }
                if (data[i].course_level === "3") {
                    courseLevel[i].innerHTML = "高級";
                }
            }
        }
        flag  && content();

        search.addEventListener("input", () => {
            if (search.value === "") {
                if (
                    (style.innerHTML +=
                        '.trs:not([data-index*="' +
                            search.value +
                            '"]){display:none;}' ===
                        true)
                ) {
                    style.innerHTML =
                        '.trs:not([data-index*="' +
                        search.value +
                        '"]){}';
                }
            }
            data.forEach(function (v, i) {
              
                ar2 = data[i].course_name.split("");
                


                ar2.forEach(function (v,i) {
                   
                    if (search.value === ar2[i])
                        style.innerHTML +=
                            '.trs:not([data-index*="' +
                            search.value +
                            '"]){display:none;}';
                });
            });
        });
       
        
        })
    
}

if(window.location.href === "http://localhost/coffee-course/delete-data.html"){ getData(true);}

   

    function add(){
       getData(false);
    }
    add();




function editDataA(value) {
    // console.log(value)
    localStorage.setItem('sid',`${value}`);
}


// 資料刪除
function deleteData(value) {
    const fd = new FormData();
    fd.append("course_sid", value);
    confirm("確定要刪除第" + value + "筆資料嗎?")
        ? fetch(deleteApi, {
              method: "POST",
              body: fd,
          }).then(() => {
              wrap.innerHTML = "";
              getData();
          })
        : 0;
}










